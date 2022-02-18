<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece Tu Password, Escribe tu E-mail</p>

<?PHP 
    include_once __DIR__ . '/../template/alertas.php';
?>

<form action="/olvide" class="formulario" method="POST">

    <div class="campo">
        <label for="email">
            Email
        </label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu E-mail"
            >
    </div>

    <input type="submit" class="boton" value="Enviar correo"> 
</form>

<div class="accion">
    <a href="/crear-cuenta">Ya tienes una Cuenta? Inicia Sesion</a>
    <a href="/olvide">Aun no tienes una Cuenta? Crear Una</a>
</div>