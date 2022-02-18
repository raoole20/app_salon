<div class="barra">
    <p>Hola: <?PHP echo $nombre ?? '' ?></p>
    <a href="/logout" class="boton" >Cerrar Sesion</a>
</div>

<?PHP  if( isset( $_SESSION['admin'] ) ){ ?>
    <div class="barra admin">

        <a href="/admin" class="boton">Ver Citas</a>
        <?PHP if( $_SERVER['REQUEST_URI'] === '' ){?> 
            <a href="/servicios/actualizar" class="boton">Actualizar Servicios</a>
        <?PHP } else { ?>
            <a href="/servicios" class="boton">Ver Servicios</a>
        <?PHP }?>  

        <a href="/servicios/crear" class="boton">Nuevo Servicio</a>

    </div>
<?PHP
}else{
        
    }
?>
