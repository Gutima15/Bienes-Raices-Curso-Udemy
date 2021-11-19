<?php 
use Model\Property;

//$consult = getAllAddsData($limit);
if($_SERVER['SCRIPT_NAME' === '/anuncios']){
    $properties = Property::getAll();
} else {
    $properties = Property::getAllLimited($limit);
}

?>
<div class="contenedor-anuncios">
    <?php foreach($properties as $property){ ?>
        <div class="anuncio">
            
            <img src="images/<?php echo $property->image?>" loading='lazy'>
            
            <div class="contenido-anuncio">
                <h3><?php echo $property->title?></h3>
                <p> <?php echo $property->description?> </p>
                <p class="precio">$<?php echo $property->price?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class = "icono" loading= "lazy" src="build/img/icono_wc.svg" alt="baños">
                        <p><?php echo $property->wc?></p>
                    </li>
                    <li>
                        <img class = "icono" loading= "lazy" src="build/img/icono_estacionamiento.svg" alt="Parqueo">
                        <p><?php echo $property->parking?></p>
                    </li>
                    <li>
                        <img class = "icono" loading= "lazy" src="build/img/icono_dormitorio.svg" alt="Cuartos">
                        <p><?php echo $property->rooms?></p>
                    </li>
                </ul>
                <input type="button" value= "Ver propiedad" class="boton-amarillo-block" onclick="location.href='anuncio.php?id=<?php echo $property->id;?>'">
                <!-- <a class="boton-amarillo-block" href="">Ver propiedad</a> -->
            </div>
        </div>   
    <?php } ?>         
</div>