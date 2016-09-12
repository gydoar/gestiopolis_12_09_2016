
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-9">
        <h1 class="title">Resultados de la búsqueda: "<?php echo get_search_query(); ?>"</h1>
        <div id="publicaciones">
          <?php while (have_posts()) : the_post(); 
            get_template_part( 'templates/content', 'search' );
           endwhile; ?>
           <?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
          <div class="pagination">
            <?php wp_pagenavi(); ?>
          </div>
          <?php } else { ?>
          <div class="pagination">
            <div class="nav-previous alignleft"><?php next_posts_link( 'Artículos anteriores' ); ?></div>
          </div>
          <?php } ?>
        </div>
      </div><!-- .col-sm-12 -->
      <div class="hidden-xs hidden-sm col-md-3">
        <?php get_template_part('templates/sidebar-search'); ?>
      </div><!--.col-sm-3-->
    </div>
</div><!-- .container PRINCIPAL -->