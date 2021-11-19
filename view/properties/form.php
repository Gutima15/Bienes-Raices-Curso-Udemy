<fieldset>
    <legend>Información general</legend>
    <label for="title">Nombre:</label>
    <input type="text" id="title" name="title" placeholder="Nombre de la propiedad" value="<?php echo scapeHtml($property->title) ?>">

    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" placeholder="Precio de la propiedad"value="<?php echo scapeHtml($property->price) ?>">
    
    <label for="image">Imagen:</label>
    <input type="file" id="image" name="image" accept="image/jpeg, image/png" name='image'>
    <?php if($property->image){?>
        <img src="/images/<?php echo $property->image ?>" class="image__update-view">
    <?php } ?>

    <label for="description">descripcion:</label>
    <textarea id="description" name="description"><?php echo scapeHtml($property->description) ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="rooms">Habitaciones:</label>
    <input type="number" id="rooms" name="rooms" placeholder="Ej:3" min="1" max="9" value="<?php echo scapeHtml($property->rooms) ?>">
    
    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo scapeHtml($property->wc) ?>">
    
    <label for="parking">Parqueos:</label>
    <input type="number" id="parking" name="parking" placeholder="Ej:3" min="1" max="9" value="<?php echo scapeHtml($property->parking) ?>">

</fieldset>

<fieldset>
    <legend>Información del vendedor</legend>
    <label for="agentId">Nombre:</label>
    <select id="agentId" name="agentId">
        <option value="">--Selecione--</option>
        <?php foreach($agents as $agent){ ?>
            <option
            <?php echo $property->agentId === $agent->id ? 'selected' : '' ?>
            value="<?php echo scapeHtml($agent->id) ?>"> 
            <?php echo scapeHtml($agent->aName) ." ". scapeHtml($agent->lastname)?> </option>
        <?php };?>
    </select>

</fieldset>