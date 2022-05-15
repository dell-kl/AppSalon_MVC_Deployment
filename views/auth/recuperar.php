<h1 class="nombre-pagina">Recuperar tu cuenta de AppSalon</h1>
<p class="descripcion-pagina ">Para poder recuperar tus datos debes insertar un nuevo password</p>

<?php include_once __DIR__. '/../templates/alertas.php'; ?>

<?php
   // <!-- No debe ingresar el action
   //en el formulario o sino se piertde la referencia del
   // --query string del token--. -->
?>



<form class="formulario
    <?php 
        if($block){
            echo 'ocultarInformacion';
        }else{
            echo '';
        }
    ?>
" method="POST">
    <div class="contenido">
        <label for="Password">Password:</label>
        <input type="password" 
            id="Password" 
            name="Password"
            placeholder="Coloca tu password"
            value="">
    </div>
    <input type="submit" 
        class="submit boton" 
        value="Guardar Password">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
</div>