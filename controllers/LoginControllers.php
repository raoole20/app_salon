<?php

namespace Controllers;

use Clases\Email;
use Model\Usuario;
use MVC\Router;

class LoginControllers {

    public static function login(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            
            if( empty($alertas) ){

                // comprobar que el ususario exista
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){

                    // verificar el password
                    if( $usuario->comprobarPasswordVerificado($auth->password) ){

                        // iniciamos sesion con la sieguienet fuicnion y llenamos el array
                        session_start();

                        $_SESSION['id']          = $usuario->id;
                        $_SESSION['nombre']      = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email']       = $usuario->email;
                        $_SESSION['autenticado'] = true;

                        if( $usuario->admin === '1'){
                            // es admin
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('location: /admin');

                        }else{
                            // es cliente
                            header('location: /cita');
                        }
                    }
                   
                }else{
                    Usuario::setAlerta('error', 'el usuario no existe');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout(){
        $_SESSION = [];
        header('Location: /');
    }
    public static function crear(Router $router){

        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Validar que el usuario sea valido
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // revisar que la alrta este vacio
            if(empty($alertas)){
                // revisar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{

                    // Hashear Password
                    $usuario->hashPassword();

                    // Generar un token unico
                    $usuario->hashToken();

    
                    // Confirmar el E-mail
                    $email = new Email( $usuario->email, $usuario->nombre,$usuario->token); 

                    

                    $email->confirmar();

                    // crear el usuario
                    $resultado = $usuario->guardar();


                    if($resultado){
                        header('location: /mensaje');
                    }

                }
            }
        }
        
    $router->render('auth/crear',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function olvide(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario ($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);

                if($usuario && $usuario->confirmado === '1'){

                    // Generar token de un solo uso 
                    $usuario->hashToken();
                    $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito', "Email de confirmacion enviado");
                }else{
                    Usuario::setAlerta('error', ' el Ususario no existe o no esta confirmado');
                }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide',[
            'alertas' => $alertas
        ]); 
    }
    public static function mensaje(Router $router){

        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){

        $alertas = [];
        $token    = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if( empty($usuario)){
            // mostrar mesnaje de error
            Usuario::setAlerta('error', 'Token no valdo');
        }else{
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Token no valdo');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){

        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        // buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if( empty($usuario) ){
            Usuario::setAlerta('error', 'token no valido');
            $error = true;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // validando nuevo password
            $password = new Usuario($_POST);

            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header('location: /');
                }
            }
        }


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar',[
            'alertas' => $alertas, 
            'error'   => $error
        ]);

    }

}