<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>

    <?php
        if($result){
            $mjs = showNotification(intval($result));
            if($mjs){ ?>
                <p class="alerta exito"> <?php echo scapeHtml($mjs)?> </p>
            <?php } 
            } ?>  
    
    <input type="button"class="boton boton-verde" value="Nueva Propiedad" onclick = "location.href='properties/create'">
    <input type="button"class="boton boton-amarillo" value="Nuevo Agente" onclick = "location.href='agents/create'">
    <input type="button"class="boton boton-verde" value="Nueva entrada de blog" onclick = "location.href='admin_blog/create'">

    <h2>Propiedades</h2>
    <table class="properties">  <!--Showing DB Results-->
        <thead>
            <tr>
                <th>ID</th>
                <th for="pName">Nombre</th>
                <th>Imagen</th>
                <th for="pPrice">Precio</th>
                <th for="pAccions">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($properties as $property){?>
                <tr>
                    <td><?php echo $property->id ?></td>
                    <td id="pName"><?php echo $property->title ?></td>
                    <td ><img src="/images/<?php echo $property->image ?>" class="imagen-tabla"></td>
                    <td id="pPrice">$<?php echo $property->price ?></td>
                    <td id="pAccions" >                    
                        <input type="button"class="boton-verde-block" value="Editar" id="acciones" onclick= "location.href='/properties/update?id=<?php echo $property->id ?>'">
                        <!-- Find another way later -->
                        <form method="POST" action="/properties/delete">
                            <input type="hidden" name="id" value="<?php echo $property->id ?>">
                            <input type="hidden" name="type" value="property">
                            <input type="submit" class="boton-rojo-block" value="Eliminar"> 
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Agentes de venta</h2>
    <table class="properties">  <!--Showing DB Results-->
        <thead>
            <tr>
                <th>ID</th>
                <th for="aName">Nombre</th>
                <th>Teléfono</th>        
                <th for="aActions">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($agents as $agent){ ?>
            <tr>
                <td><?php echo $agent->id ?></td>
                <td id="aName"><?php echo $agent->aName . " " . $agent->lastname ?></td>
                <td id="pPhone"><?php echo $agent->phone ?></td>
                <td id="aActions" >                    
                    <input type="button"class="boton-verde-block" value="Editar" id="acciones" onclick= "location.href='/agents/update?id=<?php echo $agent->id ?>'">
                    <!-- Find another way later -->
                    <form method="POST" action="/agents/delete">
                        <input type="hidden" name="id" value="<?php echo $agent->id ?>">
                        <input type="hidden" name="type" value="agent">
                        <input type="submit" class="boton-rojo-block" value="Eliminar"> 
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>    
    
    <h2>Entradas de blog</h2>
    <table class="properties">  <!--Showing DB Results-->
        <thead>
            <tr>
                <th>ID</th>
                <th for="eTitle">Titulo</th>
                <th for="lastUpdate"> Última actualización</th>        
                <th for="editor">Último editor</th>
                <th for="eActions">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($entries as $entry){ ?>
            <tr>
                <td><?php echo $entry->id ?></td>
                <td id="eTitle"><?php echo $entry->title?></td>
                <td id="lastUpdate"><?php echo $entry->publicationDate?></td>
                <td id="editor"><?php echo $entry->createdBy?></td>
                <td id="eActions" >                    
                    <input type="button"class="boton-verde-block" value="Editar" id="acciones" onclick= "location.href='/admin_blog/update?id=<?php echo $entry->id ?>'">
                    <!-- Find another way later -->
                    <form method="POST" action="/agents/delete">
                        <input type="hidden" name="id" value="<?php echo $agent->id ?>">
                        <input type="hidden" name="type" value="agent">
                        <input type="submit" class="boton-rojo-block" value="Eliminar"> 
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table> 

</main>