<?php foreach($entries as $entry){?>
    <article class="entrada-blog">
        <div class="imagen">
            <img src="images/<?php echo $entry->image?>" loading='lazy'>
        </div>
        <div class="texto-entrada">
            <a href='/entrada?id=<?php echo $entry->id;?>'>
                <h4><?php echo $entry->title;?></h4>
                <p class="info-meta"> Escrito el <span><?php echo $entry->publicationDate;?></span> por: <span><?php echo $entry->createdBy;?></span></p>
                <p><?php echo $entry->summary?></p>
            </a>
        </div>
    </article>
<?php }?>