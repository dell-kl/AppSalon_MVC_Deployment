<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/forget" class="formulario" method="POST">
    <div class="contenido">
        <label for="Email">Email:</label>
        <input type="email"
            id="Email" 
            name="Email"
            placeholder="Coloca tu email">
    </div>
    <input type="submit" 
        class="submit boton" 
        value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
    <a href="/">¿Aún no tienes una cuenta? Crear cuenta</a>
</div>