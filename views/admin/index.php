<h1 class="nombre-pagina">Admin</h1>

<?PHP
    isAdmin();
    include_once __DIR__  . '/../template/barra.php';

?>
<h2>Buscar Citas</h2>

<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">FECHA</label>
            <input
             type="date"
             id = 'fecha'
             name = 'fecha'
             value = '<?PHP echo $fecha ?>'
             >
        </div>
    </form>
</div>

<div class="citas-admin">

    <?PHP if(count($citas) === 0){

        echo "<h2>No Hay Citas en esta Fecha</h2>";
    }
        ?>
    <ul class="citas">
        <?PHP
        $idCita = 0; 
        foreach( $citas as $key => $cita) { 
            if( $idCita !== $cita->id ){
                $total = 0;
                ?>  
                <li>
                    <p>ID: <span> <?PHP echo $cita->id; ?></span></p>
                    <p>Hora: <span> <?PHP echo $cita->hora; ?></span></p>
                    <p>cliente: <span> <?PHP echo $cita->cliente; ?></span></p>
                    <p>Email: <span> <?PHP echo $cita->email; ?></span></p>
                    <p>Telefono: <span> <?PHP echo $cita->telefono; ?></span></p>

                    <h3>Servicios</h3>
                </li>
            <?PHP $idCita = $cita->id;   } ?>
                <p class="servicios"> <?PHP echo $cita->servicio . ' '. $cita->precio; ?></p>

                <?PHP 
                    $total += $cita->precio;
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1 ]->id ?? 0;

                    if( isLast($actual, $proximo )){
                        ?> <p class="precio">TOTAL: <span> $ <?PHP echo $total ?></span></p>
                            <form action="/api/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?PHP echo $cita->id ?>">
                                <input type="submit" name="" class="boton eliminar" value="Eliminar">
                            </form>
                        <?php 
                    }
                ?>
        <?PHP }?>
    </ul>
</div>


<?PHP 
    $script = "<script src='build/js/buscador.js'></script>";
?>