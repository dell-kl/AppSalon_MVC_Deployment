<?php namespace Models;

    use Models\ActiveRecord;
    
    class CitServc extends ActiveRecord{
        protected static $tabla = 'citas_servicios';
        protected static $columnasDB = ['id', 'citaId', 'servicioId'];
        
        public $id;
        public $citaId;
        public $servicioId;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->citaId = $args['citaId'] ?? '';
            $this->servicioId = $args['servicioId'] ?? '';

        }
    }
?>