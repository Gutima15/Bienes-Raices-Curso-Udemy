<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $entry->title?></h1>
    <p class="info-meta">Escrito el <span><?php echo $entry->publicationDate?></span> por: <span><?php echo $entry->createdBy?></span></p>
    <picture>
        <img src="images/<?php echo $entry->image?>" loading='lazy'>
    </picture>
    <div class="resumen-propiedad">
        <p><?php echo $entry->entryText?></p>
    </div>
</main>