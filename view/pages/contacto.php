<main class="contenedor seccion">
    <h1 data-cy="contact_header">Contacto</h1>
    <?php if($mjs){ ?>
            <p data-cy="alert-p" class="alerta exito"><?php echo $mjs ?></p>
    <?php } ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt=" " loading="Lazy">
    </picture>

    <h2 data-cy="contact_form_header" id="formTitle">Llene el formulario de contacto</h2>

    <form data-cy="contact-form" class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="namePI">Nombre</label>
            <input data-cy="name-input" type="text" name="contact[name]" id="name" placeholder="Tu nombre" required>
            <label for="mjs">Mensaje:</label>
            <textarea data-cy="mjs-input" name="contact[mjs]" id="mjs" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones" required >Vende o compra</label>
            <select data-cy="compra_venta-select" name="contact[options]" id="opciones">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="price" >Presupusto</label>
            <input data-cy="price-input" type="number" name="contact[price]" id="price" placeholder="Ingrese un monto" required>
        </fieldset>

        <fieldset>
            <legend>Sobre su contacto</legend>
            <p>¿Como desea ser contactado?</p>
            <div class="forma-contacto" role='radiogroup'>
                <label for="contact_radio1">Teléfono</label>
                <input data-cy="contact-radio" type="radio" name="contact[contact_radio]" id="contact_radio1" value="télefono" required>
                <label for="contact_radio2">E-mail</label>
                <input data-cy="contact-radio" type="radio" name="contact[contact_radio]" id="contact_radio2" value="email" required>
            </div>

            <div id="contact"></div>

        </fieldset>
        <input data-cy="send-button" type="submit" value="Enviar" class="boton-verde" id="formTitle">
    </form>

</main>
