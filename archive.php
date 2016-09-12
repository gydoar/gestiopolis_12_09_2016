<?php
$date = get_queried_object();
global $current_user;
get_currentuserinfo();
?>
<div class="post-image">
  <div class="bg-image" style="background: #edede4; height: 120px;"></div>
  <div class="vert-center-wrapper">
    <div class="vert-centered">
      <div class="center container">
        <h1 class="title">
          <?php
            if ( is_month() ) :
              echo get_the_date( 'F \- Y');

            elseif ( is_year() ) :
              echo get_the_date( 'Y');

            endif;
          ?>
        </h1>
      </div>
    </div>
  </div>        
</div>
<!-- Empieza sección de LISTADO DE POSTS -->
<div class="container">
  <!-- Empieza sección de TÍTULO DE CATEGORÍA -->
  <div class="row posts-home">
    <div class="col-md-12">
      <div class="row tab-content">
        <div class="tab-pane active" id="publicaciones">
          <?php
            if ( have_posts() ) :
              // Start the Loop.
              while ( have_posts() ) : the_post();

                /*
                 * Include the post format-specific template for the content. If you want to
                 * use this in a child theme, then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                get_template_part( 'templates/content' );
            
              endwhile;
              ?>
              <?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
              <div class="pagination">
                <?php wp_pagenavi(); ?>
              </div>
              <?php } else { ?>
              <div class="pagination">
                <div class="nav-previous alignleft"><?php next_posts_link( 'Artículos anteriores' ); ?></div>
              </div>
              <?php } ?>
              <?php
            endif;
          ?>
        </div><!-- #recientes -->
      </div><!-- .row -->
    </div><!-- .span4 -->
  </div><!-- .row LISTADO DE POSTS -->
</div><!-- .container -->