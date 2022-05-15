<?php namespace Models;

    use Models\ActiveRecord;

    #Modelos que heredaran tanto de otros modelos.
    class Usuario extends ActiveRecord{
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id','Nombre', 'Apellido', 'Telefono', 'Admin', 'Email', 'Password', 'Confirmado', 'Token'];

        public $id;
        public $Nombre;
        public $Apellido;
        public $Telefono;
        public $Admin;
        public $Email;
        public $Password;
        public $Confirmado;
        public $Token;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->Nombre = $args['Nombre'] ?? '';
            $this->Apellido = $args['Apellido'] ?? '';
            $this->Telefono = $args['Telefono'] ?? '';
            $this->Admin = $args['Admin'] ?? '0';
            $this->Email = $args['Email'] ?? '';
            $this->Password = $args['Password'] ?? '';
            $this->Confirmado = $args['Confirmado'] ?? '0';
            $this->Token = $args['Token'] ?? null;
        }

        public function ValidarNuevaCuenta(){
            #Todos los errores que generaremos cuando tengamos un error en el formulario.
            if(!($this->Nombre)){
                static::setAlerta('error', 'Es necesario colocar un nombre');
            }

            if(!($this->Apellido)){
                static::setAlerta('error', 'Es necesario colocar un apellido');
            }

            if(!($this->Telefono)){
                static::setAlerta('error', 'Es necesario colocar un número telefónico');
            }

            if(strlen($this->Telefono < 10 || strlen($this->Telefono) > 10)){
                static::setAlerta('error', 'Tu número telefónico debe tener una extensión de 10 dígitos');
            }
            

            if(!($this->Email)){
                static::setAlerta('error', 'Es necesario colocar un email');
            }

            if(!($this->Password)){
                static::setAlerta('error', 'Es necesario colocar un password');
            }

            if(strlen($this->Password) < 14){
                static::setAlerta('error', 'Tu password debe tener una extensión de 14 carácteres');
            }

            return static::getAlertas();
        }

        public function ValidandoPorPasswordReestablecido($passwordNuevo){
            if(strlen($passwordNuevo) < 14){
                static::setAlerta('error', 'Tu password debe contener al menos un total de 14 carácteres');
            }else{
                $this->Token = "";
                $this->ActualizacionesPassword($passwordNuevo);

                #Guardar las nuevas actualizaciones en la base de datos.
                $resultado = $this->guardar();
                if($resultado){
                    static::setAlerta('exito', 'Password Confirmado Correctamente :)');
                }
            }
            return static::getAlertas();
        }

        public function ValidarRecuperar(){
            if(!($this->Password)){
                static::setAlerta('error', 'Debes insertar un password');
            }
            return static::getAlertas();
        }

        public function ValidarLogin(){
            if(!($this->Email)){
                static::setAlerta('error', 'No haz colocado tu email');
            }

            if(!($this->Password)){
                static::setAlerta('error', 'No haz colocado tu password');
            }

            return static::getAlertas();
        }

        #Este es una validacion para la pagina de /forget, cuando el
        # usuario se le olvida su password y se le tiene que 
        # enviar unas instrucciones a su cuenta de email.
        public function ValidarEmail(){
            if(!($this->Email)){
                static::setAlerta('error', 'El email es obligatorio');
            }
            return static::getAlertas();
        }

        //Revissa sobre el usuario. Si está o no está previamente registrado.
        public function UsuarioEncontrar(){
            //code...
            $query = "SELECT * FROM usuarios";
            $query .= " WHERE email = '{$this->Email}' LIMIT 1;";
            $resultado = self::$db->query($query);
            if($resultado->num_rows){
                static::setAlerta('error', 'Ya existe un usario registrado con ese email');
            }

            return $resultado;
        }

        public function Token(){
            $this->Token = uniqid();
        }

        public function PasswordHash(){
            $this->Password = password_hash($this->Password, PASSWORD_BCRYPT);
        }

        public function ActualizacionesPassword($password){
            $this->Password = password_hash($password, PASSWORD_BCRYPT);
            
        }

        public function PasswordAndConfirmation($password){
            $verificar = password_verify($password, $this->Password);
            if(!$verificar || !$this->Confirmado){
                static::setAlerta('error', 'Password Incorrecto o no confirmado');
            }else{
               return true;
            }
            return static::getAlertas();
        }  
    }
?>