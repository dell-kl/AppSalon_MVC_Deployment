<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Actualizador de los Servicios</p>


<?php
    include_once __DIR__.'/../templates/logout.php';
    include_once __DIR__.'/../templates/alertas.php';
?>


<!-- Nuestro unico servicio el cual queramos intentar actualizar. -->


<ul class="servicios">
    <li>
        <p>Id : <span><?php echo $servicios->id; ?></span></p>
        <p>Nombre: <span><?php echo $servicios->Nombre; ?></span></p>
        <p>Precio : <span>$<?php echo $servicios->Precio; ?></span></p>

        <form action="" method="POST" class="formulario">
            <fieldset>
                <legend>Actualiza los datos anteriores</legend>

                <div class="contenido">
                    <label for="Nombre">Nombre:</label>
                    <input 
                        type="text" 
                        name="Nombre"
                        id="Nombre"
                        value="<?php echo $servicios->Nombre; ?>"
                        />
                </div>

                <div class="contenido">
                    <label for="Precio">Precio:</label>
                    <input 
                        type="number" 
                        name="Precio"
                        id="Precio"
                        value="<?php echo $servicios->Precio; ?>"
                        />
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit"  value="Actualizar" class="boton boton-azul">
            </fieldset>
        </form>
    </li>
</ul>

