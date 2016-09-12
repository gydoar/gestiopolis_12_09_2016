<?php global $post; 
$maincat = get_the_category($post->ID); 
?>
<div class="right-post gafrom from-sidebar-right-post">

  <div class="sidebar-post">
    <h3>Relacionados</h3>
    <i class="fa fa-caret-down"></i>
    <?php 
    $show = 5;
    $postsnot = array();
    $postsnot[] = $post->ID;
    $mainpost = $post->ID;
    $query1 = ci_get_related_posts_1( $post->ID, $show );
    //$countp = 1;
        if( $query1->have_posts() ) { while ($query1->have_posts()) : $query1->the_post(); 
          $postsnot[] = $post->ID;
          if($mainpost != $post->ID){
          ?>
    <article id="post-<?php the_ID(); ?>" class="post">
      <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
      ?>
      <a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=related_posts&ic_source=sidebar" class="internal-campaign"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/grey.gif" data-original="<?php echo $large_image_url[0]; ?>" alt="<?php the_title_attribute(); ?>" class="lazy pull-left" width="64" height="56"></a>
      <div class="wrapper-content">
        <h2 class="entry-title"><a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=related_posts&ic_source=sidebar" class="internal-campaign"><?php the_title(); ?></a></h2>
      </div>
    </article>
    <?php }
      //$countp++; 
     endwhile;?>
    <?php } 
    wp_reset_query(); 
    wp_reset_postdata();
    $show = $show - count($query1->posts);
     if ($show > 0) {
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $query2 = ci_get_related_posts_2( $post->ID, $postsnot, $show, $paged );
        if( $query2->have_posts() ) { while ($query2->have_posts()) : $query2->the_post();?>
    <article id="post-<?php the_ID(); ?>" class="post">
      <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
      ?>
      <a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=related_posts&ic_source=sidebar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/grey.gif" data-original="<?php echo $large_image_url[0]; ?>" alt="<?php the_title_attribute(); ?>" class="lazy pull-left" width="64" height="56"></a>
      <div class="wrapper-content">
        <h2 class="entry-title"><a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=related_posts&ic_source=sidebar"><?php the_title(); ?></a></h2>
      </div>
    </article>
    <?php endwhile;?>
    <div class="pagination">
      <div class="nav-previous alignleft"><?php next_posts_link( 'Artículos anteriores', $query2->max_num_pages ); ?></div>
    </div>
    <?php } 
    wp_reset_query(); 
    wp_reset_postdata();
  }
    ?>
  </div>
  <!-- .sidebar-post -->
  <!--<div class="sidebar-post">
    <h3>Populares</h3>
    <i class="fa fa-caret-down"></i>
    <?php /*$tposts = get_trending_posts(6, TRENDING_DAYS, $maincat[0]->term_id);
      $i = 1;
      foreach ($tposts as $tpost) {
        $post_title = stripslashes($tpost->post_title);
        $permalink = get_permalink($tpost->ID);
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $tpost->ID ), 'thumbnail' );
    */?>
    <article id="post-<?php //echo $tpost->ID; ?>" class="post">
      <a href="<?php //echo $permalink; ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=popular_posts&ic_source=sidebar" class="internal-campaign"><img src="<?php //echo get_stylesheet_directory_uri(); ?>/assets/img/grey.gif" data-original="<?php //echo $large_image_url[0]; ?>" alt="<?php //echo $post_title; ?>" class="lazy pull-left" width="64" height="56"></a>
      <div class="wrapper-content">
        <h2 class="entry-title"><a href="<?php //echo $permalink; ?>" title="<?php //the_title_attribute(); ?>" rel="bookmark" data-ic="ic_medium=popular_posts&ic_source=sidebar" class="internal-campaign"><?php //echo $post_title; ?></a></h2>
        <?php 
        /*$categories = get_the_category($tpost->ID); 
        foreach($categories as $category){
          echo '<i class="fa icon-cat-'.$category->term_id.' cat-col-'.$category->term_id.'"></i> <a class="cat-col-'.$category->term_id.'" href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a> &nbsp;';
        }*/
        ?>
      </div>
    </article>
    <?php //} // fin foreach $tposts ?>
  </div>-->

  <!-- /1007663/Post-Lateral-Fondo -->
  <!--
  <div class="sidebar-post">
    <div id='div-gpt-ad-1460590183368-10'>
    <script type='text/javascript'>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1460590183368-10'); });
    </script>
    </div>
  </div>
  -->


  <div id="social-sidebar" class="sidebar-post">
    <h3>Manténte al tanto</h3>
    <i class="fa fa-caret-down"></i>
    <br>
    <p><a href="https://twitter.com/gestiopoliscom" class="twitter-follow-button" data-show-count="true">Follow @gestiopoliscom</a></p>
    <br>
    <div class="fb-page" data-href="https://www.facebook.com/gestiopolis" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/gestiopolis"><a href="https://www.facebook.com/gestiopolis">GestioPolis</a></blockquote></div></div>
  </div>
    
</div><!-- .right-post -->