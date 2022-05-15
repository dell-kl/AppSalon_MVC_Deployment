<?php namespace Models;

    use Models\ActiveRecord;
    //Estructuracion de nuestra base de datos, para inyectar
    //los datos correspondientes del cliente cuando 
    //construya su propia cita y el administrador las pueda
    //ver y administrar (válgame la rebundancia) :)
    class Citas extends ActiveRecord{

        protected static $tabla = 'citas';
        protected static $columnasDB = ['id', 'Fecha', 'Hora', 'usuarioId'];

        public $id;
        public $Fecha;
        public $Hora;
        public $usuarioId;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->Fecha = $args['Fecha'] ?? '';
            $this->Hora = $args['Hora'] ?? '';
            $this->usuarioId = $args['usuarioId'] ?? '';
        }

    }
?>