<?php
/*
Template Name: Acerca de
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">Acerca de gestiopolis</h1>
        
        <div class="row">
          <div class="col-sm-2">
            <!--<nav class="aboutsidebar hidden-print hidden-xs hidden-sm" data-spy="affix" data-offset-top="150" data-offset-bottom="200">
              <ul class="nav aboutnav">
                <li class="active"><a href="#quees"><i class="fa fa-question"></i> Qué es</a></li>
                <li><a href="#linea"><i class="fa fa-info"></i> Línea de tiempo</a></li>
                <li><a href="#vision"><i class="fa fa-crosshairs"></i> Visión</a></li>
                <li><a href="#mision"><i class="fa fa-exclamation"></i> Misión</a></li>
                <li><a href="#equipo"><i class="fa fa-group"></i> Equipo</a></li>
                <li><a href="#cifras"><i class="fa fa-list-ol"></i> En cifras</a></li>
              </ul>
            </nav>-->
            &nbsp;
          </div><!-- imagen tel -->
          <div class="col-sm-8 aboutsections">
            <section id="quees">
              <p>La palabra gestiópolis fusiona la raíz latina <em>gestĭo</em> con la raíz griega <em>polis</em> (πόλις). La primera hace referencia a la acción y efecto de gestionar o administrar, sabiendo que administrar etimológicamente significa <strong>servir</strong>. La segunda definía a las ciudades estado griegas que representaban el centro político, cultural y ciudadano de la <strong>sociedad</strong>.</p>
              <p>En tal sentido, gestiopolis.com está para servir a la sociedad a través de un entorno virtual que les posibilita compartir y adquirir conocimientos a las personas que desean desarrollar sus competencias personales y profesionales en los campos vinculados con la administración, la empresa y la economía.</p>
              <p>Una historia larga hecha corta: <strong>gestiopolis.com está para potenciar tu conocimiento en negocios</strong>.</p>
              <p>Desde siempre nos ha inspirado una frase que sintetiza el rotundo poder generado al compartir conocimientos, fue hecha por el prolífico escritor irlandés <u>George Bernard Shaw</u> y reza:</p>
              <blockquote>Si tienes una manzana, yo tengo una manzana y las intercambiamos entonces tanto tú como yo seguiremos teniendo una manzana. Pero si tú tienes una idea, yo tengo una idea y las intercambiamos entonces ambos tendremos dos ideas".</blockquote>
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/compartir-ideas.png'); ?>" alt="Compartir ideas" width="256" height="256" class="center-block">
              <p>En gestiopolis.com confluyen estudiantes, profesionales independientes, ejecutivos, mandos medios, empresarios pyme, dirigentes corporativos, docentes y muchas otras personas que encuentran en él una extensa cantidad de información relevante y útil, tanto para mantenerse actualizados en las nuevas tendencias, como para adelantar sus labores académicas o las tareas propias de sus empleos.</p> 
            </section>
            <!--<section id="linea"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/linea.jpg'); ?>" alt="Línea de tiempo de Gestiopolis" width="816" height="136" class="center-block"></section>
            <section id="vision"><p>Nos proyectamos como el referente digital en latinoamérica en las áreas de estudio relacionadas con la administración, la empresa y la economía.</p></section>
            <section id="mision"><p>Proveer a las personas que nos consultan la información que requieren y facilitar su desarrollo a través de soluciones de capacitación que promuevan su éxito personal y profesional.</p></section>
            <section id="equipo">
              
            </section>
            <section id="cifras"></section>-->

          </div>
          <div class="col-sm-2">&nbsp;</div>
        </div><!-- .row -->
      </div><!-- .col-sm-12 -->

    </div>
  </div><!-- .container PRINCIPAL -->
<?php endwhile; ?>
