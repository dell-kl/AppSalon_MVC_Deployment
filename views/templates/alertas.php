<?php foreach($error AS $key => $mensajes): 
        foreach($mensajes AS $mensaje): ?>
    <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
    </div>
<?php endforeach; 
 endforeach; 
?>

