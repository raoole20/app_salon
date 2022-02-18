<?PHP 

namespace Model;

use Model\ActiveRecord;

class Servicios extends ActiveRecord{

    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;


    public function __construct($arg = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->precio = $args['precio'] ?? null;
    }
    
    public function validar(){

        if( !$this->nombre ){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if( !$this->precio ){
            self::$alertas['error'][] = 'El precio es obligatorio';
        }
        if( !is_numeric($this->precio ) ){
            self::$alertas['error'][] = 'El precio es obligatorio';
        }
        return self::$alertas;
    }

}