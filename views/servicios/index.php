<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicios</p>

<?PHP 
    include_once __DIR__ . '/../template/barra.php';
    $mensaje = $_GET['mensaje'] ?? 'post';
?>
    <div class=" ">
           <?PHP switch ($mensaje) {
               case '1':
                   echo '<p class = "alerta exito">Se a creado el servicio con exito</p>';
                   break;
               
               case '2':
                   echo '<p class = "alerta exito">Se a actualizado el servicio con exito</p>';
                   break;
               
               case '3':
                   echo '<p class = "alerta exito">Se a Eliminado el servicio con exito</p>';
                   break;
               case 'post':
                   break;
               
               default:
                   echo '<p class = "alerta error"> Id no valido, error</p>';
                   break;
           } ?>
    </div>
    
    <h2>Todos los servicios</h2>
<div class="Listado-servicios">
    <?PHP foreach( $servicios as $key => $servicio)  : ?>
        <a href="/servicios/actualizar?id=<?php echo $servicio->id ?>">

            <div class="servicio" id="actualizar">
                <p class="servicio-nombre"><?PHP echo $servicio->nombre ?></p>
                <p class="servicio-precio"><?PHP echo $servicio->precio ?></p>
            </div>
            
        </a> 
    <?PHP endforeach; ?>
</div>

<?PHP 

$script = " 
<script src = 'build/js/actualizar.js'></script>"
?>



