<h1 class="nombre-pagina">Crear una nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?PHP
    include_once __DIR__  . '/../template/barra.php';
?>

<div >

    <nav class="tabs">
        <button class="button" data-paso="1">Servicios</button>
        <button class="button" data-paso="2">Informacion Cita</button>
        <button class="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="Listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Cita</h2>
        <p class="text-center">Coloca tus datos y una fecha</p>

        <for class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    type="text"
                    name="nombre"
                    id="nombre"
                    placeholder="Tu nombre"
                    value="<?PHP echo $nombre ?>"
                    disabled
                    >
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    type="date"
                    name="fecha"
                    id="fecha"
                    min='<?php echo  date('Y-m-d', strtotime('+1 day') ); ?>'
                    >
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    type="time"
                    id="hora"
                    >
            </div> 
            <input type="hidden" name="id" id="id" value="<?PHP echo $id ?>">
        </for>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verfica los datos</p>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">
            &laquo; Anterior
        </button>
        <button class="boton" id="siguiente">
             Siguiente &raquo;
        </button>
    </div>
</div>

<?php  
    $script = " 
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script src = 'build/js/app.js'></script>
    "
?>



