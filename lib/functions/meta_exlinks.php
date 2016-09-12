<?php

$exlinks_meta = array(

	array(
		"name" => "exlinks",
		"std" => "",
		"title" => "Enlaces Externos del Art&iacute;culo",
		"description" => "Aqu&iacute; se ponen los enlaces externos del art&iacute;culo rellenando el formulario con el siguiente formato:<br />T&iacute;tulo del Enlace: <code>El marketing mix: conceptos, estrategias y aplicaciones</code><br />URL del Enlace: <code>http://books.google.com/books?id=B0OMnbAf3soC&printsec=frontcover&hl=es&source=gbs_v2_summary_r&cad=0#v=onepage&q&f=false</code> <br />Clase del Enlace:<ul> <li>Enlace Normal = <code>dejar vac&iacute;o</code></li><li>Enlace Documento Word = <code>doc</code></li><li>Enlace Power Point = <code>ppt</code></li><li>Enlace PDF = <code>pdf</code></li><li>Enlace Google  Books = <code>gbooks</code></li><li>Enlace hacia un Mapa = <code>mapa</code></li><li>Enlace hacia un V&iacute;deo = <code>video</code></li></ul>",
		"description2" => "Ingresa aqu&iacute; los enlaces externos de este art&iacute;culo. Para m&aacute;s informaci&oacute;n haz clic en \"&iquest;Qu&eacute; es esto?\""
		),
	);


function exlinks_meta() {



	global $post, $exlinks_meta;
	
	global $post_ID, $temp_ID;
	
	foreach($exlinks_meta as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		
		if($meta_box['name'] == 'exlinks'){
			
			//Si el campo esta vacío
			if($meta_box_value == "") {
				echo '<div class="post-meta">';
				echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				echo '<h2 style="margin:5px;">'.$meta_box['title'].' &nbsp;<a href="#help-' . $meta_box['name'] . '" class="gesti-open">&iquest;Qu&eacute; es esto?</a></h2>';
				//cuadro de Ayuda
				echo '<div id="help-' . $meta_box['name'] . '" class="help-box">';
				echo '<p>' . $meta_box['description'] . '</p>';
				echo '<p><a href="#help-' . $meta_box['name'] . '" class="gesti-close">Cerrar</a></p>';
				echo '</div>';
				
				echo '<p id="exlinks-o">';
				echo '<label for="exlinks_t[]">T&iacute;tulo del Enlace:</label><input type="text" name="exlinks_t[]" class="gesti-input" /><br />';
				echo '<label for="exlinks_u[]">URL del enlace:</label><input type="text" name="exlinks_u[]" class="gesti-input" /><br />';
				//echo '<label for="exlinks_c[]">Clase de enlace:</label><input type="text" name="exlinks_c[]" class="gesti-input" /><br />';
				echo '&nbsp;&nbsp;<a href="javascript:;" class="borrarjq" rel="exlinks-o">Borrar Enlace</a>';
				echo '</p>';
				for($m=0; $m<20; $m++){
					echo '<p id="exlinks-',$m,'" style="display:none">';
					echo '<label for="exlinks_t[]">T&iacute;tulo del Enlace:</label><input type="text" name="exlinks_t[]" class="gesti-input" /><br />';
					echo '<label for="exlinks_u[]">URL del enlace:</label><input type="text" name="exlinks_u[]" class="gesti-input" /><br />';
					//echo '<label for="exlinks_c[]">Clase de enlace:</label><input type="text" name="exlinks_c[]" class="gesti-input" /><br />';
					echo '&nbsp;&nbsp;<a href="javascript:;" class="borrarjq" rel="exlinks-',$m,'">Borrar Enlace</a>';
					echo '</p>';	
				}
				echo '<br /><a href="javascript:;" id="agrexl">Agregar otro enlace</a>';
				echo '<p>' . $meta_box['description2'] . '</p>';
				echo '</div>';
			}else{
				echo '<div class="post-meta">';
				echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				echo '<h2 style="margin:5px;">'.$meta_box['title'].' &nbsp;<a href="#help-' . $meta_box['name'] . '" class="gesti-open">&iquest;Qu&eacute; es esto?</a></h2>';
				//cuadro de Ayuda
				echo '<div id="help-' . $meta_box['name'] . '" class="help-box">';
				echo '<p>' . $meta_box['description'] . '</p>';
				echo '<p><a href="#help-' . $meta_box['name'] . '" class="gesti-close">Cerrar</a></p>';
				echo '</div>';
				$exlinks = unserialize($meta_box_value);
				$n = 0;
				foreach($exlinks as $q){
					echo '<p id="exlinks-ed-',$n,'">';
					echo '<label for="exlinks_t[]">T&iacute;tulo del Enlace:</label><input type="text" name="exlinks_t[]" class="gesti-input" value="',$q['titulo'],'" /><br />';
					echo '<label for="exlinks_u[]">URL del enlace:</label><input type="text" name="exlinks_u[]" class="gesti-input" value="',$q['exlink'],'" /><br />';
					//echo '<label for="exlinks_c[]">Clase de enlace:</label><input type="text" name="exlinks_c[]" class="gesti-input" value="',$q['clase'],'" /><br />';
					echo '&nbsp;&nbsp;<a href="javascript:;" class="borrarjq" rel="exlinks-ed-',$n,'">Borrar Enlace</a>';
					echo '</p>';
					$n++; 
				} 
				for($m=0; $m<20; $m++){
					echo '<p id="exlinks-',$m,'" style="display:none">';
					echo '<label for="exlinks_t[]">T&iacute;tulo del Enlace:</label><input type="text" name="exlinks_t[]" class="gesti-input" /><br />';
					echo '<label for="exlinks_u[]">URL del enlace:</label><input type="text" name="exlinks_u[]" class="gesti-input" /><br />';
					//echo '<label for="exlinks_c[]">Clase de enlace:</label><input type="text" name="exlinks_c[]" class="gesti-input" /><br />';
					echo '&nbsp;&nbsp;<a href="javascript:;" class="borrarjq" rel="exlinks-',$m,'">Borrar Enlace</a>';
					echo '</p>';	
				}
				echo '<br /><a href="javascript:;" id="agrexl">Agregar otro enlace</a>';
				echo '<p>' . $meta_box['description2'] . '</p>';
				echo '</div>';
			}
		}

	}
}

function create_exlinks_meta() {
	global $theme_name;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'exlinks-meta', 'Enlaces Externos', 'exlinks_meta', 'post', 'normal', 'high' );
	}
	
}





function save_exlinks_meta( $post_id ) {
	global $post, $exlinks_meta;
	
	foreach($exlinks_meta as $meta_box) {
	// Verifica
		/*if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}*/
		
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
		}
		
		if($meta_box['name'] == 'exlinks' && !empty($_POST['exlinks_t']) ){
			//$data = $_POST[$meta_box['name'].'_value'];
			$titulo=array_values(array_filter($_POST['exlinks_t']));
			$exlink=array_values(array_filter($_POST['exlinks_u']));
			//$clase=array_values(array_filter($_POST['exlinks_c']));
			$exlinks = array();
			for ($i=0; $i<count($titulo); $i++){
			   $exlinks[] = array("titulo" => $titulo[$i],"exlink" => $exlink[$i]/*,"clase" => $clase[$i]*/);
			}
			$data = ($exlinks == array()) ? "" : serialize($exlinks);

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
				
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
				update_post_meta($post_id, $meta_box['name'].'_value', $data);
				
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
		}else{
			$data = $_POST[$meta_box['name'].'_value'];
			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
				
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
				update_post_meta($post_id, $meta_box['name'].'_value', $data);
				
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));	
		}
	}
}

add_action('admin_menu', 'create_exlinks_meta');
add_action('save_post', 'save_exlinks_meta');


?>