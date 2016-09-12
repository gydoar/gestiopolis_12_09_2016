<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-blog-header.php');
?>
<?php get_template_part('templates/head'); ?>
<body <?php body_class('error404'); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>

  <div class="wrap" role="document">
    <div class="content">
      <main role="main">
        <div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">No puedes acceder a esta página</h1>
        <div class="descrcon">La buena noticia es que empleando el buscador que está más abajo hallarás valiosos recursos sobre eso que te interesa y te trajo hasta acá.</div>
        <div class="search404">
          <form id="searchbox" action="<?php echo home_url( '/' ); ?>" role="search" class="searchnotf form-inline">
          	<input class="elasticpress-autosuggest form-control input-lg" placeholder="Ingresa tu búsqueda..." type="search" value="" name="s" id="search" data-es-host="216.155.144.251:9200">
	          <input class="submit btn btn-black btn-lg" type="submit" value="Busca">
          </form>
        </div>
        <div class="descrcon hidden">También puedes consultar el ABC temático con todos los tópicos tratados en los posts</div>

        <div class="row posts-home">
		      <div id="recientes">
	          <?php
	            $recent_args = array(
	              'posts_per_page' => 12,
	              'post_status'    => 'publish',
	              'orderby'        => 'date'
	            );
	            $the_query = new WP_Query( $recent_args );

	            if ( $the_query->have_posts() ) :
	              while ( $the_query->have_posts() ) : $the_query->the_post();

	                get_template_part( 'templates/content', 'recents' );
	            
	              endwhile;
	              ?>
	            <?php endif;
	            wp_reset_query(); 
	            wp_reset_postdata(); ?>
	        </div><!-- #recientes -->
	        <div class="row">
	        	<div class="col-sm-6 col-sm-offset-3">
	        		<a class="link404 btn btn-green" href="<?php echo esc_url(home_url('/#recientes')); ?>">Ver posts más recientes</a>
	        	</div>
	        </div>
	      </div>
      </div><!-- .col-md-12 -->
    </div>
	</div><!-- .container PRINCIPAL -->
</div><!--bgcon-->
      </main><!-- /.main -->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php get_template_part('templates/footer'); ?>

  <?php wp_footer();?>
</body>
</html>