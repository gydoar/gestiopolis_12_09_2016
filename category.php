<?php
$term = get_queried_object();
global $current_user;
get_currentuserinfo();
?>
<div class="post-image">
  <div class="bg-image cat-bg-<?php echo $term->term_id; ?>" style="height: 248px;"></div>
  <div class="vert-center-wrapper">
    <div class="vert-centered">
      <div class="center container">
        <h1 class="title"><i class="fa icon-cat-<?php echo $term->term_id; ?>"></i> <?php single_term_title(); ?></h1>
        <div class="eje-tagline"><?php echo $term->description; ?></div>
        <ul class="catcounts list-unstyled">
          <li><i class="fa fa-file-o"></i> <?php echo $term->count; ?> posts</li>
          <li><i class="fa fa-pencil"></i> <?php autcat($term->term_id); ?> autores</li>
          <?php 
            $args = array('categories' => $term->term_id);
            $tags = get_category_tags($args);
          ?>
          <li><i class="fa fa-tags"></i> <?php echo count($tags); ?> temas</li>
        </ul>
      </div>
    </div>
  </div>        
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div>
        <!-- /1007663/Categoria-Top-728x90 -->
        <div id='div-gpt-ad-1460590183368-1' class="adsce">
        <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1460590183368-1'); });
        </script>
        </div>
      </div>
    </div>
  </div>
  <div class="row title-section">
    <div class="col-sm-12">
      <h2>Se destacan</h2>
      <div class="subtitle">Estos son los posts preferidos por nuestros lectores hoy en <?php single_term_title(); ?></div>
    </div>
  </div>
  <div class="row destacados">
    <div class="col-sm-12">
      <div class="row gafrom from-cat-dest">
        <?php $tposts = get_trending_posts(10, TRENDING_DAYS, $term->term_id);
          $i = 1;
          foreach ($tposts as $tpost) {
            $post_title = stripslashes($tpost->post_title);
            $permalink = get_permalink($tpost->ID);
            $category = get_the_category($tpost->ID);
            $category_id = $category[0]->term_id;
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $tpost->ID ), 'dest-img' );
            if($i == 1){

        ?>
        <div class="col-sm-6 col-md-9 col-lg-6">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-1">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-6 -->
        <?php } else if($i == 2 || $i == 3){ ?>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-2-3">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-3 -->
        <?php } else if($i == 4){ ?>
        <div class="col-sm-6 col-md-9 col-lg-3">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-4">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-3 -->
        <?php } else if($i == 5){ ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-5">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-3 -->
        <?php } else if($i == 6){ ?>
        <div class="col-sm-6 col-md-4 col-lg-6">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-6">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-6 -->
        <?php } else if($i == 7 || $i == 8 || $i == 9 || $i == 10){ ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post gafrom from-cat-dest-7-8-9-10">
            <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
              <div class="bg-image" style="background-image: url(<?php echo $large_image_url[0]; ?>); height: 250px;"></div>
              <div class="overlay"></div>
              <div class="vert-center-wrapper">
                <div class="vert-centered">
                  <div class="text-center">
                    <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
                  </div>
                </div>
              </div>
            </a>
          </article>
        </div><!-- ./col-sm-3 -->
        <?php } $i++; } // fin foreach $tposts ?>
      </div><!-- /.row -->
    </div><!-- /.col-sm-12-->
  </div><!-- /.destacados -->
  <!-- Empieza sección de AUTORES POPULARES -->
  <div class="row title-section">
    <div class="col-sm-12">
      <h2>Autores Populares</h2>
      <div class="subtitle">Quienes han querido compartir sus conocimientos con todos nosotros</div>
    </div>
  </div>
  <div class="row autores-home">
    <div class="col-sm-12">
      <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner gafrom from-cat-autores">
          <?php $authors = get_trending_authors(12, TRENDING_DAYS, $term->term_id); 
            $k = 1;
            foreach ($authors as $author) {
          ?>
          <div class="item<?php if ($k==1){ echo ' active';}?>">
            <div class="trending-author gafrom from-cat-autor-<?php echo get_the_author_meta('nickname', $author->post_author); ?>">
              <a href="<?php echo get_author_posts_url($author->post_author); ?>" data-toggle="tooltip" title="<?php echo number_format_i18n( count_user_posts( $author->post_author ) ); ?> posts de <?php echo get_the_author_meta('display_name', $author->post_author); ?>"><?php echo get_author_color_id($author->post_author); ?></a>
              <div class="author-name"><a href="<?php echo get_author_posts_url($author->post_author); ?>" data-toggle="tooltip" title="<?php echo number_format_i18n( count_user_posts( $author->post_author ) ); ?> posts de <?php echo get_the_author_meta('display_name', $author->post_author); ?>"><?php echo get_the_author_meta('display_name', $author->post_author); ?></a></div>  
            </div>
          </div>
          <?php $k++;} ?>
          </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div><!-- .span12 -->
  </div><!-- .row AUTORES POPULARES -->
  <div class="row">
    <div class="col-sm-12">
      <div>
        <!-- /1007663/Categoria-Mitad-728x90 -->
        <div id='div-gpt-ad-1460590183368-0' class="adsce">
        <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1460590183368-0'); });
        </script>
        </div>
      </div>
    </div>
  </div>
  <div class="row title-section">
    <div class="col-sm-12">
      <h2>Temas tendencia</h2>
      <div class="subtitle">De lo que habla lo que se publica y lee ahora en <?php single_term_title(); ?></div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 temas-archive gafrom from-cat-tags">
      <?php popular_tags_from_category($term->term_id, TRENDING_DAYS, 30)?>
    </div><!-- .col-sm-12 -->
  </div><!-- .row TEMAS -->
</div><!-- .container -->
<!-- Empieza sección de LISTADO DE POSTS -->
<div class="container">
  <div class="row title-section">
    <div class="col-sm-12">
      <h2>Últimos posts en <?php single_term_title(); ?> <i class="fa icon-cat-<?php echo $term->term_id; ?> cat-col-<?php echo $term->term_id; ?>"></i></h2>
    </div>
  </div>
  <div class="row posts-home">
    <div id="recientes" class="gafrom from-cat-posts">
      <?php if(is_category(23)){ ?>
      <script type="text/javascript" src="https://story.ad/advertisement/show_ad/48" async></script> 
      <div id='story-63-48'></div> 
      <?php } ?>
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
</div><!-- .container -->