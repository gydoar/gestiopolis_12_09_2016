<?php

$downloads_meta = array(

	array(
		"name" => "downloads",
		"std" => "",
		"title" => "Enlace de la Descarga del Archivo",
		"description" => "Aqu&iacute; se pone el enlace para descargar el archivo que se ha subido.Por ejemplo:<br /><code>http://www.blogestiopolis.com/wp-content/uploads/2011/08/25/archivo-de-ejemplo.zip</code>",
		"description2" => "Ingresa aqu&iacute; el enlace del archivo a descargar. Para m&aacute;s informaci&oacute;n haz clic en \"&iquest;Qu&eacute; es esto?\""
		),
	);


function downloads_meta() {



	//Este código trae todas nuestras opciones de administración.
	/*global $options;
	foreach ($options as $value) {
		if (get_settings( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		} else { 
			$$value['id'] = get_settings( $value['id'] ); 
		}
	}*/


	global $post, $downloads_meta;
	
	global $post_ID, $temp_ID;
	
	foreach($downloads_meta as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		
		//Si el campo esta vacío
		if($meta_box_value == "") {
		
			$meta_box_value = $meta_box['std'];
			
		}
			
		echo '<div class="post-meta">';
		echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo '<h2 style="margin:5px;">'.$meta_box['title'].' &nbsp;<a href="#help-' . $meta_box['name'] . '" class="gesti-open">&iquest;Qu&eacute; es esto?</a></h2>';
		
		//cuadro de Ayuda
		echo '<div id="help-' . $meta_box['name'] . '" class="help-box">';
		echo '<p>' . $meta_box['description'] . '</p>';
		echo '<p><a href="#help-' . $meta_box['name'] . '" class="gesti-close">Cerrar</a></p>';
		echo '</div>';
		
		echo '<p><input name="' . $meta_box['name'] . '_value" class="gesti-input" value="' . $meta_box_value . '" /></p>';
		echo '<p>' . $meta_box['description2'] . '</p>';
		echo '</div>';

	}
}





function create_downloads_meta() {
	global $theme_name;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'downloads-meta', 'Enlace de Descarga', 'downloads_meta', 'post', 'normal', 'high' );
	}
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'downloads-meta', 'Enlace de Descarga', 'downloads_meta', 'page', 'normal', 'high' );
	}
}





function save_downloads_meta( $post_id ) {
	global $post, $downloads_meta;
	
	foreach($downloads_meta as $meta_box) {
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
		
		$data = $_POST[$meta_box['name'].'_value'];
		
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}




add_action('admin_menu', 'create_downloads_meta');
add_action('save_post', 'save_downloads_meta');


?>