<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nueva Password</p>

<?PHP 
    include_once __DIR__ . '/../template/alertas.php';

    if($error) return
?>
<form class="formulario" method="POST">

    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu password"
        >
    </div>

    <input type="submit" class="boton" value="Guardar Password">
</form>


<div class="acciones">
    <a href="/">Ya tienes cuenta? iniciar sesion</a>
</div>
