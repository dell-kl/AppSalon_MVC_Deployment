<div class="contenido">
        <label for="Nombre">Nombre:</label>
        <input type="text" 
            id="Nombre" 
            name="Nombre"
            placeholder="Colocar el nombre del servicio" 
            value="<?php echo s($Nombre); ?>"
            />
</div>

<div class="contenido">
    <label for="Precio">Precio</label>
    <input 
        type="number" 
        id="Precio"
        name="Precio"
        placeholder="Precio de tu servicio nuevo"
        value="<?php echo s($Precio); ?>"
    >
</div>