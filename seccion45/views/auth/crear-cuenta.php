<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llene el siguiente formulario para crear una cuenta </p>

<?php 
    include_once __DIR__ . "/../template/alertas.php";
?>

<form class="formulario" method="POST" >
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text"  name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre);?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text"  name="apellido" id="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido);?>">
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel"  name="telefono" id="telefono" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono);?>">
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"  name="email" id="email" placeholder="Tu email" value="<?php echo s($usuario->email);?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password"  name="password" id="password" placeholder="Tu password">
    </div>

    <input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
    <a href="/public">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/public/olvidar">¿Olvidaste tu password?</a>
</div>