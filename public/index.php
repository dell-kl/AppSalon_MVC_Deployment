<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginControllers;
use Controllers\CitaControllers;
use Controllers\ApiControllers;
use Controllers\AdminControllers;
use Controllers\ServicioController;
$router = new Router();
#Iniciar algunas rutas bajo una sola clase en particular el cual vamos a generar.

# '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
#                           PUBLICAS
# '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//Iniciar Sesión.
$router->get('/', [LoginControllers::class, 'login']);
$router->post('/', [LoginControllers::class, 'login']);

#Cerrar sesion.
#No contiene ningun estilo posiblemente sea como una bandera indicadora que cerraremos la 
#conexion. 
$router->get('/logout', [LoginControllers::class, 'salida']); 
//Recuperar Password.
$router->get('/forget', [LoginControllers::class, 'forget']);
$router->post('/forget', [LoginControllers::class, 'forget']);
$router->get('/recuperar', [LoginControllers::class, 'recuperar']);
$router->post('/recuperar', [LoginControllers::class, 'recuperar']);
//Crear cuenta
$router->get('/made_count', [LoginControllers::class, 'make_count']);
$router->post('/made_count', [LoginControllers::class, 'make_count']);
//confirmar cuenta
$router->get('/confirmar-cuenta', [LoginControllers::class, 'confirmar']);
$router->get('/mensaje', [LoginControllers::class, 'mensaje']);


# '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
#                                   PRIVADAS
# '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
#PAGINAS SENSIBLES.... 
$router->get('/cita',[CitaControllers::class, 'cita']);
$router->post('/cita',[CitaControllers::class, 'cita']);
$router->get('/admin',[AdminControllers::class, 'admin']);
$router->post('/admin',[AdminControllers::class, 'admin']);


#''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
#                                   API DE CITAS
#''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
#Nuestra api de desarrollo.
$router->get('/api/servicios',[ApiControllers::class, 'setting']);
#Enviar la informacion desde nuestro archivo javascript . 
$router->post('/api/citas', [ApiControllers::class, 'guardando']);
#Eliminar
$router->post('/api/eliminar', [ApiControllers::class, 'eliminar']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador

# '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                                # CRUD de Servicios.
#''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

$router->comprobarRutas();