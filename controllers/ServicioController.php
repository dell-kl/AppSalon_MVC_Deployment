<?php namespace Controllers;

    use Models\Servic;
    use MVC\Router;

    class ServicioController{
        public static function index(Router $router){
            //code...
            isAdmin();

            $mensaje = $_GET['mensaje'] ?? null;
            $mensaje = filter_var($mensaje, FILTER_VALIDATE_INT);
    

            $servicios = Servic::all();

            $router->render('servicios/index',[
                'nombre' => $_SESSION['Nombre'],
                'servicios' => $servicios,
                'mensaje' => $mensaje
            ]);
        }

        public static function crear(Router $router){
            //code...
            isAdmin();

            //importamos el modelo de servicio.
            $servicio = new Servic();
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $servicio->sincronizar($_POST);
                
                $alertas = $servicio->validar();

                if(empty($alertas)){
                    //code.
                    $servicio->guardar();       
                    echo "<script>location.href='/servicios';</script>";
                }
            }

            
            $router->render('servicios/create', [
                'nombre' => $_SESSION['Nombre'],
                'Nombre' => $servicio->Nombre,
                'Precio' => $servicio->Precio,
                'error' => $alertas,
            ]);
        }

        public static function actualizar(Router $router){
            isAdmin();
            //filtrando por el query y haciendo una validacion para que sea un numero...
            // y no otra cosa.
            $identificador = $_GET['id'] ?? null;
            $alertas = [];
            if(is_numeric($identificador)){
                $servicio = Servic::find($identificador);
                    
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $servicio->sincronizar($_POST);
                    $alertas = $servicio->validar();
                    if(empty($alertas)){
                        $resultado = $servicio->guardar();
                        if($resultado){
                            echo "<script>location.href='/servicios?mensaje=1';</script>";
                        }
                    }
                }
            }else{
                echo "<script>location.href='/admin';</script>";
            }
       
            $router->render('servicios/actualizar', [
                'nombre' => $_SESSION['Nombre'],
                'servicios' => $servicio,
                'id' => $identificador,
                'error' => $alertas
            ]);
        }

        public static function eliminar(){
            isAdmin();
            //code...
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                //code...
                $servicio = Servic::find($_POST['id']);
                $resultado = $servicio->eliminar();
                echo "<script>location.href='/servicios?mensaje=2'</script>";
            }
        }

    }
?>