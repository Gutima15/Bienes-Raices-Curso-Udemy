<fieldset>
    <legend>Datos de entrada</legend>
    <label for="bName">Título:</label>
    <input type="text" id="bName" name="title" placeholder="Título de la entrada" value="<?php echo scapeHtml($entry->title) ?>" >

    <label for="summary">Breve resumen:</label>
    <textarea type="text" id="summary" name="summary" placeholder="Cuente un poco sobre esta entrada"><?php echo scapeHtml($entry->summary) ?></textarea>
    
    <label for="entryText">Texto de la entrada:</label>
    <textarea type="text" id="entryText" name="entryText" placeholder="Comentario del blog"><?php echo scapeHtml($entry->entryText) ?></textarea>
    
    <label for="image">Imagen:</label>
    <input type="file" id="image" name="image" accept="image/jpeg, image/png" name='image' >
    <?php if($entry->image){?>
        <img src="/images/<?php echo $entry->image ?>" class="image__update-view">
    <?php } ?>
</fieldset>