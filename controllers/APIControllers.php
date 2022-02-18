<?php 

namespace Controllers;

use Model\Cita;
use Model\CitasServicio;
use Model\Servicios;

class APIControllers {

    public static function index(){
        $servicios = Servicios::all();
        echo json_encode($servicios);
        // echo($json);
    }

    public static function guardar(){
        
        // almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        // Al macena la cita y el servicios
        $idServicios = explode(',',  $_POST['servicios_'] );

        foreach( $idServicios as $idServicio ){
            $arg = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ] ;
            $citaServicio = new CitasServicio($arg);
            $citaServicio->guardar();
        }


        $respuesta = [
            'respuesta' => $resultado
        ];
        echo json_encode($resultado);
    }

    public static function eliminar(){

        if( $_SERVER['REQUEST_METHOD'] === "POST"){
            $id = $_POST['id'];

            $cita = Cita::find($id);
            $cita->eliminar();

            header("location: " .$_SERVER['HTTP_REFERER']);
        }
    }
}