<?php
/*
Template Name: Formulario de Publicidad
*/
?>
<?php
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
    }
 
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
    }
?>

<?php while (have_posts()) : the_post(); ?>
<div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">Formulario de Publicidad</h1>
        <div class="descrcon">Si estás interesado en conocer las opciones publicitarias de GestioPolis llena el siguiente formulario.</div>

        <div class="row">
          <div class="col-sm-4 hidden-xs">
            &nbsp;
          </div><!-- imagen tel -->
          <div class="col-sm-4">
            <div class="form-con">
              <?php echo do_shortcode('[contact-form-7 id="334631" title="Formulario de Publicidad"]'); ?>
            </div>
          </div>
          <div class="col-md-4">
            &nbsp;            
          </div>
        </div>
      </div><!-- .col-md-12 -->
      
    </div>

  </div><!-- .container PRINCIPAL -->
</div><!--bgcon-->
<?php endwhile; ?>
