<h1 class="nombre-pagina">Crear nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php 
    include_once __DIR__.'/../templates/logout.php';
?>

<!-- Dentro de esta parte crearemos un codigo el cual pueda ver por nuestra app -->
<div class="app">
    <nav class="navegacion">
        <!--.activo -->
        <button class="activo" type="button" data-paso="1">Servicios</button>
        <button class="" type="button" data-paso="2">Información Cita</button>
        <button class="" type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion"> 
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios">
            <!-- Servicios -->
        </div>
    </div> <!-- PASO UNO -->

    <div id="paso-2" class="seccion">
        <h2>Tus datos y citas</h2>
        <p class="text-center">Elige tus datos y fecha de tus citas</p>

        <form class="formulario" action="" method="POST">
            <div class="contenido">
                <label for="Nombre">Nombre:</label>
                <input 
                    type="text" 
                    id="Nombre" 
                    value="<?php echo $nombre; ?>"
                    placeholder="Tu nombre"
                    disabled
                    class="aspecto"
                />
            </div>
            <div class="contenido">
                <label for="fecha">Fecha:</label>
                <input 
                    type="date" 
                    name="Fecha"
                    id="fecha" 
                    value=""
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                />
            </div>
            <div class="contenido">
                <label for="hora">Hora:</label>
                <input 
                    type="time" 
                    name="Hora"
                    id="hora" 
                    value=""
                />
            </div>
            <?php //el input oculto sera una referencia al identificador del usuario. ?>
            <input type="hidden" value="<?php echo $id; ?>" id="id">
        </form> <!-- .formulario -->
    </div> <!-- PASO DOS -->

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div> <!-- PASO TRES -->

    <div class="paginacion">
        
        <button
            id="anterior" 
            class="boton_cita"
        >&laquo;Anterior</button>

        <button
            id="siguiente"
            class="boton_cita"
        >Siguiente&raquo;</button>

    </div>
</div>

<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/app.js'></script>
    "
?>