<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Para obtener una cuenta debes llenar los siguientes campos</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/made_count" class="formulario" method="POST">
    <div class="contenido">
        <label for="Nombre">Nombre:</label>
        <input type="text" 
            id="Nombre" 
            name="Nombre"
            placeholder="Coloca tu nombre" 
            value="<?php echo s($usuario->Nombre); ?>">
    </div>
    <div class="contenido">
        <label for="Apellido">Apellido:</label>
        <input type="text" 
            id="Apellido" 
            name="Apellido"
            placeholder="Coloca tu apellido" 
            value="<?php echo s($usuario->Apellido); ?>">
    </div>
    <div class="contenido">
        <label for="Telefono">Teléfono:</label>
        <input type="tel" 
            id="Telefono" 
            name="Telefono"
            placeholder="Coloca tu número telefónico"
            value="<?php echo s($usuario->Telefono); ?>">
    </div>
    <div class="contenido">
        <label for="Email">Email:</label>
        <input type="email" 
            id="Email" 
            name="Email"
            placeholder="Coloca tu email"
            value="<?php echo s($usuario->Email); ?>">
    </div>
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
        value="Crear cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
    <a href="/forget">¿Olvidaste tu password?</a>
</div>
