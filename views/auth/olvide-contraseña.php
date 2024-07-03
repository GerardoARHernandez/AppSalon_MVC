<h1 class="nombre-pagina">Olvidé mi Contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo tu correo a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Correo</label>
        <input 
            type="email" 
            id="email"
            name="email"
            placeholder="Tu Correo"
        />
    </div>

    <input type="submit" value="Enviar Instrucciones" class="boton">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear una cuenta</a>
    <a href="/">Iniciar Sesión</a>
</div>