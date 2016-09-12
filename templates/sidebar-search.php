<?php global $post; ?>
<div class="right-post">
  <div class="sidebar-post">
    <h3>Populares</h3>
    <i class="fa fa-caret-down"></i>
    <?php 
    $tposts = get_trending_posts(16, TRENDING_DAYS);
    foreach ($tposts as $tpost) {
      $post_title = stripslashes($tpost->post_title);
      $permalink = get_permalink($tpost->ID);
      $category = get_the_category($tpost->ID);
      $category_id = $category[0]->term_id;
      ?>
    <article id="post-<?php echo $tpost->ID;?>" class="post">
      <div class="wrapper-img">
        <a href="<?php echo get_permalink($tpost->ID); ?>" title="<?php echo $post_title; ?>" rel="bookmark">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/grey.gif" data-original="<?php echo get_post_meta($tpost->ID, "Thumbnail", true); ?>" alt="<?php the_title_attribute(); ?>" class="lazy img-responsive">
          <div class="overlay"></div>
          <div class="vert-center-wrapper">
            <div class="vert-centered">
              <div class="text-center">
                <h2 class="entry-title"><span><?php echo $post_title; ?></span></h2>
              </div>
            </div>
          </div>
        </a>
      </div>
    </article>
    <?php } // fin foreach $tposts ?>
  </div><!-- .sidebar-post -->
</div><!-- .right-post -->