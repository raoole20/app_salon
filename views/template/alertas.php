<?PHP 
    foreach($alertas as $key => $mensajes){
        foreach($mensajes as $mensaje){  ?>


            <div class="alerta <?php echo $key?>"><?PHP echo $mensaje; ?></div>


         <?PHP  }
    }?>
