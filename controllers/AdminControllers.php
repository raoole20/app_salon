<?PHP 

namespace Controllers;

use MVC\Router;
use Model\AdminCita;

class AdminControllers {

    public static function index(Router $router){


        $fecha =  $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate( $fechas[1], $fechas[2], $fechas[0])){
            header('Location: /400');
        }

        // consultar base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citaId=citas.id ";
        $consulta .= " JOIN servicios  ON citasservicios.servicioId = servicios.id ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);

        $nombre = $_SESSION['nombre'];

        $router->render( 'admin/index', [
            'nombre' => $nombre,
            'citas'  => $citas,
            'fecha'  => $fecha
        ]);
    }
}