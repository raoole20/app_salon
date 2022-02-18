<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Actualiza el servicio</p>

<?PHP 
    include_once __DIR__ . '/../template/barra.php';
    include __DIR__ . '/../template/alertas.php';
?>

<form method="POST" class="formulario">

<?PHP
    include 'formulario.php' ;
?>
    <div class="barra admin ">
        <input type="submit" class="boton" value="Actualizar">
        <a href="/servicios/eliminar?id=<?php echo $servicio->id ?>" class="boton eliminar">Eliminar Servicio</a>
    </div>
    

</form>

