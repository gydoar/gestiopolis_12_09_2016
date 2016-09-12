<?
/*
   Plugin Name: Recommendations GP
   Plugin URI: http://www.trazos-web.com/
   Description: Plugin que se encarga de manejar las recomendaciones para los usuarios de GestioPolis y de mostrar información detallada a los Administradores
   Version: 1.0.0
   Author: Diego Castillo
   Author URI: http://www.trazos-web.com
   */
/*********************************************
*
* MOVER ESTE ARCHIVO AL DIRECTORIO DE PLUGINS
* FUNCIONES RELATIVAS AL ADMIN
*
*********************************************/
define("RECOMMENDATIONS_INTERVAL_MIN", 240); //Intervalo de tiempo en minutos de ejecución del WP-Cron. Por defecto (240) minutos. 4 horas

/* Ejecuta la función recommendations_activation() cuando se activa el plugin. */
register_activation_hook(__FILE__,'recommendations_activation');

/* Ejecuta la función recommendations_deactivation() cuando se desactiva el plugin */
register_deactivation_hook(__FILE__,'recommendations_deactivation');

/*Función que ejecuta el wp-cron,  añade valores a la BD cuando se activa el plugin*/
if (!function_exists('recommendations_activation')) :
function recommendations_activation(){
	/*Ejecuta la función ligada a la acción 'executes_rec_daily' si esta no se esta ejecutando actualmente*/
	if(!wp_next_scheduled('executes_rec_daily')){
		//Después de una hora de activado el plugin. Cron ejecutado cada tiempo según el valor dado. Por defecto 4 horas.	
		wp_schedule_event(time()+60, 'recommendations_interval', 'executes_rec_daily'); 
	}
}
endif;

/* Crea la acción 'executes_rec_daily' a la función drop_old_recommendations */
add_action('executes_rec_daily', 'drop_old_recommendations');

/**
* Para borrar los registros cada tiempo determinado (4 horas)
*/

function recomm_more_reccurences() {
	return array(
			'recommendations_interval' => array('interval' => 59*(RECOMMENDATIONS_INTERVAL_MIN), 'display' => 'Borrar registros antiguos cada ' .RECOMMENDATIONS_INTERVAL_MIN. ' minutos' )
	);
}
add_filter('cron_schedules', 'recomm_more_reccurences');

/*Función que ejecuta el wp-cron,  añade valores a la BD cuando se activa el plugin*/
if (!function_exists('recommendations_deactivation')) :
function recommendations_deactivation(){
	/*Elimina el WP-Cron 'executes_rec_daily'*/
	wp_clear_scheduled_hook('executes_rec_daily');
}
endif;

//Función que elimina los registros de más de 30 días en la Base de Datos
function drop_old_recommendations() {
	global $wpdb;
	$wpdb->query("DELETE FROM {$wpdb->prefix}recommendations WHERE read_date < '".date('Y-m-d', strtotime('-30 days'))."' LIMIT 250");
}

/*********************************************
*
* FUNCIONES RELATIVAS AL USUARIO
*
*********************************************/  
/* Función que se encarga de grabar los últimos
   posts vistos por el usuario con sus respectivos datos */
function set_recommendations($userid, $postid, $catids='', $tagids='', $authorid=''){
	global $wpdb;
	$exist_rec = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM {$wpdb->prefix}recommendations WHERE user_id = %d AND post_id = %d", $userid, $postid));
	if($exist_rec){
		return;
	}else{
		$wpdb->insert("{$wpdb->prefix}recommendations", array( 'user_id' => $userid, 'post_id' => $postid, 'catids' => $catids, 'tagids' => $tagids, 'authorid' => $authorid, 'read_date' => date("Y-m-d H:i:s") ), array( '%d', '%d', '%s', '%s', '%s', '%s' ) );
	}
}
/* Función que obtiene las recomendaciones de artículos para el usuario especificado */
function get_recommendations($userid, $limit, $excerpt=false){
	global $wpdb, $post;
	$recs = $wpdb->get_results($wpdb->prepare("SELECT post_id, catids, tagids FROM {$wpdb->prefix}recommendations WHERE user_id = %d", $userid));
	$i = 1;
	foreach($recs as $rec){
		if($i == 1){
			$postids = $rec->post_id;
			$catids = $rec->catids;
			$tagids = $rec->tagids;
		}else{
			$postids .= ','.$rec->post_id;
			$catids .= ','.$rec->catids;
			$tagids .= ','.$rec->tagids;
		}
		$i++;
	}
	$postsa = explode(',',$postids);
	$catsa = explode(',',$catids);
	$tagsa = explode(',',$tagids);
	
	$postsu = array_unique($postsa);
	$catsu = array_unique($catsa);
	$tagsu = array_unique($tagsa);
	
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $limit,
		'post__not_in' => $postsu,
		'category__in' => $catsu,
		'tag__in' => $tagsu
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div id="post-<?php echo $post->ID; ?>" class="box post">
		<div class="postcont">
        <div class="post-title">
        <h1><a title="<?php the_title(); ?>" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <ul class="the_post_meta">
        <!--Campo Personalizado Nombre Alternativo de Autor-->
        <?php if(get_post_meta($post->ID, "author-name_value", $single = true) != "") : ?>
        <li><a href="<?php bloginfo('url') ?>/author/<?php the_author_meta('nickname'); ?>"><?php echo get_post_meta($post->ID, "author-name_value", $single = true); ?></a></li>
        <?php else : ?>
        <li>Por <?php the_author_posts_link(); ?></li>
        <?php endif; ?>
        <!--/nombre autor-->
        <li>el <?php the_time('j.m.Y') ?></li>
        </ul><!--/the_post_meta-->
        </div><!--/post-title -->

        <?php if ($excerpt != false){ ?>
        <?php the_excerpt(); ?>
        <?php } ?>
        <div class="clear"></div>
		</div><!--/postcont -->
        </div><!--/box post-->
<?php endwhile; else: ?>
	No hay artículos recomendados por ahora.
<?php	 endif; 
} // Termina get_recommendations()
/* Función que obtiene los últimos 5 artículos leídos por el usuario */
function last_read($userid){
	global $wpdb;
	$recs = $wpdb->get_results($wpdb->prepare("SELECT post_id, read_date FROM {$wpdb->prefix}recommendations WHERE user_id = %d ORDER BY read_date DESC LIMIT 5", $userid));
	foreach($recs as $rec){ ?>
    	<li><a title="<?php echo get_the_title($rec->post_id); ?>" rel="bookmark" href="<?php echo get_permalink($rec->post_id); ?>"><?php echo get_the_title($rec->post_id); ?> </a> - <?php echo $rec->read_date; ?></li>
	<?php }
}
//Función que cuenta el total de lecturas del usuario en el mes
function count_reads($userid){
	global $wpdb;
	return $wpdb->get_var($wpdb->prepare("SELECT COUNT(rec_id) FROM {$wpdb->prefix}recommendations WHERE user_id=%d", $userid));
}
//Función que trae las categorías, autores y/o etiquetas más leidas
function most_read($userid, $section = 'cat'){
	global $wpdb;
	switch($section) :
	case 'cat':
		$recs = $wpdb->get_results($wpdb->prepare("SELECT catids FROM {$wpdb->prefix}recommendations WHERE user_id = %d", $userid));
		$i = 1;
		foreach($recs as $rec){
			if($i == 1){
				$catids = $rec->catids;
			}else{
				$catids .= ','.$rec->catids;
			}
			$i++;
		}
		$catsa = explode(',',$catids);
		
		$catsc =	array_count_values($catsa);
		$catsarray = array();
		$maxcount=0;
		$mincount=0;
		foreach($catsc as $catid => $catcount){
			$catsarray[] = array("catid" => $catid,"catcount" => $catcount);
		}
		$cats = orderMultiDimensionalArray($catsarray, 'catcount', true);
		
		$min_count = min( $catsc );
		$spread = max( $catsc ) - $min_count;
		if ( $spread <= 0 )
			$spread = 1;
		$font_spread = 100 - 25;
		if ( $font_spread < 0 )
			$font_spread = 1;
		$font_step = $font_spread / $spread;
		
		echo '<table cellspacing="0" cellpadding="0" border="0" class="recommendationBarCats" style="font-size:1em;"><tbody>';
		$i = 1;
		foreach($cats as $cat){
			$count = $cat['catcount'];
			$val = round( 25 + ( ( $count - $min_count ) * $font_step ) );
			echo '<tr><td class="catname" style="font-weight:bold; text-align:right; width:35%; font-size:1.3em; margin:0;border-top: 1px solid #E2E2E2; padding:8px 0 8px 10px;">'.get_cat_name($cat['catid']).'</td> <td style="width:55%; font-size:1.3em; margin:0;border-top: 1px solid #E2E2E2; padding:8px 0 8px 10px;"><div class="bar" style="width:'.$val.'%; background-color:#123456; height:10px;"> </div></td> <td class="catval" style="font-weight:bold; text-align:right; width:10%; font-size:1.3em; margin:0;border-top: 1px solid #E2E2E2; padding:8px 0 8px 10px;">'.$count.'</td></tr>';
			if($i == 5)break;
			$i++;
		}
		echo '</tbody></table>';
	break;
	case 'tag':
		$recs = $wpdb->get_results($wpdb->prepare("SELECT tagids FROM {$wpdb->prefix}recommendations WHERE user_id = %d", $userid));
		$i = 1;
		foreach($recs as $rec){
			if($i == 1){
				$tagids = $rec->tagids;
			}else{
				$tagids .= ','.$rec->tagids;
			}
			$i++;
		}
		$tagsa = explode(',',$tagids);
		
		$tagsc =	array_count_values($tagsa);
		$tagsarray = array();
		$maxcount=0;
		$mincount=0;
		foreach($tagsc as $tagid => $tagcount){
			$tagsarray[] = array("tagid" => $tagid,"tagcount" => $tagcount);
		}
		$tags = orderMultiDimensionalArray($tagsarray, 'tagcount', true);
		
		echo '<ul>';
		$i = 1;
		foreach($tags as $tag){
			$count = $tag['tagcount'];
			//$val = round( 25 + ( ( $count - $min_count ) * $font_step ) );
			$tagg = &get_tag( $tag['tagid'] );
			echo '<li><a href="'.get_tag_link($tag['tagid']).'" title="Leer más de '.$tagg->name.' ('.$count.')">'.$tagg->name.'</a></li>';
			if($i == 5)break;
			$i++;
		}
		echo '</ul>';
	break;
	case 'author':
		$recs = $wpdb->get_results($wpdb->prepare("SELECT display_name, authorid, COUNT(authorid) AS countaut FROM {$wpdb->prefix}recommendations, {$wpdb->prefix}users WHERE user_id=%d AND ID = authorid GROUP BY authorid ORDER BY countaut DESC LIMIT 5", $userid));
		echo '<ul>';
		foreach($recs as $rec){
			echo '<li><a href="'.get_author_link($echo = false, $rec->authorid).'" title="Leer más de '.$rec->display_name.' ('.$rec->countaut.')">'.$rec->display_name.'</a></li>';
		}
		echo '</ul>';
	break;
	endswitch;
}
?>
