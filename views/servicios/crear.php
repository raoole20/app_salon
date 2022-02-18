<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Crea un Nuevo Servicio</p>

<?PHP 
    include_once __DIR__ . '/../template/barra.php';
    include __DIR__ . '/../template/alertas.php';
?>
 
<form action="/servicios/crear" method="POST" class="formulario">

<?PHP
    include 'formulario.php' ;
?>
    <input type="submit" class="boton" value="Enviar">
</form>

