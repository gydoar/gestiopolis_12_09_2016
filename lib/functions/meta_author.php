<?php

$author_meta = array(

	array(
		"name" => "author-name",
		"std" => "",
		"title" => "Nombre Alternativo del Autor",
		"description" => "Aqu&iacute; se pone el nombre alternativo del autor, cuando se quiere que &eacute;ste difiera del nombre registrado en la base de datos de WordPress pero que conserve la misma direcci&oacute;n de mail.",
		"description2" => "Ingresa el nombre alternativo para este Autor."
		),
	array(
		"name" => "author-bio",
		"std" => "",
		"title" => "Biograf&iacute;a del Autor",
		"description" => "Aqu&iacute; se pone la biograf&iacute;a alternativa del autor, cuando se quiere que &eacute;ste difiera de la biograf&iacute;a registrada en la base de datos de WordPress pero que conserve la misma direcci&oacute;n de mail.",
		"description2" => "Ingresa una peque&ntilde;a biograf&iacute;a del Autor."
		),	

);


function author_meta() {



	global $post, $author_meta;
	
	global $post_ID, $temp_ID;
	
	foreach($author_meta as $meta_box) {
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
		
		echo '<p><textarea name="' . $meta_box['name'] . '_value" class="gesti-textarea" />' . $meta_box_value . '</textarea></p>';
		echo '<p>' . $meta_box['description2'] . '</p>';
		echo '</div>';

	}
}





function create_author_meta() {
	global $theme_name;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'author-meta', 'Nombre del Autor', 'author_meta', 'post', 'normal', 'high' );
	}
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'author-meta', 'Nombre del Autor', 'author_meta', 'page', 'normal', 'high' );
	}
}





function save_author_meta( $post_id ) {
	global $post, $author_meta;
	
	foreach($author_meta as $meta_box) {
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

add_action('admin_menu', 'create_author_meta');
add_action('save_post', 'save_author_meta');


?>