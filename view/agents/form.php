<fieldset>
    <legend>Información general</legend>
    <label for="aName">Nombre:</label>
    <input type="text" id="aName" name="aName" placeholder="Nombre del agente" value="<?php echo scapeHtml($agent->aName) ?>">

    <label for="lastname">Primer apellido:</label>
    <input type="text" id="lastname" name="lastname" placeholder="Apellido" value="<?php echo scapeHtml($agent->lastname) ?>">

    <label for="phone">Teléfono:</label>
    <input type="text" id="phone" name="phone" placeholder="Teléfono" value="<?php echo scapeHtml($agent->phone) ?>">
</fieldset>