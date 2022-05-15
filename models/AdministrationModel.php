<?php namespace Models;
    /** 
     * Crearemos este modelo, en base a lo que sabemos
     * sobre que no existe una tabla en sí en nuestra Base
     * de Datos. Este modelo que crearemos estará bajó el llamado
     * a varias tablas que hicimos en nuestra base de datos
     * bajo el método JOIN. Y creamos una simple tabla única
     * que nos traía información importante.
     */

    use Models\ActiveRecord;
    class AdministrationModel extends ActiveRecord{
        protected static $tabla = 'citas_servicios';
        protected static $columnasDB = ['id', 'Hora', 'Cliente', 'Email', 'Telefono', 'Servicios', 'Precio'];

        public $id;
        public $Hora;
        public $Cliente;
        public $Email;
        public $Telefono;
        public $Servicios;
        public $Precio;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->Hora = $args['Hora'] ?? '';
            $this->Cliente = $args['Cliente'] ?? '';
            $this->Email = $args['Email'] ?? '';
            $this->Telefono = $args['Telefono'] ?? '';
            $this->Servicios = $args['Servicios'] ?? '';
            $this->Precio = $args['Precio'] ?? '';
        }
    }
?>