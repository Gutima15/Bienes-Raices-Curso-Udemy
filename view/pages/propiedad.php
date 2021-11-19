<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="property-header"><?php $property->title?></h1>
    <img src="images/<?php echo $property->image?>"  alt=" " loading= "lazy">
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $property->price?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading= "lazy" src="build/img/icono_wc.svg" alt="baños">
                <p><?php echo $property->wc?></p>
            </li>
            <li>
                <img class="icono" loading= "lazy" src="build/img/icono_estacionamiento.svg" alt="Parqueo">
                <p><?php echo $property->parking?></p>
            </li>
            <li>
                <img class="icono" loading= "lazy" src="build/img/icono_dormitorio.svg" alt="Cuartos">
                <p><?php echo $property->rooms?></p>
            </li>
        </ul>
        <p><?php echo $property->description?></p>
    </div>
</main>