<?PHP 

namespace Controllers;

use MVC\Router;

class CitasControllers{

    public static function index(Router $router){
        // session_start();// supuestamente ya se inicio session
        isAuth();
        
        $router->render('cita/index',[
            'nombre'  => $_SESSION['nombre'],
            'id'      => $_SESSION['id']
        ]);
    }
}