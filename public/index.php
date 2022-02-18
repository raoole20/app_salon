<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIControllers;
use Controllers\CrudControllers;
use Controllers\AdminControllers;
use Controllers\CitasControllers;
use Controllers\LoginControllers;

$router = new Router();

// login de los usuarios

$router->get('/',  [LoginControllers::class, 'login']);
$router->post('/', [LoginControllers::class, 'login']);

// Cerrar Sesion
$router->get("/logout",   [LoginControllers::class, 'logout']);

// Recuperar Password

// 1. Ir a un formulario 
$router->get("/olvide",    [LoginControllers::class, 'olvide']);
$router->post("/olvide",   [LoginControllers::class, 'olvide']);

// 1.1. Luego de volver de la verificacion
$router->get("/recuperar",  [loginControllers::class, 'recupzerar']);
$router->post("/recuperar", [loginControllers::class, 'recuperar']);

// Crear cuenta
$router->get ("/crear-cuenta", [LoginControllers::class, 'crear']);
$router->post("/crear-cuenta", [LoginControllers::class, 'crear']);

// confirmar cuenta
$router->get ("/confirmar-cuenta", [LoginControllers::class, 'confirmar']);
$router->get ("/mensaje", [LoginControllers::class, 'mensaje']);


// router publicos
$router->get('/cita', [CitasControllers::class, 'index']);
$router->get('/admin', [AdminControllers::class, 'index']);


// api de citas
$router->get('/api/servicios', [APIControllers::class, 'index']);
$router->post('/api/cita', [APIControllers::class, 'guardar']);
$router->get('/api/cita', [APIControllers::class, 'guardar']);
$router->post('/api/eliminar', [APIControllers::class, 'eliminar']);

// Crud
$router->get('/servicios', [CrudControllers::class, 'index' ] );
$router->get('/servicios/crear', [CrudControllers::class, 'crear']);
$router->post('/servicios/crear', [CrudControllers::class, 'crear']);
$router->get('/servicios/actualizar', [CrudControllers::class, 'actualizar']);
$router->post('/servicios/actualizar', [CrudControllers::class, 'actualizar']);
$router->get('/servicios/eliminar', [CrudControllers::class, 'eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();