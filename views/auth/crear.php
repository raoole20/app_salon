<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?PHP 
    include_once __DIR__ . '/../template/alertas.php';
?>

<form action="/crear-cuenta" class="formulario" method = "POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
           type="text"
           id="nombre"
           name="nombre"
           value="<?php echo s($usuario->nombre); ?>"
           placeholder="Tu Nombre"
           >
           
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
           type="text"
           id="apellido"
           name="apellido"
           value="<?php echo s($usuario->apellido); ?>"
           placeholder="Tu Apellido"
           >
    </div>

    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input 
           type="tel"
           id="Telefono"
           name="telefono"
           value="<?php echo s($usuario->telefono); ?>"
           placeholder="Tu Telefon"
           >
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input 
           type="email"
           id="email"
           name="email"
           value="<?php echo s($usuario->email); ?>"
           placeholder="Tu Email"
           >
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
           type="password"
           id="password"
           name="password"
           placeholder="Tu Password"
           >
    </div>

    <input type="submit" class="boton" value="Crear Cuenta">
</form>

<div class="accion">
    <a href="/crear-cuenta">Ya tienes una Cuenta? Inicia Sesion</a>
    <a href="/olvide">Olvidate Tu Password?</a>
</div>