<article id="post-<?php echo $tpost->ID;?>" class="destacado-<?php echo $tpost->ID;?> post">
  <a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" rel="bookmark">
    <img src="<?php echo wp_imager(640, 360, '', 'img-responsive', false, get_post_meta($tpost->ID, "Thumbnail", true), true); ?>" alt="<?php echo $post_title; ?>" class="img-responsive">
    <?php //echo wp_imager(640, 360, '', 'img-responsive'); ?>
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