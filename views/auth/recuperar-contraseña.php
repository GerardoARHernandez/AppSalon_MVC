<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuación:</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php'; 

    if ($error) return;
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
            type="password" 
            name="password" 
            id="password"
            placeholder="Tu Nueva Contraseña"
        >
    </div>
    <div class="campo">
        <label for="confirm-password">Confirmar Contraseña</label>
        <input 
            type="password" 
            name="confirm-password" 
            id="confirm-password"
            placeholder="Repite tu Contraseña"
        >
    </div>
    <input type="submit" value="Guardar Nueva Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear una cuenta</a>
    <a href="/">Iniciar Sesión</a>
</div>