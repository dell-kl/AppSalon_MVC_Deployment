<?php namespace Controllers;
    use Models\Citas;
    use MVC\Router;
    class CitaControllers{
        # Pagina que todos los clientes podran visitar y crear una 
        # cita para que el administrador las pueda observar y administrar.
        public static function cita(Router $router){
            //code...
            // session_start() or die('Error iniciando gestor de variables de sesión'); //contiene información del usuario que hizo login.
            isAuth();
            
            $router->render('file/cita', [
                //code...,
                'nombre' => $_SESSION['Nombre'],
                'id' => $_SESSION['id'],
            ]);
        }
        
    }
?>