<?PHP 

namespace Controllers;

use Model\Servicios;
use MVC\Router;

class CrudControllers {

    public static function index(Router $router){
        
        $servicio = Servicios::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicio
        ]);
    }
    
    public static function crear(Router $router){

        $servicio = new Servicios();
        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if( empty($alertas) ){
                $servicio->guardar();
                header("location: /servicios?mensaje=1");
            }

        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'alertas'  => $alertas,
            'servicio' => $servicio
        ]);
    }
    public static function actualizar(Router $router){

        $id = $_GET['id'] ?? '';
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if( $id ){
            $servicio = Servicios::find($id);     
        }else {
            header('location: /servicios');
        }

        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if( empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios?mensaje=2");
            }

        }
        $router->render('servicios/actualizar', [
            'servicio' => $servicio,
            'alertas'  => $alertas
        ]);
    }

    public static function eliminar(Router $router){

        $id = $_GET['id'] ?? '';
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if( $id ){
            $servicio = Servicios::find($id);     
            $servicio->eliminar();
            header('Location: /servicios?mensaje=3');
        }else {
            header('location: /servicios');
        }

        
       
    }

}