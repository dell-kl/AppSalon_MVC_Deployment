<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de los Servicios</p>

<?php
    include_once __DIR__.'/../templates/logout.php';
?>

<?php
    if($mensaje === 1){?>
        <p class="alerta exito">Actualizado Correctamente</p>
<?php   }
?>
<?php
    if($mensaje === 2){?>
        <p class="alerta exito">Eliminado Correctamente</p>
<?php   }
?>

<ul class="servicios">
    <?php foreach($servicios AS $servicio){ ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->Nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->Precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>
                <form action="/servicios/eliminar" method="POST" class="formulario">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" class="boton boton-rojo" value="Eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>
