<?php namespace Controllers;

    use Models\AdministrationModel;
    use MVC\Router;
    use Models\Cita_servc;
    use Models\Servic;
    use Models\Citas;
    use Models\CitServc;

    class ApiControllers{
        //consumimos nuestra api de php a json.
        //al final podemos hacerlo a la inversa. de json a php.
        public static function setting(){
            $servicio = Servic::all();
            echo json_encode($servicio);
        }

        public static function guardando(){
            //Almecena la cita y devuelve el id..
            $cita = new Citas($_POST);

            $saveInformation = $cita->guardar();

            $Id = $saveInformation['id']; //id de las cita.

            // //Almacena los servicios con el ID de las citas.
            $idServicios = explode(',',$_POST['servicios']); // id de los servicios.
            // echo  json_encode(join(',',$idServicios));
            foreach($idServicios as $IDservicio){
                //code...
                $args = [
                    'citaId' => $Id,
                    'servicioId' => $IDservicio
                ];
                $cita_servicio = new CitServc($args);
                $respuesta = $cita_servicio->guardar(); 
            }
            
            echo json_encode($saveInformation);
        }

        public static function eliminar(){
            //code...
            // El -->id<-- de la cita que se quizo eliminar.
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $user = Citas::find( $_POST['id']);
                $referencia = $_SERVER["HTTP_REFERER"];
                $resultado =  $user->eliminar();
                if($resultado){  
                    echo "<script>location.href='{$referencia}';</script>";
                }
            }
        }
    }
?>