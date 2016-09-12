<?php
/*
Template Name: Contacto
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
        <h1 class="title">Nos interesa saber de ti</h1>
        <div class="descrcon">Tus opiniones, sugerencias, dudas y cualquier otra clase de mensajes serán bienvenidos.</div>

        <div class="row">
          <div class="col-sm-4 hidden-xs">
            &nbsp;
          </div><!-- imagen tel -->
          <div class="col-sm-4">
            <div class="form-con">
              <?php echo do_shortcode('[contact-form-7 id="325590" title="Formulario de contacto"]'); ?>
            </div>
            <ul class="infocon">
              <li class="email"><i class="fa fa-envelope"></i> <a href="mailto:info@gestiopolis.com">info@gestiopolis.com</a></li>
              <li class="twitter"><i class="fa fa-twitter"></i> <a href="http://www.twitter.com/gestiopoliscom">@gestiopoliscom</a></li>
              <li class="facebook"><i class="fa fa-facebook"></i> <a href="http://www.facebook.com/gestiopolis">facebook.com/gestiopolis</a></li>
              <li class="phone"><i class="fa fa-phone"></i> (0571) 6333200</li>
              <li class="dir"><i class="fa fa-building"></i> Cr. 53 127-70 T1 Of. 604</li>
              <li class="map"><i class="fa fa-map-marker"></i> Bogotá, Colombia</li>
            </ul>
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
