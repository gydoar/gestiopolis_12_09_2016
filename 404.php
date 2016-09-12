<div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">La página que intentaste ver no existe</h1>
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
