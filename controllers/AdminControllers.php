<?php namespace Controllers;

use DateTime;
use Models\AdministrationModel;
use MVC\Router;
    class AdminControllers{
        //code...
        # Toda la informacion de las citas, el administrador los podra ver en su
        # propia cuenta y pagina de administrador. 
        public static function admin(Router $router){
            //code...
            isAdmin();          

            $formato = $_GET['Fecha'] ?? date('Y-m-d'); //fecha de la URL.
            $fechas = $formato;
            $time = explode("-", $formato); //arreglo de la fecha.
            // $formato = date_create_from_format('Y-m-d', $formato)->format('Y-m-d');
            if(!checkdate($time[1], $time[2], $time[0])){//true o false
                echo "<script>location.href='/404';</script>";
            }else{
                $consulta = "SELECT citas.id, citas.Hora, CONCAT( usuarios.Nombre, ' ', usuarios.Apellido) as Cliente, ";
                $consulta .= " usuarios.Email, usuarios.Telefono, servicios.Nombre as Servicios, servicios.Precio  ";
                $consulta .= " FROM citas  ";
                $consulta .= " LEFT OUTER JOIN usuarios ";
                $consulta .= " ON citas.usuarioId=usuarios.id  ";
                $consulta .= " LEFT OUTER JOIN citas_servicios ";
                $consulta .= " ON citas_servicios.citaId=citas.id ";
                $consulta .= " LEFT OUTER JOIN servicios ";
                $consulta .= " ON servicios.id=citas_servicios.servicioId ";
                $consulta .= " WHERE Fecha = '{$fechas}'";  

                //necesitamos hacer una consulta a la base de datos para poder
                //traernos toda esa información que es completamente importante.
                $citasClientes = AdministrationModel::SQL($consulta); 
            }
        
            $router->render('admin/index', [
                //code...
                'nombre' => $_SESSION['Nombre'],
                'id' => $_SESSION['id'],
                'citas' => $citasClientes ?? null,
                'fecha' => $fechas
            ]);
        }
    }
?>