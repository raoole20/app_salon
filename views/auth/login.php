
<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion con tus Datos</p>

<?PHP 
    include_once __DIR__ . '/../template/alertas.php';
?>
<form action="/" class="formulario" method="POST" >

    <div class="campo">
        <label for="email" id="">Email</label>
        <input 
          type="email"
          id  = "email"
          placeholder="Tu email"
          name="email"
        >
    </div>

    <div class="campo">
        <label for="password" id="">Password</label>
        <input 
          type="password"
          id  = "password"
          placeholder="Tu password"
          name="password"
        >
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">

</form>

<div class="accion">
    <a href="/crear-cuenta">Aun no tienes una Cuenta?</a>
    <a href="/olvide">Olvidate Tu Password?</a>
</div>