<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Verificar que llene los campos de inicio de sesión
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                // Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario) {
                    // Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['login'] = true;

                        //Redirrecionamiento
                        if($usuario->admin == "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }

                        debuguear($_SESSION);
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no Encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide(Router $router){
     
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            //Revisar que alertas esté vacio
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado == "1"){
                    $usuario->crearToken();
                    $usuario->guardar();
                    
                    //Enviar el correo
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();

                    //Alerta de exito
                    Usuario::setAlerta('exito','Se ha enviado un correo para reestablecer tu contraseña');

                }else{
                    Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-contraseña', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){
        
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        //Buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error','Token No Válido');
            $error = true;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer la nueva contraseña y guardarla
            $nueva_contraseña = s($_POST['password'] ?? '');
            $confirmar_contraseña = s($_POST['confirm-password'] ?? '');

            $alertas = Usuario::validarPassword($nueva_contraseña, $confirmar_contraseña);

            $password = new Usuario($_POST);
            

            if (empty($alertas)) {
                //Se elimina la antigua contraseña
                $usuario->password = null;
                //Se toma de la instancia de password la nueva contraseña y se asigna al usuario
                $usuario->password = $password->password;
                //Se hashea la contraseña
                $usuario->hashPassword();
                //Se elimina nuevamente el token
                $usuario->token = '';

                $resultado = $usuario->guardar();
                
                if($resultado) {
                    // Crear mensaje de exito
                    Usuario::setAlerta('exito', 'Contraseña Actualizada Correctamente');
                                    
                    // Redireccionar al login tras 4 segundos
                    header('Refresh: 4; url=/');
                }
            }
            
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-contraseña',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear(Router $router){
        
        $usuario = new Usuario;

        //Alertas vacias
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas esté vacio
            if (empty($alertas)) {
                //Verificar que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else{
                    //Hashear Password
                    $usuario->hashPassword();

                    //Generar un token único
                    $usuario->crearToken();

                    //Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }

                    // debuguear($usuario);
                }
            }

        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){

        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token No Válido');
        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta Comprobada Correctamente');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();
        //Renderizar la vista
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}
