<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. Google Fonts
 * 2. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-2.1.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {
  global $post;
  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if (WP_ENV === 'development') {
    $assets = array(
      'css'       => '/assets/css/main.css',
      'fonts'     => '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Montserrat:700',
      'iconfont'     => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css',
      'pdfcssbase'=> '/pdf2htmlEX/base.css',
      'pdfcssfancy'   => '/pdf2htmlEX/fancy.css',
      'js'        => '/assets/js/scripts.js',
      'modernizr' => '/assets/vendor/modernizr/modernizr.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.js',
      'pdfcomp'    => '/pdf2htmlEX/compatibility.js',
      'pdfall'    => '/pdf2htmlEX/all2html.js',
      'imglo'    => '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.js',
      'iso'    => '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.1.1/isotope.pkgd.js',
      'infi'    => '//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.120519/jquery.infinitescroll.min.js',
      'zero'    => '//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.js'
    );
  } else {
    $get_assets = file_get_contents(get_template_directory() . '/assets/manifest.json');
    $assets     = json_decode($get_assets, true);
    $assets     = array(
      'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
      'fonts'       => '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Montserrat:700',
      'iconfont'     => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
      'pdfcssbase'=> '/pdf2htmlEX/base.min.css',
      'pdfcssfancy'   => '/pdf2htmlEX/fancy.min.css',
      'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
      'modernizr' => '/assets/js/vendor/modernizr.min.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
      'pdfcomp'    => '/pdf2htmlEX/compatibility.min.js',
      'pdfall'    => '/pdf2htmlEX/all2html.min.js',
      'imglo'    => '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js',
      'iso'    => '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.1.1/isotope.pkgd.min.js',
      'infi'    => '//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.120519/jquery.infinitescroll.min.js',
      'zero'    => '//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.min.js'
    );
  }

  wp_enqueue_style('google_fonts', $assets['fonts'], false, null);
  wp_enqueue_style('fontawesome', $assets['iconfont'], false, null);
  wp_enqueue_style('roots_css', get_template_directory_uri() . $assets['css'], false, null);
  if (is_home() || is_archive()){
    wp_enqueue_style('slick_css', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css', false, null);
  }
  if (is_single()){
    if (get_post_meta($post->ID, "all2html_htmlcontent", true) != "") {
      wp_enqueue_style('basepdf', home_url() . $assets['pdfcssbase'], false, null);
      wp_enqueue_style('fancypdf', home_url() . $assets['pdfcssfancy'], false, null);
      wp_enqueue_style('all2htmlcss', home_url(get_post_meta($post->ID, "all2html_css", true)), false, null);
    }
  }
  
  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  /*if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }*/


  wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, true);
  wp_enqueue_script('jquery');
  if (is_single()){
    if (get_post_meta($post->ID, "all2html_htmlcontent", true) != "") {
      wp_enqueue_script('compatibility', home_url() . $assets['pdfcomp'], array(), null, false);
      wp_enqueue_script('all2html', home_url() . $assets['pdfall'], array(), null, false);
    }
    wp_enqueue_script('copytext', $assets['zero'], array(), array( 'jquery' ), true);
  }
  if (is_home() || is_archive() || is_author() || is_search() ){
    wp_enqueue_script('isotope', $assets['iso'], array(), array( 'jquery' ), true);
    wp_enqueue_script('infinitescroll', $assets['infi'], array(), array( 'jquery' ), true);
    wp_enqueue_script('imagesloaded', $assets['imglo'], array(), array( 'jquery' ), true);
    wp_enqueue_script('slickjs', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js', array(), array( 'jquery' ), true);
  }
  wp_enqueue_script('roots_js', get_template_directory_uri() . $assets['js'], array(), null, true);

  //Enviar variables al script 'script.js' o 'roots_js'
  $values_array = array();
  if (is_single()) {
    $values_array = array( 'template_directory' => get_template_directory_uri(), 'postid' => $post->ID, 'all2html_htmlcontent' => get_post_meta($post->ID, "all2html_htmlcontent", true), 'manage_options' => current_user_can( 'manage_options'), 'userlogin' => is_user_logged_in() );
  }else {
    $values_array = array( 'template_directory' => get_template_directory_uri(), 'manage_options' => current_user_can( 'manage_options'), 'userlogin' => is_user_logged_in() );
  }
  wp_localize_script('roots_js', 'serverval', $values_array);

}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?2.1.3"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');


//Surge price
/*
function surgeprice(){ ?>

  <script data-cfasync="false" src="//surgeprice.com/display/ads/FXvryitzNQQ7tCus9/ariel.js"></script>

<?php }

add_action('wp_head', 'surgeprice');
*/

/**
 * Google Analytics snippet from HTML5 Boilerplate
 *
 * Cookie domain is 'auto' configured. See: http://goo.gl/VUCHKM
 */
function roots_google_analytics() { ?>
<!-- Segumiento de recursos de navegación por ikhuerta.com -->
<script>
var gafrom = function (nd,v) {  if (!v) { v = document.cookie.match( /_gafrom=([^;]+)(;.+)?$/ ); if (!nd) document.cookie = '_gafrom=;path=/'; return (v && v[1]) ? v[1] : '(not set)';}  else document.cookie = '_gafrom='+v+';path=/'; } 
$(function () { $('.gafrom').each( function (i,e) { var c = $(e).attr('class').split(' '); for (j in c) { var m = /^from\-(.+)/.exec(c[j]); if (m != null) { m[1]=m[1].split('-').join(' '); var a = ($(e).is('a'))? $(e) : $('a',e); a.data('gafrom', m[1] ).click(function () { gafrom(1, $(this).data('gafrom')+' (link)' );return true; }); a = ($(e).is('form'))? $(e) : $('form',e); a.data('gafrom', m[1] ).submit(function () { gafrom(1, $(this).data('gafrom')+' (form)' );return true; }); break;}}}); });
</script>
<!-- Internal campaigns by Iñaki Huerta: blog.ikhuerta.com -->
<script> 
var gaic = function () { gaic.r( gaic.c(),'|'); gaic.r(location.search.substring(1) );}
gaic.ns = '(not set)'; gaic.cn = '_gaic'; gaic.v = 0; gaic.k = { 'ic_medium' : 'medium', 'ic_source' : 'source', 'ic_campaign' : 'campaign', 'ic_term' : 'term', 'ic_content' : 'content', 'ic_referrer' : 'referrer', 'ic_landing' : 'landing' };gaic.gk = function ( k ){ for (var i in gaic.k) if ( k == gaic.k[i] ) return i; }
gaic.r = function ( s , c) { if (!s) return; if (!c) c = '&';if (!gaic.v) { gaic.v = {};  var f = 1;  } else f = 0; s = s.split(c); var r = 0; for(var i in s) { s[i] = s[i].split('='); if ( gaic.k[s[i][0]] && !f ) { var r=1; break; } } if (r) { for ( var i in gaic.k ) gaic.v[gaic.k[i]] = gaic.ns; gaic.v.referrer = document.referrer; gaic.v.landing = location.pathname; };for(var i in s) { if ( gaic.k[s[i][0]] ) { gaic.v[gaic.k[s[i][0]]] = s[i][1]; if (!f) var r=1; } }gaic.d();gaic.s(); }
gaic.d = function () { for ( var i in gaic.k ) if ( !gaic.v[gaic.k[i]] ) gaic.v[gaic.k[i]] = gaic.ns; }; gaic.c = function () { var re = new RegExp( gaic.cn+'=([^;]+)(;.+)?$'); var pd = document.cookie.match( re ); return (pd && pd[1]) ? pd[1] : ''; }; gaic.s = function () { var s = ''; for (i in gaic.v ) s += gaic.gk(i) + '=' + gaic.v[i] + '|'; document.cookie = gaic.cn+'='+s; }; 
gaic.get = function (k) { return (k) ? gaic.v[k] : gaic.v; }; gaic();
</script>
<script>
  <?php if (WP_ENV === 'production') : ?>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  <?php else : ?>
    function ga() {
      console.log('GoogleAnalytics: ' + [].slice.call(arguments));
    }
  <?php endif; ?>
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>','auto');ga('set', 'dimension1', gaic.get('medium') );ga('set', 'dimension2', gaic.get('source') );ga('set', 'dimension3', gafrom() );ga('send','pageview');
</script>

<!--<script>
jQuery(function() {
  /*jQuery.scrollDepth({
    userTiming: false,
    pixelDepth: false
  });*/
});
</script>-->

<?php }
if (GOOGLE_ANALYTICS_ID && (WP_ENV !== 'production' || !current_user_can('manage_options'))) {
  add_action('wp_footer', 'roots_google_analytics', 1);
}
function footer_scripts() { 
if (is_single()){
  ?>
<!-- Facebook Plugin-->
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=220995104693477";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
<!-- Twitter Plugin -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- Google + Plugin -->
<!--<script type="text/javascript">
  window.___gcfg = {lang: 'es-419'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>-->
<?php } }
add_action('wp_footer', 'footer_scripts', 20);
