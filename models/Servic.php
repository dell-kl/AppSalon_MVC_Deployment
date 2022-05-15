<?php namespace Models;

    use Models\ActiveRecord;

    class Servic extends ActiveRecord{
        protected static $tabla = 'servicios';
        protected static $columnasDB = ['id', 'Nombre', 'Precio'];

        public $id;
        public $Nombre;
        public $Precio;

        public function __construct($args = [])
        {   
            $this->id = $args['id'] ?? null;
            $this->Nombre = $args['Nombre'] ?? '';
            $this->Precio = $args['Precio'] ?? '';
        }

        // public function Informacion() {}  # Este es parte de la informacion.
        public function validar(){
            //code...
            if(!$this->Nombre){
                self::setAlerta('error', 'Debes colocar un nombre');
            }

            if(!$this->Precio){
                self::setAlerta('error', 'Debes colocar un precio');
            }

            if(!is_numeric($this->Precio)){
                self::setAlerta('error', 'Formato no válido de precio');
            }

            return self::getAlertas();
        }

    }
?>