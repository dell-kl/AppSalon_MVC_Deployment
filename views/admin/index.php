<h1 class="nombre-pagina">Panel de Administración</h1>
<p class="descripcion-pagina">Es bueno tenerlo devuelta administrador</p>

<?php

use function PHPSTORM_META\type;

    include_once __DIR__.'/../templates/logout.php';
?>

<h2>Buscar Citas</h2>

<div class="busqueda">
    <form action="" class="formulario">
        <!-- Diferentes contenidos -->
        <div class="contenido">
            <label for="fecha">Fecha:</label>
            <input type="date" 
                id="fecha" 
                name="Fecha"
                value="<?php echo $fecha;?>"
            />
        </div> <!-- .contenido -->
    </form> <!--.formulario-->
</div>

<?php if(count($citas) === 0){
    echo "<p class=\"alerta exito\">No hay cita pendiente</p>";
} ?>

<div class="citas-admin">
    <ul class="citas">
        <?php
            if(!is_null($citas)){
                $idCita = 0;
                foreach($citas AS $key => $cita){
                    if($idCita !== $cita->id){ //imprimer de uno solo. 
                        $totalPagar = 0;
        ?>
        <li>
                <p>ID : <span><?php echo $cita->id; ?></span></p>
                <p>Hora : <span><?php echo $cita->Hora; ?></span></p>
                <p>Cliente : <span><?php echo $cita->Cliente; ?></span></p>
                <p>Email : <span><?php echo $cita->Email; ?></span></p>
                <p>Telefono : <span><?php echo $cita->Telefono; ?></span></p>
                <h3>Servicios</h3>

            <?php
                $idCita = $cita->id; 
           
            } // final del IF
            
            //calcular la cantidad de un precio.
            $totalPagar += $cita->Precio;
            ?>

                <p class="servicio"><?php echo $cita->Servicios . ' '. $cita->Precio; ?></p>

                <?php
                    $ActualID = $cita->id;
                    $proximoID = $citas[$key + 1]->id ?? null;
                 
                    if(esUltimo($ActualID, $proximoID)){ ?>
                       <p>Total : <span><?php echo $totalPagar; ?></span></p>

                       <!--Eliminar los registros.-->
                       <form action="/api/eliminar" class="formulario" method="POST">
                           <input type="hidden" name="id" value="<?php echo $cita->id;?>">
                           <input type="submit" class="boton boton-rojo" value="Eliminar cita">
                       </form>
                 <?php   
                    }
                ?>

        <?php } 
        }//final de FOREACH
           
        ?>
    </ul>
</div>

<?php
    $script = "<script src='/build/js/buscador.js'></script>";
?>