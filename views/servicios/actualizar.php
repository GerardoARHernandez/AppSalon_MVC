<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="post" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Guardar Servicio" class="boton">
</form>