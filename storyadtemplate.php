<?php
/*
Template Name: StoryAd Template
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <div class="container cposts">
    <div class="row">
      <div class="hidden-xs hidden-sm col-md-3 sidebarcol">
        <div class="fixedside">
<?php if (get_post_meta($post->ID, "all2html_htmlcontent", true) != "") {?>
<div id="google-ads-sidebar"></div>
<script type="text/javascript"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-sidebar');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
    /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
    google_ad_client = "ca-pub-1187873112185798";
 
    /* Replace 1234567890 with the AdSense Ad Slot ID */ 
    google_ad_slot = "6290017974";
  
    /* Do not change anything after this line */
    if ( adWidth >= 300 )
      google_ad_size = ["300", "600"];  /* Leaderboard 728x90 */
    else
      google_ad_size = ["160", "600"]; /* Button (125 x 125) */
 
    google_ad_width = google_ad_size[0];
    google_ad_height=google_ad_size[1];
 
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php }else { ?>      
<div id="google-ads-sidebar"></div>
<script type="text/javascript"> 
 
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-sidebar');
 
    if (ad.getBoundingClientRect().width) {
        adWidth = ad.getBoundingClientRect().width; // for modern browsers 
    } else {
        adWidth = ad.offsetWidth; // for old IE 
    }
 
    /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
    google_ad_client = "ca-pub-1187873112185798";
 
    /* Replace 1234567890 with the AdSense Ad Slot ID */ 
    google_ad_slot = "9383186454";
  
    /* Do not change anything after this line */
    if ( adWidth >= 300 )
      google_ad_size = ["300", "600"];  /* Leaderboard 728x90 */
    else
      google_ad_size = ["160", "600"]; /* Button (125 x 125) */
 
    google_ad_width = google_ad_size[0];
    google_ad_height=google_ad_size[1];
 
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php } ?>
<?php get_template_part('templates/sidebar-post'); ?>
</div>
      </div><!--.col-sm-3-->
      <div class="col-sm-12 col-md-9 maincol">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1 class="entry-title title">#Title</h1>
          <div class="row">
            <div class="col-sm-12 col-md-2 col-md-push-10">
              <div class="breadcredit">
                <div class="author-info">
								  <a href="#autores" rel="author" class="fn">#Author</a>
								</div>
								<ul class="list-unstyled">
								  <li><time class="entry-date published" datetime="<?php echo get_the_time('c'); ?>"><i class="fa fa-calendar"></i>#ReleaseDate</time></li>
								</ul>
              </div>
            </div>
            <div class="col-sm-12 col-md-10 col-md-pull-2 content-col">
          <div class="post-content clearfix">
            <div class="entry-content">
              <?php //the_content(); ?>
              #Release
            </div>
            <div class="adsce">
              <script type="text/javascript"><!--
              google_ad_client = "ca-pub-1187873112185798";
              /* post-doc-fondo-contenido */
              google_ad_slot = "2800946094";
              google_ad_width = 300;
              google_ad_height = 250;
              //-->
              </script>
              <script type="text/javascript"
              src="//pagead2.googlesyndication.com/pagead/show_ads.js">
              </script>
            </div>
          </div>
          <footer>
            <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
          </footer>
        </div><!-- fin col-md-10 -->
        </div><!-- fin de row de contenido y meta -->
        </article>
      </div><!--.col-sm-9-->
      
    </div><!-- fin de .row -->
  </div>
<?php endwhile; ?>
