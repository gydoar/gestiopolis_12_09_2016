<?php
 
//http://wordpress.stackexchange.com/questions/52662/check-if-first-paragraph-is-an-image-then-show-custom-code-right-after-it
//http://premium.wpmudev.org/blog/wordpress-style-first-paragraph/
//http://stackoverflow.com/questions/25888630/place-ads-in-between-text-only-paragraphs
//http://www.labnol.org/internet/adsense-custom-size-ads/28352/
//Inserta admanmedia ads después del primer párrafo
add_filter( 'the_content', 'insert_adman_ads' );
//http://www.gestiopolis.com/la-etica-empresarial-como-fuente-de-ventajas-competitivas/
function insert_adman_ads( $content ) {
    global $post;

$ad_code = "<!-- /1007663/Post-3Parrafo-VideoAds -->
<div id='div-gpt-ad-1460590183368-5'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1460590183368-5'); });
</script>
</div>";


	if ( is_single() && ! is_admin() && get_post_meta($post->ID, "all2html_htmlcontent", true) == "" ) {
        //if(!is_single(28207 )){
    		return prefix_insert_after_paragraph( $ad_code, 4, $content );
        //}
	}
	
	return $content;
}

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}
//http://www.gestiopolis.com/valor-economico-agregado-eva-y-gerencia-basada-en-valor-gbv/
function insert_ads_all2html( $content ) {
	$pages = preg_split("/(?=<div id=\"pf)/", $content, null, PREG_SPLIT_DELIM_CAPTURE);
    $count = count($pages)-1;
    if($count <= 4){
        $pos2 = -1;
        $pos3 = -1;
        $pos4 = -1;
    }else {
        $pos2 = floor($count / 2);
        $pos2 = $pos2 -($pos2*0.25);
    }
	foreach ($pages as $index => $page) {

		if ( 1 == $index ) {
            $pages[$index] .= '<div class="adsce"><!-- /1007663/Trans-SegPag-BTF-728x90 -->
<div id=\'div-gpt-ad-1460590183368-16\'>
<script type=\'text/javascript\'>
googletag.cmd.push(function() { googletag.display(\'div-gpt-ad-1460590183368-16\'); });
</script>
</div></div>';
        }

        if ( $pos2 == $index ) {
            $pages[$index] .= '<div class="adsce"><div id="google-ads-docs-3"></div>
 
          <script type="text/javascript"> 
           
              /* Calculate the width of available ad space */
              ad = document.getElementById(\'google-ads-docs-3\');
           
              if (ad.getBoundingClientRect().width) {
                  adWidth = ad.getBoundingClientRect().width; // for modern browsers 
              } else {
                  adWidth = ad.offsetWidth; // for old IE 
              }
           
              /* Replace ca-pub-XXX with your AdSense Publisher ID */ 
              google_ad_client = "ca-pub-1187873112185798";
           
              /* Replace 1234567890 with the AdSense Ad Slot ID */ 
              google_ad_slot = "8288519454";
            
              /* Do not change anything after this line */
              if ( adWidth >= 727 )
                google_ad_size = ["728", "90"];  /* Leaderboard 728x90 */
              else if (adWidth >= 467 && adWidth < 727)
                google_ad_size = ["468", "60"]; /* Button (125 x 125) */
              else
                google_ad_size = ["300", "250"]; /* Button (125 x 125) */
           
               google_ad_width = google_ad_size[0];
            google_ad_height=google_ad_size[1];
           
          </script>
          <script type="text/javascript"
                  src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                  </script></div>';
        }

}
	
	return implode( '', $pages );
}

add_filter( 'the_content', 'so_25888630_ad_between_paragraphs' );

function so_25888630_ad_between_paragraphs($content){
    /**-----------------------------------------------------------------------------
     *
     *  @author       Pieter Goosen <http://stackoverflow.com/users/1908141/pieter-goosen>
     *  @return       Ads in between $content
     *  @link         http://stackoverflow.com/q/25888630/1908141
     * 
     *  Special thanks to the following answers on my questions that helped me to
     *  to achieve this
     *     - http://stackoverflow.com/a/26032282/1908141
     *     - http://stackoverflow.com/a/25988355/1908141
     *     - http://stackoverflow.com/a/26010955/1908141
     *     - http://wordpress.stackexchange.com/a/162787/31545
     *
    *------------------------------------------------------------------------------*/ 
    //http://www.gestiopolis.com/autogerencia/
    //http://www.gestiopolis.com/gestion-de-mantenimiento-e-iso-55000-sobre-manejo-de-activos-fisicos/
    //http://www.gestiopolis.com/posicionamiento-estrategico-de-la-empresa/
    //if( (is_single(9624) || is_single(332873) || is_single(332832)) && ! is_admin() ){ //Simply make sure that these changes effect the main query only
    if( is_single() && ! is_admin() && !is_single(333666) ){

        /**-----------------------------------------------------------------------------
         *
         *  wptexturize is applied to the $content. This inserts p tags that will help to  
         *  split the text into paragraphs. The text is split into paragraphs after each
         *  closing p tag. Remember, each double break constitutes a paragraph.
         *  
         *  @todo If you really need to delete the attachments in paragraph one, you want
         *        to do it here before you start your foreach loop
         *
        *------------------------------------------------------------------------------*/ 
        $closing_p = '</p>';
        //$paragraphs = explode( $closing_p, wptexturize($content) );
        $paragraphs = preg_split("/(?=<\/p>)/", $content, null, PREG_SPLIT_DELIM_CAPTURE);
        
        /**-----------------------------------------------------------------------------
         *
         *  The amount of paragraphs is counted to determine add frequency. If there are
         *  less than four paragraphs, only one ad will be placed. If the paragraph count
         *  is more than 4, the text is split into two sections, $first and $second according
         *  to the midpoint of the text. $totals will either contain the full text (if 
         *  paragraph count is less than 4) or an array of the two separate sections of
         *  text
         *
         *  @todo Set paragraph count to suite your needs
         *
        *------------------------------------------------------------------------------*/ 
        $count = count( $paragraphs );
        if( 12 >= $count ) {
            $totals = array( $paragraphs ); 
        }else {
            $midpoint = floor($count / 2);
            $first = array_slice($paragraphs, 0, $midpoint );
            $diff = $count - $midpoint;
            $second = array_slice( $paragraphs, $midpoint, $diff+1, true );
            $totals = array( $first, $second );
        }
        

        $new_paras = array();
        foreach ( $totals as $key_total=>$total ) {
            /**-----------------------------------------------------------------------------
             *
             *  This is where all the important stuff happens
             *  The first thing that is done is a work count on every paragraph
             *  Each paragraph is is also checked if the following tags, a, li and ul exists
             *  If any of the above tags are found or the text count is less than 10, 0 is 
             *  returned for this paragraph. ($p will hold these values for later checking)
             *  If none of the above conditions are true, 1 will be returned. 1 will represent
             *  paragraphs that qualify for add insertion, and these will determine where an ad 
             *  will go
             *  returned for this paragraph. ($p will hold these values for later checking)
             *
             *  @todo You can delete or add rules here to your liking
             *
            *------------------------------------------------------------------------------*/ 
            $p = array();
            foreach ( $total as $key_paras=>$paragraph ) {
                $word_count = count(explode(' ', $paragraph));
                if( preg_match( '~<(?:img|ul|li)[ >]~', $paragraph ) || $word_count < 10 ) {  
                    $p[$key_paras] = 0; 
                }else{
                    $p[$key_paras] = 1; 
                }   
            }
            /**-----------------------------------------------------------------------------
             *
             *  Return a position where an add will be inserted
             *  This code checks if there are two adjacent 1's, and then return the second key
             *  The ad will be inserted between these keys
             *  If there are no two adjacent 1's, "no_ad" is returned into array $m
             *  This means that no ad will be inserted in that section
             *
            *------------------------------------------------------------------------------*/ 
            $m = array();
            foreach ( $p as $key=>$value ) {
                if( 1 === $value && array_key_exists( $key-1, $p ) && $p[$key] === $p[$key-1] && !$m){
                    $m[] = $key+2;
                }elseif( !array_key_exists( $key+1, $p ) && !$m ) {
                    $m[] = 'no-ad';
                }
            }

            /**-----------------------------------------------------------------------------
             *
             *  Use two different ads, one for each section
             *  Only ad1 is displayed if there is less than 4 paragraphs
             *
             *  @todo Replace "PLACE YOUR ADD NO 1 HERE" with your add or code. Leave p tags
             *  @todo I will try to insert widgets here to make it dynamic
             *
            *------------------------------------------------------------------------------*/ 
            if( $key_total == 0 ){
                $ad = array( 'ad1' => 
                
                /* Surge Pricing Unit - gestiopolis.com_300x250_precio030300x250 */
                '<div class="adsce">
                <div id="gestiopolis.com_300x250_precio030300x250" class="surgeprice">
                  <script data-cfasync="false" type="text/javascript">surgeprice.display("gestiopolis.com_300x250_precio030300x250");</script>
                </div>
                </div>'
                );
                /*
                $ad = array( 'ad1' => 
                '<div class="adsce"><!-- /1007663/Post-4Parrafo-BTF-300x250 -->
                <div id=\'div-gpt-ad-1460590183368-6\'>
                <script type=\'text/javascript\'>
                googletag.cmd.push(function() { googletag.display(\'div-gpt-ad-1460590183368-6\'); });
                </script>
                </div></div>' );
                */
            }else if( $key_total == 1 ){
                $ad = array( 'ad2' => 
                '<div class="adsce"><!-- /1007663/Post-Mitad-BTF-300x250 -->
                <div id=\'div-gpt-ad-1460590183368-11\'>
                <script type=\'text/javascript\'>
                googletag.cmd.push(function() { googletag.display(\'div-gpt-ad-1460590183368-11\'); });
                </script>
                </div></div>' );

            }
            /**-----------------------------------------------------------------------------
             *
             *  This code loops through all the paragraphs and checks each key against $mail
             *  and $key_para
             *  Each paragraph is returned to an array called $new_paras. $new_paras will
             *  hold the new content that will be passed to $content.
             *  If a key matches the value of $m (which holds the array key of the position
             *  where an ad should be inserted) an add is inserted. If $m holds a value of
             *  'no_ad', no ad will be inserted
             *
            *------------------------------------------------------------------------------*/ 
            foreach ( $total as $key_para=>$para ) {
                if( !in_array( 'no_ad', $m ) && $key_para === $m[0] ){
                    $new_paras[key($ad)] = $ad[key($ad)];
                    $new_paras[$key_para] = $para;
                }else{
                    $new_paras[$key_para] = $para;
                }
            }
        }

        /**-----------------------------------------------------------------------------
         *
         *  $content should be a string, not an array. $new_paras is an array, which will
         *  not work. $new_paras are converted to a string with implode, and then passed
         *  to $content which will be our new content
         *
        *------------------------------------------------------------------------------*/ 
        $content =  implode( ' ', $new_paras );
    }
    return $content;
}

function footer_dataxpand() {
    echo '
    <script type="text/javascript">
      (function () {
        var tagjs = document.createElement("script");
        var s = document.getElementsByTagName("script")[0];
        tagjs.async = true;
        tagjs.src = "//dataxpand.script.ag/tag.js#site=63UCMvc";
        s.parentNode.insertBefore(tagjs, s);
      }());
    </script>
    ';
}
add_action('wp_footer', 'footer_dataxpand', 100);

/*function head_scripts_single_ads() {
    global $post;
    if (is_single()) {
    echo '<script type=\'text/javascript\'>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  (function() {
    var gads = document.createElement(\'script\');
    gads.async = true;
    gads.type = \'text/javascript\';
    var useSSL = \'https:\' == document.location.protocol;
    gads.src = (useSSL ? \'https:\' : \'http:\') +
      \'//www.googletagservices.com/tag/js/gpt.js\';
    var node = document.getElementsByTagName(\'script\')[0];
    node.parentNode.insertBefore(gads, node);
  })();
</script>

<script type=\'text/javascript\'>
  googletag.cmd.push(function() {
    googletag.defineSlot(\'/1007663/post-comienzo-contenido\', [300, 250], \'div-gpt-ad-1433261534384-0\').addService(googletag.pubads());
    googletag.defineSlot(\'/1007663/post-2do-parrafo-contenido\', [300, 250], \'div-gpt-ad-1433261534384-1\').addService(googletag.pubads());
    googletag.defineSlot(\'/1007663/post-3er-parrafo-contenido\', [600, 338], \'div-gpt-ad-1433303077158-0\').addService(googletag.pubads());
    googletag.defineSlot(\'/1007663/post-mitad-contenido\', [300, 250], \'div-gpt-ad-1433261534384-3\').addService(googletag.pubads());
    var mapping = googletag.sizeMapping().
    addSize([0, 0], [300, 250]).
        addSize([750, 450], [[300, 250], [728, 90], [580, 400], [336, 280]])
        .build();
    googletag.defineSlot(\'/1007663/post-doc-fondo-contenido\', [[300, 250], [728, 90], [580, 400], [336, 280]], \'div-gpt-ad-1433261534384-4\').defineSizeMapping(mapping).addService(googletag.pubads());
    var mapping1 = googletag.sizeMapping().
    addSize([0, 0], [300, 250]).
        addSize([550, 200], [468, 60]).
        addSize([768, 200], [728, 90]).
        build();
    googletag.defineSlot(\'/1007663/docs-comienzo-contenido\', [[300, 250], [728, 90], [468, 60]], \'div-gpt-ad-1433261534384-5\').defineSizeMapping(mapping1).addService(googletag.pubads());
    var mapping2 = googletag.sizeMapping().
    addSize([0, 0], [300, 250]).
        addSize([550, 200], [468, 60]).
        addSize([768, 200], [728, 90]).
        build();
    googletag.defineSlot(\'/1007663/docs-2da-pagina-contenido\', [[300, 250], [728, 90], [468, 60]], \'div-gpt-ad-1433261534384-6\').defineSizeMapping(mapping2).addService(googletag.pubads());
    var mapping3 = googletag.sizeMapping().
    addSize([0, 0], [300, 250]).
        addSize([550, 200], [468, 60]).
        addSize([768, 200], [728, 90]).
        build();
    googletag.defineSlot(\'/1007663/docs-mitad-contenido\', [[300, 250], [728, 90], [468, 60]], \'div-gpt-ad-1433261534384-7\').defineSizeMapping(mapping3).addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.enableServices();
  });
</script>';
$dfpprincipal = "<script type='text/javascript'>
  (function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src=\"' + src + '\"></scr' + 'ipt>');
  })();
</script>

<script type='text/javascript'>
  googletag.cmd.push(function() {
    googletag.defineSlot('/1007663/Post-Principal-ATF-300x250', [300, 250], 'div-gpt-ad-1459994552364-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>";
$adslive = '<script type=\'text/javascript\'>
  (function() {
    var useSSL = \'https:\' == document.location.protocol;
    var src = (useSSL ? \'https:\' : \'http:\') +
        \'//www.googletagservices.com/tag/js/gpt.js\';
    document.write(\'<scr\' + \'ipt src="\' + src + \'"></scr\' + \'ipt>\');
  })();
</script>

<script type=\'text/javascript\'>
  googletag.cmd.push(function() {
    googletag.defineOutOfPageSlot(\'/11322282/GestioPolis.com_I//1x1\', \'div-gpt-ad-1436976370032-0\').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>

<!-- /11322282/GestioPolis.com_I//1x1 -->
<div id=\'div-gpt-ad-1436976370032-0\'>
<script type=\'text/javascript\'>
googletag.cmd.push(function() { googletag.display(\'div-gpt-ad-1436976370032-0\'); });
</script>
</div>';
$q1= '<script src="http://Q1MediaHydraPlatform.com/ads/video/controller.php?qid=56d841ab6fbe154632ae0e88&qz=1"></script>';
$anuncios = array($q1,$q1,$q1,$q1,$q1,$q1,$q1,$q1,$q1,$q1);
//echo $anuncios[rand(0,9)];
echo '
<script src=\'http://www5.smartadserver.com/config.js?nwid=1371\' type="text/javascript"></script>
<script type="text/javascript">
    sas.setup({ domain: \'http://www5.smartadserver.com\'});
</script>'.$anuncios[mt_rand(0,9)];
echo $dfpprincipal.$anuncios[mt_rand(0,9)];
}
}
add_action('wp_head', 'head_scripts_single_ads', 1);*/

function head_scripts_ads() {
  global $post;
  $dfpPrincipal = "<script type='text/javascript'>
  (function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src=\"' + src + '\"></scr' + 'ipt>');
  })();
</script>

<script type='text/javascript'>
  googletag.cmd.push(function() {
    googletag.defineSlot('/1007663/Categoria-Mitad-728x90', [728, 90], 'div-gpt-ad-1460590183368-0').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Categoria-Top-728x90', [728, 90], 'div-gpt-ad-1460590183368-1').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Home-Abajo-728x90', [728, 90], 'div-gpt-ad-1460590183368-2').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Home-Mitad-728x90', [728, 90], 'div-gpt-ad-1460590183368-3').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Home-Top-728x90', [728, 90], 'div-gpt-ad-1460590183368-4').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-3Parrafo-VideoAds', [1, 1], 'div-gpt-ad-1460590183368-5').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-4Parrafo-BTF-300x250', [300, 250], 'div-gpt-ad-1460590183368-6').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-Abajo-BTF-300x250', [300, 250], 'div-gpt-ad-1460590183368-7').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-AbajoTags', [[120, 60], [120, 90], [125, 125], [120, 240], [120, 600]], 'div-gpt-ad-1460590183368-8').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-Lateral-ATF-300x600', [300, 600], 'div-gpt-ad-1460590183368-9').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-Lateral-Fondo', [[160, 600], [300, 100], [300, 600], [300, 50], [300, 125], [168, 42], [300, 250], [168, 28], [300, 75]], 'div-gpt-ad-1460590183368-10').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-Mitad-BTF-300x250', [300, 250], 'div-gpt-ad-1460590183368-11').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Post-Principal-ATF-300x250', [300, 250], 'div-gpt-ad-1460590183368-12').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Tag-Top-728x90', [728, 90], 'div-gpt-ad-1460590183368-13').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Trans-Lateral-ATF-300x600', [300, 600], 'div-gpt-ad-1460590183368-14').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Trans-Principal-ATF-728x90', [728, 90], 'div-gpt-ad-1460590183368-15').addService(googletag.pubads());
    googletag.defineSlot('/1007663/Trans-SegPag-BTF-728x90', [728, 90], 'div-gpt-ad-1460590183368-16').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>";
  $scripts = '<script type=\'text/javascript\' src=\'https://www.googletagservices.com/tag/js/gpt.js\'>
  googletag.pubads().definePassback(\'/1007663/Header-Moviles\', [1, 1]).display();
</script>';
  if (is_single()) {
    $scripts .= '<script src=\'http://Q1MediaHydraPlatform.com/ads/video/controller.php?qid=56d841ab6fbe154632ae0e88&qz=1\'></script>';
    /*
    $scripts .= '<script type=\'text/javascript\' src=\'https://www.googletagservices.com/tag/js/gpt.js\'>
  googletag.pubads().definePassback(\'/1007663/Header-Moviles-Articulos\', [1, 1]).display();
</script>';*/
  }

echo $dfpPrincipal.$scripts;
}
add_action('wp_head', 'head_scripts_ads', 1);

function footer_adsense_script() {
    
        $adslive = '<script type=\'text/javascript\'>
  (function() {
    var useSSL = \'https:\' == document.location.protocol;
    var src = (useSSL ? \'https:\' : \'http:\') +
        \'//www.googletagservices.com/tag/js/gpt.js\';
    document.write(\'<scr\' + \'ipt src="\' + src + \'"></scr\' + \'ipt>\');
  })();
</script>

<script type=\'text/javascript\'>
  googletag.cmd.push(function() {
    googletag.defineOutOfPageSlot(\'/11322282/GestioPolis.com_I//1x1\', \'div-gpt-ad-1436976370032-0\').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>

<!-- /11322282/GestioPolis.com_I//1x1 -->
<div id=\'div-gpt-ad-1436976370032-0\'>
<script type=\'text/javascript\'>
googletag.cmd.push(function() { googletag.display(\'div-gpt-ad-1436976370032-0\'); });
</script>
</div>
<!--<script type="text/javascript" src="http://as.ebz.io/api/choixPubJS.htm?pid=1138158&screenLayer=1&mode=NONE&home=http://www.gestiopolis.com"></script>-->
';

$plads= 
'<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2753881743271989",
    enable_page_level_ads: true
  });
</script>';

$fbads='<style>
     #ad_root {
        display: none;
        font-size: 14px;
        height: 250px;
        line-height: 16px;
        position: relative;
        width: 300px;
      }

      .thirdPartyMediaClass {
        height: 157px;
        width: 300px;
      }

      .thirdPartyTitleClass {
        font-weight: 600;
        font-size: 16px;
        margin: 8px 0 4px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .thirdPartyBodyClass {
        display: -webkit-box;
        height: 32px;
        -webkit-line-clamp: 2;
        overflow: hidden;
      }

      .thirdPartyCallToActionClass {
        color: #326891;
        font-family: sans-serif;
        font-weight: 600;
        margin-top: 8px;
      }
    </style>
    <script>
      window.fbAsyncInit = function() {
        FB.Event.subscribe(
          \'ad.loaded\',
          function(placementId) {
            console.log(\'Audience Network ad loaded\');
            document.getElementById(\'ad_root\').style.display = \'block\';
          }
        );
        FB.Event.subscribe(
          \'ad.error\',
          function(errorCode, errorMessage, placementId) {
            console.log(\'Audience Network error (\' + errorCode + \') \' + errorMessage);
          }
        );
      };
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk/xfbml.ad.js#xfbml=1&version=v2.5&appId=154786858571";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, \'script\', \'facebook-jssdk\'));
    </script>
    <fb:ad placementid="154786858571_10154565912493572" format="native" nativeadid="ad_root" testmode="false"></fb:ad>
    <div id="ad_root">
      <a class="fbAdLink">
        <div class="fbAdMedia thirdPartyMediaClass"></div>
        <div class="fbAdTitle thirdPartyTitleClass"></div>
        <div class="fbAdBody thirdPartyBodyClass"></div>
        <div class="fbAdCallToAction thirdPartyCallToActionClass"></div>
      </a>
    </div>';
//$anuncios = array($plads,$adslive,$plads,$adslive,$plads,$plads,$plads,$plads,$plads,$plads);
//echo $anuncios[mt_rand(0,9)];
//echo $unipiloto;
    echo '<script type=\'text/javascript\' src=\'https://www.googletagservices.com/tag/js/gpt.js\'>
  googletag.pubads().definePassback(\'/1007663/Footer-Moviles\', [1, 1]).display();
</script>';
}
add_action('wp_footer', 'footer_adsense_script', 1);

?>
