<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Correo</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu correo"
            name="email"
        />
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password"
        />
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear una cuenta</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>