<div class="author-info gafrom from-post-author-info">
  <?php if(get_post_meta($post->ID, "author-name_value", true) != "") : ?>
  <?php //echo get_author_color_id(); ?> <a href="#autores" rel="author" class="fn"><?php echo get_the_author();//echo get_post_meta($post->ID, "author-name_value", true); ?></a>
  <?php else : ?>
  <?php //echo get_author_color_id(); ?> <a href="#autores" rel="author" class="fn"><?php echo get_the_author(); ?></a>
  <?php endif; ?>
</div>
<ul class="list-unstyled">
  <?php 
  $categories = get_the_category(); 
  foreach($categories as $category){
    echo '<li class="catego cat-col-'.$category->term_id.' gafrom from-post-categories"><i class="fa icon-cat-'.$category->term_id.'"></i> <a class="cat-col-'.$category->term_id.'" href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a></li>';
  }
  ?>
  <li><time class="entry-date published" datetime="<?php echo get_the_time('c'); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('d.m.Y'); ?></time></li>
  <time class="entry-date updated hidden" datetime="<?php echo get_the_modified_time('c'); ?>"><?php echo get_the_modified_date('d.m.Y'); ?></time>
  <li class="estimate-time"><i class="fa fa-clock-o"></i> <?php echo estimate_time();?> de lectura</li>
</ul>