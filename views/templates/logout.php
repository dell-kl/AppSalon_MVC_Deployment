<div class="identificador-usuario">
    <p>Hola : <?php echo $nombre ?? ''; ?></p>
    
    <a class="boton boton-salida" href="/logout">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['Admin'])){ ?>
    <!-- codigo de HTML a medias. -->
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/servicios">Ver Servicios</a>
        <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
    </div>
<?php } ?>