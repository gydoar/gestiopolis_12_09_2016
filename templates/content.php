<?php 
	$category = get_the_category($post->ID);
?>
<div class="postw col-lg-3 col-md-4 col-sm-6">
  <article id="post-<?php the_ID(); ?>" class="post hentry">
    <time class="entry-date published hidden" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date('d.m.Y'); ?></time>
          <time class="entry-date updated hidden" datetime="<?php echo get_the_modified_time('c'); ?>"><?php echo get_the_modified_date('d.m.Y'); ?></time>
    <div class="wrapper-img">
      <a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'main-thumb' );
      ?>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/grey.gif" data-original="<?php echo $large_image_url[0]; ?>" alt="<?php the_title_attribute(); ?>" class="lazy img-responsive">
        <div class="overlay"></div>
        <div class="vert-center-wrapper">
          <div class="vert-centered">
            <div class="text-center">
              <h2 class="entry-title"><span><?php the_title(); ?></span></h2>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="wrapper-post cat-<?php echo $category[0]->term_id; ?>">
      <div class="cat-bar"></div>
      <div class="wrapper-content clearfix">
        <?php if(!is_author()) { ?>
        <a class="autor author vcard" href="<?php echo get_author_posts_url($post->post_author); ?>">
          <?php echo get_author_color_id(); ?> 
          <?php if(get_post_meta($post->ID, "author-name_value", true) != "") : ?>
          <strong class="fn"><?php echo get_the_author();//echo get_post_meta($post->ID, "author-name_value", true); ?></strong>
          <?php else : ?>
          <strong class="fn"><?php echo get_the_author(); ?></strong>
          <?php endif; ?>
        </a>
        <?php } ?>
        <div class="post-content entry-content">
          <p><?php echo title_trim(220, get_the_excerpt()); ?></p>
        </div>
        <div class="tiempo-fecha">
          <div class="tiempo pull-left"><i class="fa fa-clock-o"></i> <?php echo estimate_time();?> de lectura</div>
          <div class="fecha pull-right"><i class="fa fa-calendar"></i> <?php echo get_the_date('j\.m\.Y'); ?></div>
        </div>
        <?php the_tags('<div class="tags hidden-xs"><i class="fa fa-tags"></i> ',', ','</div>'); ?>
        <div class="category pull-left">
          <?php foreach ($category as $cat) {
            if(is_category()){
              $term = get_queried_object();
              if($cat->term_id != $term->term_id){?>
            <a href="<?php echo get_category_link( $cat->term_id ); ?>" class="cat-col-<?php echo $cat->term_id; ?>"><i class="fa icon-cat-<?php echo $cat->term_id; ?>"></i> <?php echo $cat->cat_name; ?></a>
            <?php } ?>
          <?php }else { ?>
            <a href="<?php echo get_category_link( $cat->term_id ); ?>" class="cat-col-<?php echo $cat->term_id; ?>"><i class="fa icon-cat-<?php echo $cat->term_id; ?>"></i> <?php echo $cat->cat_name; ?></a>
          <?php }}?>
        </div>
      </div>
    </div>
  </article><!-- .post -->
</div><!-- .col-md-3 col-sm-6 -->