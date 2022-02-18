<?php 
namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token ) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function confirmar(){

        // crear el objeto de email
        $phpmailer = new PHPMailer();

        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '9cb1301e9360e1';
        $phpmailer->Password = '6f1bb83f08cb04';
        $phpmailer->SMTPSecure = 'tls';

        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $phpmailer->Subject = 'confirma tu correo';
        
        // ser Html
        $phpmailer->isHTML();

        $contenido  = "<html/>";
        $contenido .= "<p>Para confirmar tu cuenta, dar click en el siguiente enlace </p> ";
        $contenido .= "<p>Presiona Aqui: </p><a href='http://localhost:8080/confirmar-cuenta?token=".  $this->token  . "'>Confirmar</a>";
        $contenido .= "</html>";
    
        $phpmailer->Body = $contenido;

 
        $phpmailer->send();
      
    }   
    public function enviarInstrucciones(){
                // crear el objeto de email
                $phpmailer = new PHPMailer();

                $phpmailer->isSMTP();
                $phpmailer->Host = 'smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '9cb1301e9360e1';
                $phpmailer->Password = '6f1bb83f08cb04';
                $phpmailer->SMTPSecure = 'tls';
        
                $phpmailer->setFrom('cuentas@appsalon.com');
                $phpmailer->addAddress('cuentas@appsalon.com', 'appsalon.com');
                $phpmailer->Subject = 'Restablecer Password';
                
                // ser Html
                $phpmailer->isHTML();
        
                $contenido  = "<html/>";
                $contenido .= "<p>Restablecer tu Password</p> ";
                $contenido .= "<p>Presiona Aqui: </p><a href='http://localhost:8080/recuperar?token=".  $this->token  . "'>Restablecer</a>";
                $contenido .= "</html>";
            
                $phpmailer->Body = $contenido;
        
         
                $phpmailer->send();
    }
}