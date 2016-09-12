<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

//Limitar post en la página de búsqueda
function limit_posts_per_search_page() {
	if ( is_search() )
		set_query_var('posts_per_archive_page', 100); 
}
//add_filter('pre_get_posts', 'limit_posts_per_search_page');

//Formulario de Login Personalizado*/
function custom_login() { echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/customlog/customlog.css" />'; }
//add_action('login_head', 'custom_login');

//Recortar extracto
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
return 70; }

//Cambiar dirección de logo de Login y título
function change_wp_login_url() { return bloginfo('url');}
add_filter('login_headerurl', 'change_wp_login_url');
function change_wp_login_title() { return get_option('blogname');}
add_filter('login_headertitle', 'change_wp_login_title');

//Convertir dirección de carpeta en URL
function path2url($file, $Protocol='http://') {
  return $Protocol.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
}

// Añade nuevo caracteres para limpiar nombres de arhcivos
function my_sanitize_chars($chars){
  $chars[] = '%';
  return $chars;
}
add_filter('sanitize_file_name_chars', 'my_sanitize_chars');

//Combina dos cadenas de texto
function MergeBetween($str1, $str2){
 	// Split both strings
  $str1 = str_split($str1, 1);
  $str2 = str_split($str2, 1);

  // Swap variables if string 1 is larger than string 2
  if (count($str1) >= count($str2))
      list($str1, $str2) = array($str2, $str1);

  // Append the shorter string to the longer string
  for($x=0; $x < count($str1); $x++)
      $str2[$x] .= $str1[$x];

  return implode('', $str2);
}

//Genera un cadena de texto aleatoria
function genRandomString($string, $length = 11) {
  $pass_rnd = array_merge(range('a','z'), range('A','Z'), range(0,9));
	$rnd = array_rand($pass_rnd, $length);
	$random_hash = '';
	for($i=0;$i<$length;$i++) {
	 $random_hash .= $pass_rnd[$rnd[$i]];
	}
	$random_hash = str_shuffle($random_hash);
	$sha1 = sha1($string);
	$random_h = substr(MergeBetween($random_hash, $sha1), 0 , $length);
  return $random_h;
}

//Numero de retweets de cada post
function tweetCount($url) {
	$content = file_get_contents("http://api.tweetmeme.com/url_info?url=".$url);
	$element = new SimpleXmlElement($content);
	$retweets = $element->story->url_count;
	if($retweets){
		echo $retweets;}
	else{
		echo '0';
	}
}

//Cuenta de shares en facebook
function fb_like_count($url) {
	$url=urlencode($url);	
	$content = file_get_contents("http://api.ak.facebook.com/restserver.php?v=1.0&method=fql.query&query=select%20url%2C%20share_count%20from%20link_stat%20where%20url%3D%22".$url."%22&format=xml");
	$fb_share_count = simplexml_load_string($content);
	echo $fb_share_count->link_stat->share_count;
	if(is_bool($fb_share_count)){
		print '0';}
	else{
		echo $fb_share_count;
	}
}

//Acortador de bit.ly
function bitly($url, $echo = true) {
	$content = file_get_contents("http://api.bit.ly/v3/shorten?login=djdiego88&apiKey=R_92134b02492c1aeae7a9b631462a5a2e&longUrl=".$url."&format=xml");
	$element = new SimpleXmlElement($content);
	$bitly = $element->data->url;
	if ($echo){
	if($bitly){
		echo $bitly;}
	else{
		echo '0';
	}
	}else {return $bitly;}
}

/****************
Mostrar los más populares por Categoría y Tags
Se necesita tener instalado el plugin I Like This
****************/
function most_liked_posts_cat($numberOf, $before, $after, $show_count, $catID) {
	global $wpdb;
    $request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta, $wpdb->term_relationships";
    $request .= " WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id";
    $request .= " AND post_status='publish' AND post_type='post' AND meta_key='_liked'";
		$request .= " AND $wpdb->posts.ID=$wpdb->term_relationships.object_id AND term_taxonomy_id='$catID'";
    $request .= " ORDER BY $wpdb->postmeta.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	$post_count = $post->meta_value;
    	    	echo $before.'<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . $post_title . '</a>';
		echo $show_count == '1' ? ' ('.$post_count.')' : '';
		echo $after;
    }
}

/****************
Mostrar los más populares por Categoría y Tags
Se necesita tener instalado el plugin I Like This
****************/
function most_liked_posts_cat1($numberOf, $before, $after, $show_count, $catID) {
	global $wpdb;
    $request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta, $wpdb->term_relationships";
    $request .= " WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id";
    $request .= " AND post_status='publish' AND post_type='post' AND meta_key='_liked'";
		$request .= " AND $wpdb->posts.ID=$wpdb->term_relationships.object_id AND term_taxonomy_id='$catID'";
    $request .= " ORDER BY $wpdb->postmeta.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	$post_count = $post->meta_value;
    	    	echo $before.get_the_image( array('post_id' => $post->ID, 'size' => 'category-thumb', 'width' => '70', 'height' => '70', 'default_image' => get_bloginfo('template_directory').'/images/thumbnail.png' ) ).'<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . title_trim(80, $post_title) . '</a>';
		echo $show_count == '1' ? ' ('.$post_count.')' : '';
		echo $after;
    }
}

/****************
Mostrar los más populares por Tipo de Post
Se necesita tener instalado el plugin I Like This
****************/
function most_liked_posts_pt($numberOf, $before, $after, $show_count, $posttype) {
	global $wpdb;
    $request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta";
    $request .= " WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id";
    $request .= " AND post_status='publish' AND post_type='$posttype' AND meta_key='_liked'";
		$request .= " ORDER BY $wpdb->postmeta.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	$post_count = $post->meta_value;
    	    	echo $before.'<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . $post_title . '</a>';
		echo $show_count == '1' ? ' ('.$post_count.')' : '';
		echo $after;
    }
}

/****************
Mostrar los más populares por Tipo de Post
Se necesita tener instalado el plugin I Like This
****************/
function most_liked_posts_all($numberOf, $before, $after, $show_count) {
	global $wpdb;
    $request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta";
    $request .= " WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id";
		$request .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
    $request .= " AND post_status='publish' AND meta_key='_liked'";
		$request .= " ORDER BY $wpdb->postmeta.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	$post_count = $post->meta_value;
    	    	echo $before.'<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . title_trim(40, $post_title) . '</a>';
		echo $show_count == '1' ? ' ('.$post_count.')' : '';
		echo $after;
    }
}

/****************
Mostrar los más populares cantidad de visitas
del último mes
****************/
function most_viewed_posts($numberOf, $before, $after, $show_count) {
	global $wpdb;
    $request = "SELECT ID, post_title, meta_value FROM $wpdb->posts, $wpdb->postmeta";
    $request .= " WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id";
		$request .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
    $request .= " AND post_status='publish' AND meta_key='views'";
		$request .= " ORDER BY $wpdb->postmeta.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	$post_count = $post->meta_value;
    	    	echo $before.'<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . title_trim(40, $post_title) . '</a>';
		echo $show_count == '1' ? ' ('.$post_count.')' : '';
		echo $after;
    }
}

/****************
Mostrar los tags que empiecen con una determinada letra en forme de nube de etiquetas
****************/
function get_tagsbyletter($letter) {
	$tags = get_tags(array('name__like' => $letter) );
	echo wp_generate_tag_cloud1($tags);
}

function wp_generate_tag_cloud1( $tags, $args = '' ) {
	global $wp_rewrite;
	$defaults = array(
		'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 12,
		'format' => 'flat', 'separator' => "\n", 'orderby' => 'count', 'order' => 'DESC',
		'topic_count_text_callback' => 'default_topic_count_text',
		'topic_count_scale_callback' => 'default_topic_count_scale', 'filter' => 1,
	);

	if ( !isset( $args['topic_count_text_callback'] ) && isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
		$body = 'return sprintf (
			_n(' . var_export($args['single_text'], true) . ', ' . var_export($args['multiple_text'], true) . ', $count),
			number_format_i18n( $count ));';
		$args['topic_count_text_callback'] = create_function('$count', $body);
	}

	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	if ( empty( $tags ) )
		return;

	$tags_sorted = apply_filters( 'tag_cloud_sort', $tags, $args );
	if ( $tags_sorted != $tags  ) { // the tags have been sorted by a plugin
		$tags = $tags_sorted;
		unset($tags_sorted);
	} else {
		if ( 'RAND' == $order ) {
			shuffle($tags);
		} else {
			// SQL cannot save you; this is a second (potentially different) sort on a subset of data.
			if ( 'name' == $orderby )
				uasort( $tags, create_function('$a, $b', 'return strnatcasecmp($a->name, $b->name);') );
			else
				uasort( $tags, create_function('$a, $b', 'return ($a->count > $b->count);') );

			if ( 'DESC' == $order )
				$tags = array_reverse( $tags, true );
		}
	}

	if ( $number > 0 )
		$tags = array_slice($tags, 0, $number);

	$counts = array();
	$real_counts = array(); // For the alt tag
	foreach ( (array) $tags as $key => $tag ) {
		$real_counts[ $key ] = $tag->count;
		$counts[ $key ] = $topic_count_scale_callback($tag->count);
	}

	$min_count = min( $counts );
	$spread = max( $counts ) - $min_count;
	if ( $spread <= 0 )
		$spread = 1;
	$font_spread = $largest - $smallest;
	if ( $font_spread < 0 )
		$font_spread = 1;
	$font_step = $font_spread / $spread;

	$a = array();
	$functions_path = get_bloginfo('template_directory') . '/functions/buscar_tag.php';

	foreach ( $tags as $key => $tag ) {
		$count = $counts[ $key ];
		$real_count = $real_counts[ $key ];
		$tag_link = '#' != $tag->link ? esc_url( $tag->link ) : '#';
		$tag_id = isset($tags[ $key ]->id) ? $tags[ $key ]->id : $key;
		$tag_name = $tags[ $key ]->name;
		$tag_slug = $tags[ $key ]->slug;
		$a[] = "<a href='javascript:;' onclick='buscar_tag(\"$tag_slug\",\"$functions_path\",\"TAGS: $tag_name\")' style='font-size: " .
			( $smallest + ( ( $count - $min_count ) * $font_step ) )
			. "$unit;'>$tag_name</a>";	
	}

	switch ( $format ) :
	case 'array' :
		$return =& $a;
		break;
	case 'list' :
		$return = "<ul class='wp-tag-cloud'>\n\t<li>";
		$return .= join( "</li>\n\t<li>", $a );
		$return .= "</li>\n</ul>\n";
		break;
	default :
		$return = join( $separator, $a );
		break;
	endswitch;

    if ( $filter )
		return apply_filters( 'wp_generate_tag_cloud', $return, $tags, $args );
    else
		return $return;
}
function wp_generate_tag_cloud2( $tags, $args = '' ) {
	global $wp_rewrite;
	$defaults = array(
		'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 0,
		'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
		'topic_count_text_callback' => 'default_topic_count_text',
		'topic_count_scale_callback' => 'default_topic_count_scale', 'filter' => 1,
	);

	if ( !isset( $args['topic_count_text_callback'] ) && isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
		$body = 'return sprintf (
			_n(' . var_export($args['single_text'], true) . ', ' . var_export($args['multiple_text'], true) . ', $count),
			number_format_i18n( $count ));';
		$args['topic_count_text_callback'] = create_function('$count', $body);
	}

	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	if ( empty( $tags ) )
		return;

	$tags_sorted = apply_filters( 'tag_cloud_sort', $tags, $args );
	if ( $tags_sorted != $tags  ) { // the tags have been sorted by a plugin
		$tags = $tags_sorted;
		unset($tags_sorted);
	} else {
		if ( 'RAND' == $order ) {
			shuffle($tags);
		} else {
			// SQL cannot save you; this is a second (potentially different) sort on a subset of data.
			if ( 'name' == $orderby )
				uasort( $tags, create_function('$a, $b', 'return strnatcasecmp($a->name, $b->name);') );
			else
				uasort( $tags, create_function('$a, $b', 'return ($a->count > $b->count);') );

			if ( 'DESC' == $order )
				$tags = array_reverse( $tags, true );
		}
	}

	if ( $number > 0 )
		$tags = array_slice($tags, 0, $number);

	$counts = array();
	$real_counts = array(); // For the alt tag
	foreach ( (array) $tags as $key => $tag ) {
		$real_counts[ $key ] = $tag->count;
		$counts[ $key ] = $topic_count_scale_callback($tag->count);
	}

	$min_count = min( $counts );
	$spread = max( $counts ) - $min_count;
	if ( $spread <= 0 )
		$spread = 1;
	$font_spread = $largest - $smallest;
	if ( $font_spread < 0 )
		$font_spread = 1;
	$font_step = $font_spread / $spread;

	$a = array();

	foreach ( $tags as $key => $tag ) {
		$count = $counts[ $key ];
		$real_count = $real_counts[ $key ];
		$tag_link = '#' != $tag->link ? esc_url( $tag->link ) : '#';
		$tag_id = isset($tags[ $key ]->id) ? $tags[ $key ]->id : $key;
		$tag_name = $tags[ $key ]->name;
		$val = round( $smallest + ( ( $count - $min_count ) * $font_step ) );
		$a[] = "<div class='tt-bar tt-v-".$val." clearfix'><div class='left tt-title'><a href='$tag_link' class='tag-link-$tag_id' title='".esc_attr( $topic_count_text_callback( $real_count ))."'>$tag_name</a></div><div class='right tt-rating'>".$val."</div></div>";
	}

	switch ( $format ) :
	case 'array' :
		$return =& $a;
		break;
	case 'list' :
		$return = "<ul class='wp-tag-cloud'>\n\t<li>";
		$return .= join( "</li>\n\t<li>", $a );
		$return .= "</li>\n</ul>\n";
		break;
	default :
		$return = join( $separator, $a );
		break;
	endswitch;

    if ( $filter )
		return apply_filters( 'wp_generate_tag_cloud', $return, $tags, $args );
    else
		return $return;
}

//Trending topics como fortune
function wp_generate_tag_cloud3( $tags, $args = '' ) {
	global $wp_rewrite;
	$defaults = array(
		'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 0,
		'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
		'topic_count_text_callback' => 'default_topic_count_text',
		'topic_count_scale_callback' => 'default_topic_count_scale', 'filter' => 1,
	);

	if ( !isset( $args['topic_count_text_callback'] ) && isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
		$body = 'return sprintf (
			_n(' . var_export($args['single_text'], true) . ', ' . var_export($args['multiple_text'], true) . ', $count),
			number_format_i18n( $count ));';
		$args['topic_count_text_callback'] = create_function('$count', $body);
	}

	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	if ( empty( $tags ) )
		return;

	if ( $number > 0 )
		$tags = array_slice($tags, 0, $number);

	$counts = array();
	$real_counts = array(); // For the alt tag
	foreach ( (array) $tags as $key => $tag ) {
		$real_counts[ $key ] = $tag->count;
		$counts[ $key ] = $topic_count_scale_callback($tag->count);
	}

	$min_count = min( $counts );
	$spread = max( $counts ) - $min_count;
	if ( $spread <= 0 )
		$spread = 1;
	$font_spread = $largest - $smallest;
	if ( $font_spread < 0 )
		$font_spread = 1;
	$font_step = $font_spread / $spread;

	$a = array();

	foreach ( $tags as $key => $tag ) {
		$count = $counts[ $key ];
		$real_count = $real_counts[ $key ];
		$tag_link = '#' != $tag->link ? esc_url( $tag->link ) : '#';
		$tag_id = isset($tags[ $key ]->id) ? $tags[ $key ]->id : $key;
		$tag_name = $tags[ $key ]->name;
		$val = round( $smallest + ( ( $count - $min_count ) * $font_step ) );
		$comments = $tags[ $key ]->comment_count;
		$a[] = "<tr><td width=\"55%\"><h2><a href=\"$tag_link\" title=\"".esc_attr( $topic_count_text_callback( $real_count ))."\">$tag_name</a></h2></td><td width=\"30%\"><div class=\"metrics\"><div>";
        for($i=0; $i<10; $i++){
        	if($i <= $val ){
        		$a[] .= "<div class=\"newmetrics color3\"></div>";
        	} else{
        		$a[] .= "<div class=\"newmetrics color2\"></div>";
        	}
        }
        $a[] .= "</div></div></td><td width=\"15%\"><div class=\"comentarios alinearDer\">".$comments."</div></td></tr>";
	}

	switch ( $format ) :
	case 'array' :
		$return =& $a;
		break;
	case 'list' :
		$return = "<ul class='wp-tag-cloud'>\n\t<li>";
		$return .= join( "</li>\n\t<li>", $a );
		$return .= "</li>\n</ul>\n";
		break;
	default :
		$return = join( $separator, $a );
		break;
	endswitch;

    if ( $filter )
		return apply_filters( 'wp_generate_tag_cloud', $return, $tags, $args );
    else
		return $return;
}

//MOSTRAR ANUNCIO SOLO A LOS VISITANTES DESDE LOS BUSCADORES
function desdebusq(){
	$ref = $_SERVER['HTTP_REFERER'];
	$SE = array('/search?', 'images.google.', 'web.info.com', 'search.', 'del.icio.us/search', 'soso.com', '/search/', '.yahoo.');
	foreach ($SE as $source) {
		if (strpos($ref,$source)!==false) return true;
	}
	return false;
}

//Ofuscar Email
function hideEmail($mail){
	$mail = strrev($mail);
	return "<span style=\"direction:rtl; unicode-bidi:bidi-override;\">".$mail."</span>";
}

//Recortar textos largos
function title_trim($max_length, $title){
	//Make sure that we are not making it longer with that ellipse
	if((mb_strlen($title) + 3) > $max_length){
		//Trim the title
		$title = mb_substr($title, 0, $max_length - 1);
		//Make sure we can split at a space, but we want to limmit to cutting at max an additional 25%
		if(mb_strpos($title, ' ', .75 * $max_length) > 0)
		{
			//Don't split mid word
			while(mb_substr($title,-1) != ' ')
			{
				$title = mb_substr($title, 0, -1);
			}
		}
		//Remove the whitespace at the end and add the hellip
		return $title = rtrim($title) . '&hellip;';
	} else if((mb_strlen($title) + 3) <= $max_length) {
		return $title;
	}
}

function wp_list_authors_art($args = '') {
	global $wpdb;

	$defaults = array(
		'optioncount' => false, 'exclude_admin' => true,
		'show_fullname' => false, 'hide_empty' => true,
		'feed' => '', 'feed_image' => '', 'echo' => true,
		'orderby' => 'articles', 'days' => 30, 'show' => 5
	);

	$r = wp_parse_args( $args, $defaults );
	extract($r, EXTR_SKIP);

	$return = '';

	// TODO:  Move select to get_authors().
	switch ( $orderby ) :
	case 'views' :
		$authors = $wpdb->get_results("SELECT COUNT(b.ID) AS postsperuser, a.ID AS post_id, display_name, user_nicename, b.ID AS ID, sum(m.meta_value+0) AS visitas FROM wp_posts AS a, wp_users AS b, wp_postmeta AS m WHERE a.ID = m.post_id AND meta_key='views' AND a.post_author = b.ID AND post_type = 'post' AND post_status = 'publish' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY b.ID ORDER BY visitas DESC LIMIT $show");
		$select = (array) $wpdb->get_results("SELECT DISTINCT p.post_author, COUNT(DISTINCT p.ID) AS posts, sum(m.meta_value+0) AS count FROM wp_posts AS p, wp_postmeta AS m WHERE p.ID = m.post_id AND meta_key='views' AND p.post_type = 'post' AND p.post_status = 'publish' AND " . get_private_posts_cap_sql( 'post' ) . " AND p.post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY p.post_author ORDER BY count DESC LIMIT $show");
		break;
	case 'votes' :
		$authors = $wpdb->get_results("SELECT COUNT(b.ID) AS postsperuser, a.ID AS post_id, display_name, user_nicename, b.ID AS ID, sum(m.meta_value+0) AS visitas FROM wp_posts AS a, wp_users AS b, wp_postmeta AS m WHERE a.ID = m.post_id AND meta_key='_liked' AND a.post_author = b.ID AND post_type = 'post' AND post_status = 'publish' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY b.ID ORDER BY visitas DESC LIMIT $show");
		$select = (array) $wpdb->get_results("SELECT DISTINCT p.post_author, COUNT(DISTINCT p.ID) AS posts, sum(m.meta_value+0) AS count FROM wp_posts AS p, wp_postmeta AS m WHERE p.ID = m.post_id AND meta_key='_liked' AND p.post_type = 'post' AND p.post_status = 'publish' AND " . get_private_posts_cap_sql( 'post' ) . " AND p.post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY p.post_author ORDER BY count DESC LIMIT $show");
		break;
	case 'all' :
		$authors = $wpdb->get_results("SELECT a.ID AS post_id, display_name, user_nicename, b.ID AS ID, sum(views.meta_value+0) AS viewsc, sum(votos.meta_value+0) AS votosc, COUNT(b.ID) AS postsperuser FROM wp_posts AS a, wp_users AS b, wp_postmeta AS votos, wp_postmeta AS views WHERE a.ID = votos.post_id AND a.ID = views.post_id AND votos.meta_key='_liked' AND views.meta_key='views' AND a.post_author = b.ID AND post_type = 'post' AND post_status = 'publish' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY b.ID ORDER BY viewsc DESC, votosc DESC, postsperuser DESC LIMIT $show");
		$select = (array) $wpdb->get_results("SELECT DISTINCT p.post_author, sum(views.meta_value+0) AS viewsc, sum(votos.meta_value+0) AS votosc, COUNT(DISTINCT p.ID) AS posts, ((sum(views.meta_value+0))+(sum(votos.meta_value+0))+(COUNT(DISTINCT p.ID))) AS count FROM wp_posts AS p, wp_postmeta AS votos, wp_postmeta AS views WHERE p.ID = votos.post_id AND p.ID = views.post_id AND votos.meta_key='_liked' AND views.meta_key='views' AND p.post_type = 'post' AND p.post_status = 'publish' AND " . get_private_posts_cap_sql( 'post' ) . " AND p.post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY p.post_author ORDER BY viewsc DESC, votosc DESC, posts DESC LIMIT $show");
		break;
	case 'follows' :
		$authors = $wpdb->get_results("SELECT COUNT(b.ID) AS postsperuser, a.ID AS post_id, display_name, user_nicename, b.ID AS ID, COUNT(DISTINCT c.item_id) AS follows FROM wp_posts AS a, wp_users AS b, wp_follows AS c WHERE a.post_author = b.ID AND c.item_id = b.ID AND c.item_id = a.post_author AND c.item_type = 'author' AND post_type = 'post' AND post_status = 'publish' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY b.ID ORDER BY follows DESC LIMIT $show");
		$select = (array) $wpdb->get_results("SELECT DISTINCT a.post_author, COUNT(DISTINCT b.item_id) AS count FROM wp_posts AS a, wp_follows AS b WHERE a.post_type = 'post' AND a.post_status = 'publish' AND b.item_id = a.post_author AND b.item_type = 'author' AND " . get_private_posts_cap_sql( 'post' ) . " AND a.post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY a.post_author ORDER BY count DESC LIMIT $show");
		break;	
			
	default :
		$authors = $wpdb->get_results("SELECT COUNT(b.ID) AS postsperuser, a.ID AS post_id, display_name, user_nicename, b.ID AS ID FROM wp_posts AS a, wp_users AS b WHERE a.post_author = b.ID AND post_type = 'post' AND post_status = 'publish' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY b.ID ORDER BY postsperuser DESC LIMIT $show");
		$select = (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(DISTINCT ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND " . get_private_posts_cap_sql( 'post' ) . " AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' GROUP BY post_author ORDER BY count DESC LIMIT $show");
		break;
	endswitch;
	$author_count = array();
	foreach ($select as $row) {
		$author_count[$row->post_author] = $row->count;
	}

	foreach ( (array) $authors as $author ) {
		$author = get_userdata( $author->ID );
		$posts = (isset($author_count[$author->ID])) ? $author_count[$author->ID] : 0;
		$name = $author->display_name;

		if ( $show_fullname && ($author->first_name != '' && $author->last_name != '') )
			$name = "$author->first_name $author->last_name";

		if ( !($posts == 0 && $hide_empty) )
			$return .= '<li>';
		if ( $posts == 0 ) {
			if ( !$hide_empty )
				$link = $name;
		} else {
			$link = '<a href="' . get_author_posts_url($author->ID, $author->user_nicename) . '" title="' . sprintf(__("Posts by %s"), attribute_escape($author->display_name)) . '">' . $name . '</a>';

			if ( (! empty($feed_image)) || (! empty($feed)) ) {
				$link .= ' ';
				if (empty($feed_image))
					$link .= '(';
				$link .= '<a href="' . get_author_rss_link(0, $author->ID, $author->user_nicename) . '"';

				if ( !empty($feed) ) {
					$title = ' title="' . $feed . '"';
					$alt = ' alt="' . $feed . '"';
					$name = $feed;
					$link .= $title;
				}

				$link .= '>';

				if ( !empty($feed_image) )
					$link .= "<img src=\"$feed_image\" border=\"0\"$alt$title" . ' />';
				else
					$link .= $name;

				$link .= '</a>';

				if ( empty($feed_image) )
					$link .= ')';
			}

			if ( $optioncount )
			switch ( $orderby ) :
				case 'views' :
					$link .= ' ('. $posts . ' lecturas)';
					break;
				case 'votes' :
					$link .= ' ('. $posts . ' votos)';
					break;
				case 'follows' :
					$link .= ' ('. $posts . ' seguidores)';
					break;
				case 'all' :
					$link .= ' ('. $posts . ' puntos)';
					break;
				default :
					$link .= ' ('. $posts . ' artículos)';
					break;
				endswitch;
		}

		if ( !($posts == 0 && $hide_empty) )
			$return .= $link . '</li>';
	}
	if ( !$echo )
		return $return;
	echo $return;
}

//Mostrar los artículos más twiteados
function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
  $position = array();
  $newRow = array();
  foreach ($toOrderArray as $key => $row) {
    $position[$key]  = $row[$field];
    $newRow[$key] = $row;
  }
  if ($inverse) {
    arsort($position);
  }
  else {
    asort($position);
  }
  $returnArray = array();
  foreach ($position as $key => $pos) {     
    $returnArray[] = $newRow[$key];
  }
  return $returnArray;
}

function objectToArray( $object ){
  if( !is_object( $object ) && !is_array( $object ) ){
    return $object;
  }
  if( is_object( $object ) ){
    $object = get_object_vars( $object );
  }
  return array_map( 'objectToArray', $object );
}

function showmosttwittedposts(){
	$content = file_get_contents("http://otter.topsy.com/search.json?q=site:gestiopolis.com&window=d&perpage=50&order=influence");
	$retweets_count = json_decode($content);
	$retweets = objectToArray($retweets_count->response->list);
	$retweets = orderMultiDimensionalArray($retweets, 'trackback_total', true);
	//print_r($retweets);
	//echo '<ol>';
	for ($i=0; $i</*count($retweets)*/5; $i++){
	   $retweet_actual[$i] = $retweets[$i];
	   $title = str_replace(' | GestioPolis', '',$retweet_actual[$i]["title"]);
	   echo "<p><a href='" . $retweet_actual[$i]["url"] . "' title='" . $title . "'>" . $title . "</a> (" . $retweet_actual[$i]["trackback_total"] . ")</p>";
	}
	//echo'</ol>';
}

/****************
Mostrar los artículos más populares por comentarios, votos y visitas
Se necesita tener instalado el plugin I Like This
https://github.com/cabrerahector/wordpress-popular-posts/wiki/3.-Filters
https://wordpress.org/plugins/wordpress-popular-posts/installation/
****************/
function trending_posts($numberOf, $before, $after, $days) {
	global $wpdb;
    $request = "SELECT ID, post_title, votos.meta_value,views.meta_value, comment_count FROM $wpdb->posts posts INNER JOIN $wpdb->postmeta votos ON (posts.ID = votos.post_id)
INNER JOIN $wpdb->postmeta views ON (posts.ID = views.post_id)
WHERE posts.post_type='post' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' AND posts.post_status='publish' AND votos.meta_key='_liked' AND views.meta_key='views' ORDER BY views.meta_value+0 DESC, votos.meta_value+0 DESC, posts.comment_count DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID); ?>
    	    	<?php echo $before;?><?php get_the_image( array('post_id' => $post->ID, 'size' => 'trending-posts', 'width' => '50', 'height' => '43', 'default_image' => get_bloginfo('template_directory').'/images/thumbnail.png' ) ); ?><p class="desthheight"><a href="<?php echo $permalink; ?>" title="<?php echo $post_title ?>" rel="nofollow"><?php echo title_trim(70, $post_title);?></a></p>
	<?php 	echo $after;
    }
}

/****************
Mostrar los artículos más populares por comentarios, votos y visitas
Se necesita tener instalado el plugin I Like This
****************/
function get_trending_posts_deprecated($numberOf, $days, $catid = '') {
	global $wpdb;
    //$request = "SELECT ID, post_title, post_content, post_author, votos.meta_value AS likes,views.meta_value AS vistas, comment_count FROM $wpdb->posts posts INNER JOIN $wpdb->postmeta votos ON (posts.ID = votos.post_id) INNER JOIN $wpdb->postmeta views ON (posts.ID = views.post_id)";
    $request = "SELECT ID, post_title, post_content, post_author, views.meta_value AS vistas FROM $wpdb->posts posts INNER JOIN $wpdb->postmeta views ON (posts.ID = views.post_id)";
	if($catid != ''){
		$request .= " INNER JOIN $wpdb->term_relationships term ON (posts.ID = term.object_id)";
	}
	//$request .= " WHERE posts.post_type='post' AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' AND posts.post_status='publish' AND votos.meta_key='_liked' AND views.meta_key='views'";
	$request .= " WHERE posts.post_type='post' AND posts.post_status='publish' AND views.meta_key='views'";
	if($catid != ''){
	$request .= " AND term.term_taxonomy_id=$catid";
	}
	//$request .= " ORDER BY views.meta_value+0 DESC, votos.meta_value+0 DESC, posts.comment_count DESC LIMIT $numberOf";
	$request .= " ORDER BY views.meta_value+0 DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    return $posts;
}

/****************
Mostrar los artículos más populares por visitas en el día
Se necesita tener instalado el plugin Top 10 Plugin
****************/
function get_trending_posts($numberOf, $days, $catid = '') {
	global $wpdb;
	$fields = '';
	$where = '';
	$join = '';
	$groupby = '';
	$orderby = '';
	$limits = '';
	$match_fields = '';
	$table_name = $wpdb->base_prefix . "top_ten_daily";
	$current_time = current_time( 'timestamp', 0 );
	$from_date = $current_time - ( max( 0, ($days - 1) ) * DAY_IN_SECONDS );
	$from_date = gmdate( 'Y-m-d 0' , $from_date);
	$blog_id = 1;
	$fields = " postnumber, ";
	$fields .= "SUM(cntaccess) as vistas, dp_date, ";
	$fields .= "ID, post_title, post_content, post_author ";
	//$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID ";
	$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID INNER JOIN {$wpdb->postmeta} ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
	if($catid != ''){
		$join .= " INNER JOIN {$wpdb->term_relationships} ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) ";
	}
	$where .= $wpdb->prepare( " AND blog_id = %d ", $blog_id);				// Posts need to be from the current blog only
	$where .= " AND $wpdb->posts.post_status = 'publish' ";
	$where .= $wpdb->prepare( " AND dp_date >= '%s' ", $from_date);
	$where .= " AND $wpdb->postmeta.meta_key='_liked' ";
	if($catid != ''){
		$where .= $wpdb->prepare( " AND $wpdb->term_relationships.term_taxonomy_id = %d ", $catid );
	}
	$groupby = " postnumber ";
	$orderby = " vistas DESC, meta_value+0 DESC ";
	$limits .= $wpdb->prepare( " LIMIT %d ", $numberOf );
	$groupby = " GROUP BY {$groupby} ";
	$orderby = " ORDER BY {$orderby} ";
	$sql = "SELECT $fields FROM {$table_name} $join WHERE 1=1 $where $groupby $orderby $limits";
	$posts = $wpdb->get_results($sql);
  return $posts;
}
add_filter('tptn_add_counter_script_url','addcount_url_top_ten');
function addcount_url_top_ten($home_url) {
	return get_template_directory_uri().'/lib/functions/top-10-addcount.js.php';
}
add_filter('tptn_view_counter_script_url','viewcount_url_top_ten');
function viewcount_url_top_ten($home_url) {
	return get_template_directory_uri().'/lib/functions/top-10-counter.js.php';
}
function script_top_ten($output) {
	if ( is_single() ) {
		global $post;
		$home_url = get_template_directory_uri().'/lib/functions/top-10-addcount.js.php';
		return '<script type="text/javascript">jQuery.ajax({type: "POST", url: "' . $home_url . '", data: {top_ten_id: ' . $post->ID . ', top_ten_blog_id: 1, activate_counter: 11, top10_rnd: (new Date()).getTime() + "-" + Math.floor(Math.random()*100000)}});</script>';
	}
	return;
}
add_filter('tptn_viewed_count','script_top_ten');


/****************
Mostrar los autores con más artículos y más visitas a sus artículos
****************/
function get_trending_authors_deprecated($numberOf, $days, $catid = '') {
	global $wpdb;
    $request = "SELECT DISTINCT post_author, COUNT(ID) AS count, SUM(views.meta_value) AS vcount FROM wp_posts posts INNER JOIN wp_postmeta views ON (posts.ID = views.post_id)";
	if($catid != ''){
		$request .= " INNER JOIN $wpdb->term_relationships term ON (posts.ID = term.object_id)";
	}
	$request .= " WHERE posts.post_type = 'post' AND posts.post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' AND posts.post_status='publish' AND views.meta_key='views'";
	if($catid != ''){
		$request .= " AND term.term_taxonomy_id=$catid";
	}
	$request .= " GROUP BY posts.post_author ORDER BY count DESC, vcount DESC LIMIT $numberOf";
    $posts = $wpdb->get_results($request);
    return $posts;
}

/****************
Mostrar los autores con más artículos y más visitas a sus artículos
****************/
function get_trending_authors($numberOf, $days, $catid = '') {
	global $wpdb;
	$fields = '';
	$where = '';
	$join = '';
	$groupby = '';
	$orderby = '';
	$limits = '';
	$match_fields = '';
	$table_name = $wpdb->base_prefix . "top_ten_daily";
	$current_time = current_time( 'timestamp', 0 );
	$from_date = $current_time - ( max( 0, ($days - 1) ) * DAY_IN_SECONDS );
	$from_date = gmdate( 'Y-m-d 0' , $from_date);
	$blog_id = 1;
	$fields = " DISTINCT post_author, postnumber, ";
	$fields .= "COUNT(ID) AS count, SUM(cntaccess) as vistas, dp_date ";
	//$fields .= "ID, post_title, post_content, post_author ";
	//$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID ";
	$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID INNER JOIN {$wpdb->postmeta} ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
	if($catid != ''){
		$join .= " INNER JOIN {$wpdb->term_relationships} ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) ";
	}
	$where .= $wpdb->prepare( " AND blog_id = %d ", $blog_id);				// Posts need to be from the current blog only
	$where .= " AND $wpdb->posts.post_status = 'publish' ";
	$where .= $wpdb->prepare( " AND dp_date >= '%s' ", $from_date);
	$where .= " AND $wpdb->postmeta.meta_key='_liked' ";
	if($catid != ''){
		$where .= $wpdb->prepare( " AND $wpdb->term_relationships.term_taxonomy_id = %d ", $catid );
	}
	$groupby = " post_author ";
	$orderby = " count DESC, vistas DESC, meta_value+0 DESC  ";
	$limits .= $wpdb->prepare( " LIMIT %d ", $numberOf );
	$groupby = " GROUP BY {$groupby} ";
	$orderby = " ORDER BY {$orderby} ";
	$sql = "SELECT $fields FROM {$table_name} $join WHERE 1=1 $where $groupby $orderby $limits";
	$posts = $wpdb->get_results($sql);
  return $posts;
}


//Función para mostrar los artículos más populares de facebook de los últimos tantos días
function get_fbpops($days=7){
	global $wpdb;
	$request = "SELECT p.ID, post_title, countp FROM $wpdb->posts p INNER JOIN $wpdb->fbpops fb ON (p.ID = fb.postid) WHERE p.post_type='post' AND fb.fecha > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "' AND p.post_status='publish' ORDER BY fb.countp DESC, fb.fecha DESC LIMIT 10";
    $posts = $wpdb->get_results($request);
	foreach ($posts as $post) {
    	$post_title = stripslashes($post->post_title);
    	$permalink = get_permalink($post->ID);
    	    	echo '<a href="' . $permalink . '" title="' . $post_title.'" rel="nofollow">' . title_trim(80, $post_title) . ' ('.$post->countp.')</a>';
		echo $after;
    }
}

// Obtener número Followers en Twitter
function string_getInsertedString($long_string,$short_string,$is_html=false){
  if($short_string>=strlen($long_string))return false;
  $insertion_length=strlen($long_string)-strlen($short_string);
  for($i=0;$i<strlen($short_string);++$i){
    if($long_string[$i]!=$short_string[$i])break;
  }
  $inserted_string=substr($long_string,$i,$insertion_length);
  if($is_html && $inserted_string[$insertion_length-1]=='<'){
    $inserted_string='<'.substr($inserted_string,0,$insertion_length-1);
  }
  return $inserted_string;
}

function DOMElement_getOuterHTML($document,$element){
  $html=$document->saveHTML();
  $element->parentNode->removeChild($element);
  $html2=$document->saveHTML();
  return string_getInsertedString($html,$html2,true);
}

function getFollowers($username){
  $x = file_get_contents("http://twitter.com/".$username);
  $doc = new DomDocument;
  @$doc->loadHTML($x);
  $ele = $doc->getElementById('follower_count');
  $innerHTML=preg_replace('/^<[^>]*>(.*)<[^>]*>$/',"\\1",DOMElement_getOuterHTML($doc,$ele));
  return $innerHTML;
}

/* Cuenta de likes en facebook de la página de GestioPolis */
function fblikepagecount() {
	$content = file_get_contents("http://graph.facebook.com/GestioPolis/");
	$fb_likes_count = json_decode($content);
	return number_format($fb_likes_count->{'likes'});
}

//Imágenes de amigos de la página de GestioPolis en Facebook
function fbuserimages() {
	$url = "https://graph.facebook.com/gestiopolis/feed?access_token=154786858571|9f0f48d5806b1b8d35f1b436.1-100000135807160|DZ6K9p2iIQT5qpMSg2uOvZeopwQ";
	//$fb_group_posts = json_decode($content, true);
	//print_r($fb_group_posts);
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	//don't verify SSL (required for some servers)
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);             
	//get data from facebook and decode JSON
	$page = json_decode(curl_exec($c));
	//print_r($page);
	//print("<pre>".print_r($page->data,true)."</pre>");
	$i=0;
	foreach($page->data as $feed){
		//echo $feed->likes->data[0]->name;
		//echo $feed->likes->data[0]->id;
		if($feed->likes->data[0]->id != "" && $i<4){
		?>
	    <fb:profile-pic uid="<?php echo $feed->likes->data[0]->id;?>" width="32" height="32" linked="true"></fb:profile-pic>
	    <?php
		$i++;
		}
	}
	//close the connection
	curl_close($c);
}

//Imágenes de amigos de la página de GestioPolis en Twitter
function twuserimages() {
	$url = "https://api.twitter.com/1/followers/ids.json?cursor=-1&screen_name=gestiopoliscom";
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	//don't verify SSL (required for some servers)
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);             
	$twids = json_decode(curl_exec($c));
	$twusids=array_rand($twids->ids,4);
	$twusids = $twids->ids[$twusids[0]].','.$twids->ids[$twusids[1]].','.$twids->ids[$twusids[2]].','.$twids->ids[$twusids[3]];
	//close the connection
	curl_close($c);
	$url1 = "https://api.twitter.com/1/users/lookup.json?user_id=".$twusids;
	$c1 = curl_init($url1);
	curl_setopt($c1, CURLOPT_RETURNTRANSFER, 1);
	//don't verify SSL (required for some servers)
	curl_setopt($c1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c1, CURLOPT_SSL_VERIFYHOST, false);             
	//get data from facebook and decode JSON
	$twimgs = json_decode(curl_exec($c1));
	//print_r($page);
	foreach($twimgs as $twimg){
		echo "<a href=\"https://twitter.com/#!/",$twimg->screen_name,"\" title=\"Perfil de @",$twimg->screen_name,"\"><img src=\"",$twimg->profile_image_url,"\" width=\"32\" height=\"32\" alt=\"",$twimg->screen_name,"\" /></a> ";
	}
	//close the connection
	curl_close($c1);
}

//Actualizado hace # minutos, horas , días, semanas, meses
function time_to_last_post($type='home', $id=0){
	global $wpdb;
	switch($type){
		case 'home':
			$date = $wpdb->get_var("SELECT MAX(post_date) FROM $wpdb->posts WHERE post_status = 'publish'");
			$td = "hace ". time_diff(strtotime(date('Y-m-d H:i:s'))-strtotime($date));
    	break;
		case 'post':
		break;
		case 'tag':
		break;
		case 'author':
		break;
		case 'category':
		break;
	}
	echo $td;
}
function time_diff($s){ 
    $m=0;$hr=0;$d=0;//$td="ahora"; 
    if($s<60) { 
        $td = "$s segundo"; if($s>1) $td .= "s";
    }
    if($s>59) { 
        $m = (int)($s/60); 
        $s = $s-($m*60); // sec left over 
        $td = "$m minuto"; if($m>1) $td .= "s";
    } 
    if($m>59){ 
        $hr = (int)($m/60); 
        $m = $m-($hr*60); // min left over 
        $td = "$hr hora"; if($hr>1) $td .= "s"; 
        if($m>0) $td .= ", $m minuto"; if($m>1) $td .= "s"; 
    } 
    if($hr>23){ 
        $d = (int)($hr/24); 
        $hr = $hr-($d*24); // hr left over 
        $td = "$d día"; if($d>1) $td .= "s"; 
        if($d<3){ 
            if($hr>0) $td .= ", $hr hora"; if($hr>1) $td .= "s"; 
        } 
    }
    if($d>364){ 
        $y = (int)($d/365); 
        $d = $d-($y*365); // d left over 
        $td = "$y año"; if($y>1) $td .= "s"; 
        if($y<3){ 
            if($d>0) $td .= ", $d día"; if($d>1) $td .= "s"; 
        } 
    }
    return $td; 
}

// Mostrar número de compartidos, likes, etc de las redes sociales
/*
Provider Twitter: twitter, Facebook: facebook, Google+: plusone, Email: email, LinkedIn: linkedin 
*/
function sharethis_info($url, $provider) {
	//return;
	$url = urlencode($url);
	$content = wp_remote_retrieve_body(wp_remote_get('http://rest.sharethis.com/reach/getUrlInfo.php?url='.$url.'&provider='.$provider.'&pub_key=e2325913-d75e-4e04-8ca0-f5a48fa58db8&access_key=c6cb87b7601437ee299b9bd8ad06f558'));
	if( is_wp_error( $content ) ) {
	echo 0; }
	else { 
	$share_count = json_decode($content);
	echo number_format($share_count->$provider->inbound);
	}
}

/*$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID INNER JOIN {$wpdb->postmeta} ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
	if($catid != ''){
		$join .= " INNER JOIN {$wpdb->term_relationships} ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) ";
	}
	$where .= $wpdb->prepare( " AND blog_id = %d ", $blog_id);				// Posts need to be from the current blog only
	$where .= " AND $wpdb->posts.post_status = 'publish' ";
	$where .= $wpdb->prepare( " AND dp_date >= '%s' ", $from_date);
	$where .= " AND $wpdb->postmeta.meta_key='_liked' ";
	if($catid != ''){
		$where .= $wpdb->prepare( " AND $wpdb->term_relationships.term_taxonomy_id = %d ", $catid );
	}
	$groupby = " post_author ";
	$orderby = " count DESC, vistas DESC, meta_value+0 DESC  ";*/

/*Función que trae las etiquetas más vistas de determinada categoría*/
function popular_tags_from_category($catid, $days, $limit=15){
	global $wpdb;
	$now = gmdate("Y-m-d H:i:s",time());
	//$datelimit = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m"),date("d")-30,date("Y")));
	$current_time = current_time( 'timestamp', 0 );
	$from_date = $current_time - ( max( 0, ($days - 1) ) * DAY_IN_SECONDS );
	$from_date = gmdate( 'Y-m-d 0' , $from_date);
	$table_name = $wpdb->base_prefix . "top_ten_daily";
	//$where = " AND dp_date >= '$from_date' ";
	$popterms = "SELECT DISTINCT terms2.*, t2.count as count FROM $wpdb->posts as p1 LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id LEFT JOIN {$table_name} as top1 ON top1.postnumber = p1.ID LEFT JOIN {$wpdb->postmeta} as meta1 ON (p1.ID = meta1.post_id), $wpdb->posts as p2 LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id 	LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id 	LEFT JOIN {$table_name} as top2 ON top2.postnumber = p2.ID LEFT JOIN {$wpdb->postmeta} as meta2 ON (p2.ID = meta2.post_id) WHERE t1.taxonomy = 'category' AND p1.post_status = 'publish' AND top1.dp_date >= '$from_date' AND meta1.meta_key='_liked' AND terms1.term_id = '$catid' AND t2.taxonomy = 'post_tag' AND p2.post_status = 'publish' AND top2.dp_date >= '$from_date' AND meta2.meta_key='_liked' AND p1.ID = p2.ID ORDER BY count DESC, meta1.meta_value+0 DESC LIMIT $limit";
	$terms = $wpdb->get_results($popterms);
	if($terms){
		$args = array(
		'smallest'  => 18,
		'largest'   => 18,
		'unit'      => 'px',
		'number'    => $limit,
		'format'    => 'flat',
		'separator' => "\n",
		'orderby'   => 'name',
		'order'     => 'ASC',
		'link' => 'view',
		'taxonomy' => 'post_tag',
		'echo' => true );
	// Create links
	foreach ( $terms as $key => $tag ) {
		if ( 'edit' == $args['link'] )
			$link = get_edit_tag_link( $tag->term_id, $args['taxonomy'] );
		else
			$link = get_term_link( intval($tag->term_id), $args['taxonomy'] );
		if ( is_wp_error( $link ) )
			return false;

		$tag_link = '#' != $tag->link ? esc_url( $link ) : '#';
		$tag_id = isset($tag->term_id) ? $tag->term_id : $key;
		$tag_name = $terms[ $key ]->name;

		echo "<a href='$tag_link' class='tag-link-$tag_id' title='" . esc_attr( $tag->count ) . " posts'>$tag_name</a>";
	}	
		//echo wp_generate_tag_cloud( $terms, $args );
	}
}

/*Función que trae las etiquetas más vistas de determinada categoría*/
function trending_tags($limit=10, $days ){

	global $wpdb;
	$now = gmdate("Y-m-d H:i:s",time());
	//$datelimit = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m"),date("d")-30,date("Y")));
	$current_time = current_time( 'timestamp', 0 );
	$from_date = $current_time - ( max( 0, ($days - 1) ) * DAY_IN_SECONDS );
	$from_date = gmdate( 'Y-m-d 0' , $from_date);
	$table_name = $wpdb->base_prefix . "top_ten_daily";
	$where = " AND dp_date >= '$from_date' ";
	$popterms = "SELECT DISTINCT terms2.*, t2.count as count FROM $wpdb->posts as p2 LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id 	LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id LEFT JOIN {$table_name} as top2 ON top2.postnumber = p2.ID	LEFT JOIN {$wpdb->postmeta} as meta2 ON (p2.ID = meta2.post_id) WHERE t2.taxonomy = 'post_tag' AND p2.post_status = 'publish' AND top2.dp_date >= '$from_date' AND meta2.meta_key='_liked' ORDER BY count DESC, meta2.meta_value+0 DESC LIMIT $limit";
	$terms = $wpdb->get_results($popterms);
	return $terms;
}
/*Función que trae las etiquetas por letra*/
function old_style_name_like_wpse_123298($clauses) {
  remove_filter('term_clauses','old_style_name_like_wpse_123298');
  $pattern = '|(name LIKE )\'%(.+%)\'|';
  $clauses['where'] = preg_replace($pattern,'$1 \'$2\'',$clauses['where']);
  return $clauses;
}
add_filter('terms_clauses','old_style_name_like_wpse_123298');
function tags_by_letter($letter, $letterM){
	$tagsm = get_tags(array('name__like' => $letter) );
	//$tagsM = get_tags(array('name__like' => $letterM) );
	//$tags = array_merge($tagsm, $tagsM);
	return $tagsm;
}

//Obtener fecha actual en español
function actual_date(){
	$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	 
	echo date('j')." de ".$meses[date('n')-1]. " de ".date('Y');
}

function count_posts($type, $year, $month, $catid=0) {
	global $wpdb;
	switch ($type) {
		case 'catsarchive':
			$query = "SELECT count(ID) AS posts FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id INNER JOIN $wpdb->term_taxonomy ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id INNER JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id WHERE $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish' AND $wpdb->terms.term_id = $catid AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->posts.post_date >= '$year-$month-01' AND $wpdb->posts.post_date <= '$year-$month-31' ORDER BY post_date ASC";
			$result = $wpdb->get_var( $query );
			return $result;
		break;
		case 'cats':
			$year1= date('Y');
			$month1= date('m');
			$day1= date('d');
			$query = "SELECT count(ID) AS posts FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id INNER JOIN $wpdb->term_taxonomy ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id INNER JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id WHERE $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish' AND $wpdb->terms.term_id = $catid AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->posts.post_date >= '2000-01-01' AND $wpdb->posts.post_date <= '$year1-$month1-$day1' ORDER BY post_date ASC";
			$result = $wpdb->get_var( $query );
			return $result;
		break;
		case 'allarchive':
			$query = "SELECT count(ID) AS posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND post_date >= '$year-$month-01' AND post_date <= '$year-$month-31' ORDER BY post_date ASC";
			$result = $wpdb->get_var( $query );
			return $result;
		break;
		
		default:
			# code...
			break;
	}
}

//Número de autores por categoría
function autcat($catid) {
	global $wpdb;
	echo $wpdb->get_var("SELECT COUNT(DISTINCT post_author) AS count FROM $wpdb->posts posts INNER JOIN $wpdb->term_relationships term ON (posts.ID = term.object_id) WHERE posts.post_type = 'post' AND term.term_taxonomy_id= '$catid' AND posts.post_status='publish'");
}

//Obtener tags de una categoría específica
function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			$wpdb->posts as p1
			LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

			$wpdb->posts as p2
			LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id = '".$args['categories']."' AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

//Tiempo estimado de lectura
function estimate_time() {
	global $post;
	$result = "";
	$wpm = 250; //Palabras por minuto
	$content = '';
	if (get_post_meta($post->ID, "all2html_htmlcontent", true) != "") {
		$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? '/Gestiopolis' : '';
    $html_plain = file_get_contents($_SERVER['DOCUMENT_ROOT'].$servidor.get_post_meta($post->ID, "all2html_htmlcontent", true));
    $content = strip_tags($html_plain);
    $wpm = 180;
	}else {
		$content = strip_tags($post->post_content);
	}
	
	$content_words = str_word_count($content);
	$estimated_minutes = floor($content_words / $wpm);

	if ($estimated_minutes < 1) {
		$result = "1 minuto";
	}
	else if ($estimated_minutes > 60) {
		if ($estimated_minutes > 1440){
			$result = "más de un día";
		}
		else {
			$result = (floor($estimated_minutes / 60) == 1) ?  floor($estimated_minutes / 60) . " hora" : floor($estimated_minutes / 60) . " horas";
		}
	}
	else if ($estimated_minutes == 1) {
		$result = $estimated_minutes . " minuto";
	}
	else {
		$result = $estimated_minutes . " minutos";
	}
	return $result;
}

//Arreglar tamaño del elemento figure
add_filter('img_caption_shortcode','fix_img_caption_shortcode_inline_style',10,3);

function fix_img_caption_shortcode_inline_style($output,$attr,$content) {
	$atts = shortcode_atts( array(
		'id'	  => '',
		'align'	  => 'alignnone',
		'width'	  => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) )
		return $content;

	if ( ! empty( $atts['id'] ) )
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	if ( current_theme_supports( 'html5', 'caption' ) ) {
		return '<figure ' . $atts['id'] . ' class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	}

	$caption_width = 10 + $atts['width'];

	$caption_width = apply_filters( 'img_caption_shortcode_width', $caption_width, $atts, $content );

	$style = '';

	return '<div ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<p class="wp-caption-text">' . $atts['caption'] . '</p></div>';
}

function get_author_color_id($author_id=0){
	global $post;
	$firstletter = '';
	if($author_id == 0){
		$firstletter = mb_substr(get_the_author(), 0, 1);
	}else{
		$firstletter = mb_substr(get_the_author_meta('display_name', $author_id), 0, 1);
	}
	if ($firstletter == 'ñ' || $firstletter == 'Ñ' || $firstletter == 'á' || $firstletter == 'Á' || $firstletter == 'é' || $firstletter == 'É' || $firstletter == 'í' || $firstletter == 'Í' || $firstletter == 'ó' || $firstletter == 'Ó' || $firstletter == 'ú' || $firstletter == 'Á'){
		return '<span class="author-color author-color-nn">'.$firstletter.'</span>';
	} else {
		return '<span class="author-color author-color-'.strtolower($firstletter).'">'.strtoupper($firstletter).'</span>';
	}
}

//Función de related posts by tags and categories
//http://www.cssigniter.com/ignite/programmatically-get-related-wordpress-posts-easily/
function ci_get_related_posts_1( $post_id, $related_count, $args = array() ) {
  $args = wp_parse_args( (array) $args, array(
    'orderby' => 'rand',
    'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
  ) );

  $post       = get_post( $post_id );
  $taxonomies = get_object_taxonomies( $post, 'names' );

  $related_args = array(
    'post_type'      => get_post_type( $post_id ),
    'posts_per_page' => $related_count,
    'post_status'    => 'publish',
    'post__not_in'   => array( $post_id ),
    'orderby'        => 'relevance',
    's'							 => $post->post_title,
    //'cache_results'  => true,
    'tax_query'      => array()
  );

  foreach( $taxonomies as $taxonomy ) {
    $terms = get_the_terms( $post_id, $taxonomy );
    if ( empty( $terms ) ) continue;
    $term_list = wp_list_pluck( $terms, 'slug' );
    $related_args['tax_query'][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $term_list
    );
  }

  if( count( $related_args['tax_query'] ) > 1 ) {
    $related_args['tax_query']['relation'] = 'AND';
  }

  if( $args['return'] == 'query' ) {
  	return new WP_Query( $related_args );
  } else {
    return $related_args;
  }
}

function ci_get_related_posts_2( $post_id, $postsnot, $related_count, $paged, $args = array() ) {
  $args = wp_parse_args( (array) $args, array(
    'orderby' => 'rand',
    'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
  ) );

  $post       = get_post( $post_id );
  $taxonomies = get_object_taxonomies( $post, 'names' );

  $related_args = array(
    'post_type'      => get_post_type( $post_id ),
    'posts_per_page' => $related_count,
    'post_status'    => 'publish',
    'post__not_in'   => $postsnot,
    'orderby'        => $args['orderby'],
    'paged'					 => $paged,
    'tax_query'      => array()
  );

  foreach( $taxonomies as $taxonomy ) {
    $terms = get_the_terms( $post_id, $taxonomy );
    if ( empty( $terms ) ) continue;
    $term_list = wp_list_pluck( $terms, 'slug' );
    $related_args['tax_query'][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $term_list
    );
  }

  if( count( $related_args['tax_query'] ) > 1 ) {
    $related_args['tax_query']['relation'] = 'AND';
  }

  if( $args['return'] == 'query' ) {
  	return new WP_Query( $related_args );
  } else {
    return $related_args;
  }
}

function footer_lazyload() {
	if(is_single()){
    echo '
	<script type="text/javascript">
	    (function($){
	      $(".single img.lazy").show().lazyload({
				  effect : "fadeIn",
				  failure_limit : 40
				});
	    })(jQuery);
	</script>
	';
	}
}
add_action('wp_footer', 'footer_lazyload', 100);


function head_meta_schema() {
	if(is_single()) {
		global $post;
		echo '
	    <meta itemprop="dateModified" content="'.get_the_modified_time('c').'"/>
	    <meta itemprop="datePublished" content="'.get_the_time('c').'"/>
			';
	}
}
add_action('wp_head', 'head_meta_schema', 1);

function filter_lazyload($content) {
    return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
}
add_filter('the_content', 'filter_lazyload');

function preg_lazyload($img_match) {
 
  $img_replace = $img_match[1] . 'src="' . get_stylesheet_directory_uri() . '/assets/img/grey.gif" data-original' . substr($img_match[2], 3) . $img_match[3];

  $img_replace = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $img_replace);

  $img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
  return $img_replace;
}

function month_name($month) {
 
  switch ($month) {
  	case '1':
  		return 'Enero';
  		break;
  	case '2':
  		return 'Febrero';
  		break;
  	case '3':
  		return 'Marzo';
  		break;
  	case '4':
  		return 'Abril';
  		break;
  	case '5':
  		return 'Mayo';
  		break;
  	case '6':
  		return 'Junio';
  		break;
  	case '7':
  		return 'Julio';
  		break;
  	case '8':
  		return 'Agosto';
  		break;
  	case '9':
  		return 'Septiembre';
  		break;
  	case '10':
  		return 'Octubre';
  		break;
  	case '11':
  		return 'Noviembre';
  		break;
  	case '12':
  		return 'Diciembre';
  		break;										
  }
}

function custom_error_pages()
{
    global $wp_query;
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(403);
        get_template_part('403');
        exit;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(401);
        get_template_part('401');
        exit;
    }

    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 400)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(400);
        get_template_part('400');
        exit;
    }
}
 
function custom_error_title($title='',$sep='')
{
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
        return "Prohibido ".$sep." ".get_bloginfo('name');
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
        return "No autorizado ".$sep." ".get_bloginfo('name');

    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 400)
        return "Solicitud incorrecta ".$sep." ".get_bloginfo('name');
}
 
function custom_error_class($classes)
{
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $classes[]="error403";
        return $classes;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $classes[]="error401";
        return $classes;
    }

    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 400)
    {
        $classes[]="error400";
        return $classes;
    }
}
 
add_action('wp','custom_error_pages');
//NO cargara Contact form en todas partes
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
//Quitar Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

//Función de Wp_Imager https://github.com/Jany-M/WP-Imager
//require_once ('functions/wp-imager.php');
//Archivos necesarios para la cabecera en la administración
require_once ('functions/admin_head.php');
//Campo personalizado de autor virtual
require_once ('functions/meta_author.php');
//Campo personalizado de Enlace Externos
require_once ('functions/meta_exlinks.php');
//Campo personalizado de Descargas
require_once ('functions/meta_downloads.php');
//Campo personalizado de Imagen Principal
require_once ('functions/meta_main_image.php');
//Funciones para los seguimiento del blog
require_once ('functions/follows.php');
//Funciones para los anuncios
require_once ('functions/ads.php');
//require_once ('functions/form_functions.php');
//require_once ('functions/recommendations.php');
