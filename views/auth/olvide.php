<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ;?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Cambia Tu Contraseña</p>
        <?php include_once __DIR__ . '/../templates/alertas.php' ;?>

        <form action="/olvide" method="POST" class="formulario" novalidate>
        
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email">
            </div>
            
            <input type="submit" class="boton" value="Recuperar contraseña">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes cuenta?</a>
            <a href="/crear">¿Crea aquí tu cuenta?</a>
        </div>
    <!-- </div>  Contenedor SM -->
</div>