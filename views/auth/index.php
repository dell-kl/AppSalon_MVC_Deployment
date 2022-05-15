<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Llena los campos para poder iniciar sesión</p>

<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<form action="/" class="formulario" method="POST">
    <div class="contenido">
        <label for="Email">Email:</label>
        <input type="email"
            id="Email" 
            name="Email"
            placeholder="Coloca tu email">
    </div>
    <div class="contenido">
        <label for="Password">Password:</label>
        <input type="password" 
            id="Password" 
            name="Password"
            placeholder="Coloca tu password">
    </div>
    <input type="submit" 
        class="submit boton" 
        value="Iniciar sesión">
</form>

<div class="acciones">
    <a href="/made_count">¿Aún no tienes una cuenta? Crear cuenta</a>
    <a href="/forget">¿Olvidaste tu password?</a>
</div>