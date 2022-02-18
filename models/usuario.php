<?PHP 

namespace Model;

class Usuario extends ActiveRecord{

    // Bases de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email','password', 'telefono','admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;       
        $this->nombre = $args['nombre'] ?? '';       
        $this->apellido = $args['apellido'] ?? '';       
        $this->email = $args['email'] ?? '';       
        $this->password = $args['password'] ?? '';       
        $this->telefono = $args['telefono'] ?? '';       
        $this->admin = $args['admin'] ?? 0;       
        $this->confirmado = $args['confirmado'] ?? 0;       
        $this->token = $args['token'] ?? '';       
    }

    // mensajes de validacion
    public function validarNuevaCuenta(){

        if(!$this->nombre){
            self::$alertas['error'][] =  'El Nombre es Obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] =  'El Apellido es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] =  'El Email es Obligatorio';
        }
        
        if(!$this->password){
            self::$alertas['error'][] =  'El Password es Obligatorio';
        }

        if(strlen($this->password) <= 6){
            self::$alertas['error'][] = 'El password debe tener almenos 6 caracteres';
        }

        return self::$alertas;
    }


    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" .$this->email . "' LIMIT 1" ;

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][] = 'El Usuario ya existe';
        }

        return $resultado;
    }
    
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function hashToken(){

        $this->token = uniqid(); //genera un id unico cada vez que se manda a llamar

        // usar mailtrap para enviar el token

    }

    public function validarLogin(){

        if(!$this->email){
            self::$alertas['error'][] = 'El emal es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'El Password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El emal es obligatorio';
        }
        return self::$alertas;

    }
    public function validarPassword(){

        if(!$this->password){
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe ser mayor a 6 digitos';
        } 

        return self::$alertas;
    }

    public function comprobarPasswordVerificado($password){

        $resultado = password_verify( $password , $this->password);

        if(!$this->confirmado === "1"|| !$resultado){
            self::setAlerta('error', 'usuario no verificado o password');
            return false;
        }else{
            return true;
        }

    }
}