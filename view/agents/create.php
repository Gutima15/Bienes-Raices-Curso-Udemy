<main class="contenedor seccion">
    <h1 for="pageHeading">Registrar Agente</h1>
    <a class="boton boton-verde" href="/admin">Volver</a>
    <?php foreach($errors as $error):?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
    <?php endforeach?>
    <form class="formulario" method="POST" action="/agents/create">
        <?php include __DIR__ . '/form.php';?>
        <input type="submit" value="Registrar agente" class="boton boton-verde" id="pageHeading">
    </form>
</main>