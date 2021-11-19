<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-loading" for="pageHeading">Iniciar sesión</h1>

    <?php foreach( $errors as $error){?>
        <div data-cy="alert-div" class="alerta error"><?php echo $error?></div>
    <?php } ?>
    <form data-cy="login-form" method="POST" class="formulario">
        <fieldset>
            <legend>Datos de ingreso</legend>       
            
            <label for="email">E-mail</label>
            <input data-cy="email-input" type="email" name="email" id="email" placeholder="Tu email" >
            
            <label for="passWord">Contraseña</label>
            <input data-cy="password-input" type="password" name="passWord" id="passWord" placeholder="Tu contraseña" >
        </fieldset>
        <input data-cy="login-button" type="submit" value="Iniciar sesión" class="boton boton-verde" id="pageHeading">
    </form>
</main>

