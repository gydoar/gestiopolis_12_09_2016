<?php
$curaut = get_queried_object();
global $current_user;
get_currentuserinfo();
?>
<!-- Empieza sección de LISTADO DE POSTS -->
<div class="post-image">
  <div class="bg-image" style="background: #edede4; height: 25rem;"></div>
  <div class="vert-center-wrapper">
    <div class="vert-centered">
      <div class="center container" itemscope itemtype="http://schema.org/Person">
        <?php echo get_author_color_id($curaut->ID); ?>
        <h1 class="title" itemprop="name"><?php echo $curaut->display_name; ?></h1>
        <span itemprop="description" class="autdesc"><?php echo get_the_author_meta('description', $curaut->ID); ?></span><?php if(get_the_author_meta('description', $curaut->ID) != ''){?><a href="#" class="see-more">Ver más...</a><a style="display:none;" href="#" class="see-less">Ver menos...</a><?php } ?>
        <div class="autsocial">
          <ul class="list-unstyled">
            <?php if($curaut->user_email != '') { ?>
            <li><a itemprop="email" href="mailto:<?php echo antispambot($curaut->user_email); ?>"><i class="fa fa-envelope-square"></i></a></li>
            <?php } ?>
            <?php if($curaut->user_url != '') { ?>
            <li><a itemprop="url" href="<?php echo $curaut->user_url; ?>"><i class="fa fa-external-link-square"></i></a></li>
            <?php } ?>
            <?php if(get_user_meta($curaut->ID, 'googleplus', true) != '') { ?>
            <li><a href="<?php echo get_user_meta($curaut->ID, 'googleplus', true); ?>"><i class="fa fa-google-plus-square"></i></a></li>
            <?php } ?>
            <?php if(get_user_meta($curaut->ID, 'twitter', true) != '') { ?>
            <li><a href="http://www.twitter.com/<?php echo get_user_meta($curaut->ID, 'twitter', true); ?>"><i class="fa fa-twitter-square"></i></a></li>
            <?php } ?>
            <?php if(get_user_meta($curaut->ID, 'facebook', true) != '') { ?>
            <li><a href="<?php echo get_user_meta($curaut->ID, 'facebook', true); ?>"><i class="fa fa-facebook-square"></i></a></li>
            <?php } ?>
            <?php if(get_user_meta($curaut->ID, 'linkedin', true) != '') { ?>
            <li><a href="<?php echo get_user_meta($curaut->ID, 'linkedin', true); ?>"><i class="fa fa-linkedin-square"></i></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>        
</div>
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
      </div>
      </div><!-- .row -->
    </div><!-- .span12 -->
  </div><!-- .row LISTADO DE POSTS -->
<!--</div>--><!-- .container -->