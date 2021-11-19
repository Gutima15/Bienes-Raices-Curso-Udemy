<main class="contenedor seccion">
    <h2 data-cy="us_header">Más sobre nosotros</h2>
    <?php require 'icons.php';?>
</main>

<section class="seccion contenedor">
    <h2>Casas y departamentos en ventas</h2>
    
    <?php 
        $limit = 3;
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <input data-cy="seeAll_properties_btn" type="button" value= "Ver todas" class="boton-verde" onclick="location.href='/propiedades?'">
    </div>
</section>

<section class="imagen-contacto" data-cy="contact_section" >
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo.</p>
    <input type="button" value= "Contáctanos" class="boton-amarillo" onclick="location.href='/contacto?'">
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog" data-cy="blog_section">
    <h3>Nuestro blog</h3>
        <?php     
            include 'listadoBlog.php';
        ?>
    </section>

    <section class="testimoniales" data-cy="testimonial_section">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó excelente, me diero una buena atención
                y la casa que me ofecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Juan de la Torre</p>
        </div>
    </section>

</div>