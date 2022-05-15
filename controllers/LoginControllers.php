<?php namespace Controllers;
    use MVC\Router;
    use Models\Usuario;
    use Classes\Mail;

    class LoginControllers{
        //una parte mas del codigo.
        # Revisar todavía una parte del código de login, el cual hay un problema en el redireccionamiento.
        # Parece que el header(location : ) no me quiere redireccionar a las páginas que había definido.
        # Hay que revisar el archivo de php.ini para hacer algunas configuraciones y así permitirme hacer
        # los redireccionamientos pertinentes.
        public static function login(Router $router){
            $alertas = [];
            $usuario = new Usuario;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $usuario = new Usuario($_POST);
                $alertas = $usuario->ValidarLogin();

                if(empty($alertas)){
                    //los datos ingresados del usuario.

                    $datos = Usuario::BaseDeDatos('Email', $usuario->Email);
                    if(is_null($datos)){
                        $alertas = Usuario::setAlerta('error', 'Usuario no registrado');
                    }else{
                        if($datos->PasswordAndConfirmation($usuario->Password)){
                            //return true;
                            // session_start() or die('Error iniciando gestor de variables de sesión');
                            # Comenzamos con el proceso de iniciar sesión.
                            #AUTENTICAR AL USUARIO.
                            #Lo haremos bajo variables session.
                            $_SESSION['id'] = $datos->id;
                            $_SESSION['Nombre'] = $datos->Nombre. ' '. $datos->Apellido;
                            $_SESSION['Email'] = $datos->Email;
                            $_SESSION['login'] = true;
                            //Usar el redireccionamiento. Es importante porque estaremos
                            # viendo, sobre si el usuario es Administrador (1) o solo es
                            # un cliente más (0).
                            #''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                            #Verificamos por el campo de Administrador.
                            if($datos->Admin === '1'){
                                $_SESSION['Admin'] = $datos->Admin ?? null; # -> El valor de 1 del administrador se encuenta aqui.
                                echo "<script>location.href='/admin';</script>";
                            }else{
                                echo "<script>location.href='/cita';</script>";
                            }
                            #''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                        }
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/index', [
                //code...
                'error' => $alertas,
            ]);
        }

        #Funcion static para poder cerrar la sesion abierta.
        public static function salida(){
            // session_start();
            $_SESSION = [];
            echo "<script>location.href='/';</script>";
        }

        #La pagina donde el usuario envia su email para poder volver a reestablecer
        # su cuenta.
        public static function forget(Router $router){
            //code...
            $alertas = [];
            $usuario = new Usuario;
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $mail = s($_POST['Email']);#email usuario
                $usuario = new Usuario($_POST);
                $alertas = $usuario->ValidarEmail();
                if(empty($alertas)){
                    $usuario = Usuario::BaseDeDatos('Email', $usuario->Email);
                    if($usuario && $usuario->Confirmado === "1"){
                        #Cuando el usuario existe y esta confirmado.
                        # Ejecutamos un codigo que lo valide por completo.

                        # Generamos un token para que pueda nuevamente hacer 
                        # un nuevo password el cual se encuentra en otra 
                        # pagina.
                        $usuario->Token();
                            
                        #Email que se le enviara a la persona.
                        $mail = new Mail($usuario->Nombre, $usuario->Apellido, $usuario->Email, $usuario->Token);
                        $mail->InstruccionesParaNuevoPassword();

                        $resultado = $usuario->guardar();
                        if($resultado){
                            $alertas = Usuario::setAlerta('exito', 'Revisa tu bandeja de entrada.');
                        }
                    }else{
                        $alertas = Usuario::setAlerta('error', 'Email no identificado o no confirmado!');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/forget', [
                //code...
                'error' => $alertas
            ]);
        }

        # ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        # Funciones usado en la parte cuando el usuario habra el enlace para
        # volver a crear un nuevo password.
        # ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        # La mayor parte de mi código, lo que hago es depurar variables o funciones que no tienen
        # ninguna funcionalidad en específica. Posiblemente sea que mi mente intentaba crear algo
        # nuevo y me olvide de borrarlas y solamente las comente. En fin, constantemente estoy en
        # el concepto de depurar mi código. Cosa que muchas personas deberíamos hacer.
        public static function recuperar(Router $router){
            //code...
            $alertas = [];
            //Token
            $token = s($_GET['token']);

            $bloqueador = false;

            $usuario = Usuario::BaseDeDatos('Token', $token); #Informacion de la DB
            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            if(is_null($usuario)){
                $bloqueador = true;
                $alertas = Usuario::setAlerta('error', 'Token Eliminado!');
            }else{
                #Contenido generado el cual usaremos para poder actualizar nuestra DB.
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $password = new Usuario($_POST);                
                    if(empty($password->Password)){
                        //codigo que ejecutara un error.
                        $alertas = Usuario::setAlerta('error', 'Debes introducir un password');
                    }else{
                        $passwordNuevo = s($password->Password);
                        $usuario->ValidandoPorPasswordReestablecido($passwordNuevo);
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/recuperar', [
                //informacion que es completamente importante.
                'error' => $alertas,
                'block' => $bloqueador,
            ]);
        }

        public static function make_count(Router $router){
            //code...
            $alertas = [];
            $usuario = new Usuario;
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $usuario->sincronizar($_POST);
                $alertas = $usuario->ValidarNuevaCuenta();

                if(empty($alertas)){
                    //code...
                        if($usuario->UsuarioEncontrar()->num_rows){
                            $alertas = Usuario::getAlertas();
                        }else{

                            #password y token.
                            $usuario->PasswordHash();
                            $usuario->Token();

                            #mensaje de confirmacion
                            $mail = new Mail($usuario->Nombre, $usuario->Apellido, $usuario->Email, $usuario->Token);
                            $mail->EnviarConfirmacion();

                            #Enviar informacion.
                            $resultadoGuardado = $usuario->guardar();
                            if($resultadoGuardado['resultado']){
                               header('Location : /mensaje');
                            }

                        }
                    }   
                }

            $alertas = Usuario::getAlertas();
            $router->render('auth/crear_cuenta', [
                //code...
                
                'usuario' => $usuario,
                'error' => $alertas,
            ]);
        }


        # ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        # En la sección de confirmacion lo que haremos es obtener el token. Luego de eso,            |
        # gracias a una función de activeRecord seguiremos obteniendo los valores de la base de datos.
        # el cual haremos un cambio, como, eliminar el token y cambiar el valor de confirmación a 1. |
        # De ese modo, el código se vuelve mucho más flexible y fácil de manipular. Si es que se     |
        # ha convertido flexible y manipulable....                                                   |
        # ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        public static function confirmar(Router $router){
                $alertas = [];
                $token = s($_GET['token']);
                $usuario = Usuario::where('Token', $token);
                if(empty($usuario)){
                    $alertas = Usuario::setAlerta('error', 'Error en la confirmación de tu cuenta');
                }else{
                    $alertas = Usuario::setAlerta('exito', 'Confirmado Correctamente');
                    $usuario->Confirmado = '1';
                    $usuario->Token = '';

                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location : /');
                    }
                    //cambiaremos loa valores cuando terminemos llamando a la base de datos.
                }
            $alertas = Usuario::getAlertas();
            $router->render('auth/confirmar_cuenta', [
                //code...
                'error' => $alertas
            ]);
        }

        //el modelo de una pagina de mensaje de confirmacion de la cuenta creada.
        public function mensaje(Router $router){
            //code...
            $router->render('auth/mensaje',[]);
        }

    }
?>