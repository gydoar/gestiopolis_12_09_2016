<?php 
//echo 'Entró al archivo';
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');
global $wpdb;
$hash = ( isset($_REQUEST['h']) && (string)$_REQUEST['h'] ) ? $_REQUEST['h'] : false;

if($hash){
	$sql = "SELECT pm.post_id FROM wp_postmeta pm WHERE pm.meta_key = %s AND pm.meta_value = %s";
	$postID = $wpdb->get_var($wpdb->prepare($sql, 'all2html_hash', $hash));
	if(!empty($postID)){ //Empieza contenido si existe $postID 
	$htmlpath = get_post_meta($postID, "all2html_path", true);
  $archivo = get_post_meta($postID, "all2html_arch", true);
  $uppath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $htmlpath);
	$html_plain = file_get_contents($htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.php');
  $content = preg_replace ('/<img class=\"(.*?)\" alt=\"\" src=\"(.*?)\"\/>/s', '<img class="$1" alt="" src="'.home_url(). $uppath.'/fullhtml/$2"/>', $html_plain);
		?>
<!DOCTYPE html>
<!-- Created by pdf2htmlEX (https://github.com/coolwanglu/pdf2htmlex) -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>
<meta name="generator" content="pdf2htmlEX"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo home_url( '/pdf2htmlEX/base.min.css' ); ?>"/>
<link rel="stylesheet" href="<?php echo home_url( '/pdf2htmlEX/fancy.min.css' ); ?>"/>
<link rel="stylesheet" href="<?php echo home_url(get_post_meta($postID, "all2html_css", true)); ?>"/>
<style>#page-container .h1,#page-container .h2,#page-container .h3,#page-container .h4,#page-container .h5,#page-container .h6{margin: 0 !important;} .isStuck {z-index: 999;margin-top: 0px;background: #fff;padding: 5px 20px; position: fixed; width: 100%; opacity: 0.9;} .isStuck.top {top: 0;} .isStuck.bottom {bottom: 0;} #toolbar ul {padding-left: 10px;min-width: 100px;} #toolbar ul li {list-style: none;padding-bottom: 0;} #toolbar .dropdown-menu a:link, .dropdown-menu a:visited {color: #333;} #toolbar .dropdown-menu>li>a {padding: 3px 5px;color: #333;} #page-container .h1,#page-container .h2,#page-container .h3,#page-container .h4,#page-container .h5,#page-container .h6{margin: 0 !important;}</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo home_url( '/pdf2htmlEX/compatibility.min.js' ); ?>"></script>
<script src="<?php echo home_url( '/pdf2htmlEX/embed.min.js' ); ?>"></script>
<title></title>
</head>
<body>
<div id="toolbar" class="isStuck top">
  <div class="btn-toolbar" role="toolbar">
    <div class="btn-group btn-group-sm pull-left">
      <a type="button" class="btn btn-default prevpage" href="#" title="Página Anterior"><span class="glyphicon glyphicon-arrow-up"></span></a>
      <a type="button" class="btn btn-default nextpage" href="#" title="Página Siguiente"><span class="glyphicon glyphicon-arrow-down"></span></a>
    </div>&nbsp;&nbsp;
    Página <input class="pagen" value="0" name="gopage" maxlength="4" size="1"> de <span id="pages"></span>
    <div class="btn-group pull-right">
        <a type="button" title="Descargar archivo" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-download-alt"></span> Descargar <span class="caret"></span></a>
        <ul class="dropdown-menu list-unstyled" role="menu">
          <li><a href="<?php echo get_post_meta($postID, 'all2html_docu', true); ?>">Original</a></li>
          <?php if (get_post_meta($postID, "all2html_ext", true) != 'pdf') { ?>
          <li><a href="<?php echo home_url(get_post_meta($postID, 'all2html_pdf', true)); ?>">PDF</a></li>
          <?php } ?>
        </ul>
    </div>
  </div>
</div>
<div id="sidebar">
<div id="outline">
</div>
</div>
<?php echo $content; ?>
<div class="loading-indicator">
<img alt="" src="<?php echo home_url( '/pdf2htmlEX/pdf2htmlEX-64x64.png' ); ?>"/>
</div>
<div class="isStuck bottom">
	<div class="btn-toolbar" role="toolbar">
    <div class="btn-group btn-group-sm pull-left">
      <a type="button" class="btn btn-default gohome" href="<?php echo get_permalink($postID); ?>" title="Ver en Gestiopolis" target="_blank"><span class="glyphicon glyphicon-book"></span></a>
    </div>&nbsp;&nbsp;
    <div class="btn-group btn-group-sm pull-left">
      <a type="button" class="btn btn-default zoomin" href="#" title="Acercar"><span class="glyphicon glyphicon-zoom-in"></span></a>
      <a type="button" class="btn btn-default zoomout" href="#" title="Alejar"><span class="glyphicon glyphicon-zoom-out"></span></a>
    </div>
    <div class="btn-group btn-group-sm pull-left">
      <a type="button" id="btnfull" class="btn btn-default fullscreen" href="#" title="Ver en pantalla completa"><span style="display:none" class="glyphicon glyphicon-resize-small"></span><span class="glyphicon glyphicon-resize-full"></span></a>
    </div>
    <div class="logo pull-right"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logoGestiopolis.jpg');?>" alt="GestioPolis" height="20" width="88"/></a></div>
  </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/screenfull.min.js"></script>
<script>
$(document).on('ready', function() {
	var curpage = 0;
	$('#page-container').scroll(function(){
		curpage = this_cur_page_idx;
		$('input.pagen').val(curpage+1);
	});
	var page = document.getElementsByClassName('pf');

	var total_pages = page.length;
	$('#pages').text(total_pages);

	$('input.pagen').keyup(function() {
		var value = $(this).val()-1;
		if(value < 0) return;
		setTimeout(function() {
			$('#page-container').stop().animate({
          scrollTop: page[value].offsetTop
      }, 1000);
		},300);
	}).keyup();
	$('#toolbar .prevpage').on('click', function(e) {
		e.preventDefault();
		$('#page-container').stop().animate({
      scrollTop: page[curpage-1].offsetTop
    }, 1000);
	});
	$('#toolbar .nextpage').on('click', function(e) {
		e.preventDefault();
		$('#page-container').stop().animate({
      scrollTop: page[curpage+1].offsetTop
    }, 1000);
	});
	$('.bottom .zoomin').on('click', function(e) {
		e.preventDefault();
		rescale(1.0 / 0.9, true);
	});
	$('.bottom .zoomout').on('click', function(e) {
		e.preventDefault();
		rescale(0.9, true);
	});
	$('#btnfull').on('click', function(e) {
    if (screenfull.enabled) {
	    screenfull.toggle();
	    document.addEventListener(screenfull.raw.fullscreenchange, function () {
	      if (screenfull.isFullscreen){
	      	$('#btnfull .glyphicon-resize-small').show();
	      	$('#btnfull .glyphicon-resize-full').hide();
	      	fit_width();
	      }else {
	      	$('#btnfull .glyphicon-resize-small').hide();
	      	$('#btnfull .glyphicon-resize-full').show();
	      	fit_width();
	      }
	  	});
    } else {
      // Ignore or do something else
    }
	});
	setTimeout(function() {
	  fit_width(); //Escala las páginas para que se ajusten al ancho del contenedor
	},1000);
});
</script>
</body>
</html>	
<?php //Termina contenido si existe $postID 
	}else {
		echo '<h2>¡No deberías estar aquí!</h2>';
	}
}else {
	echo '<h2>¡No deberías estar aquí!</h2>';
}
?>