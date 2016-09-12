<?php

$main_image_meta = array(

	array(
		"name" => "main_image",
		"std" => "",
		"title" => "URL Original de la Imagen en Flickr: ",
		"description" => "Aqu&iacute; se pone el enlace  original de una imagen de Flickr para descargar el archivo, y asociar dicha imagen en la librer&iacute;a multimedia y que se ponga como imagen destacada de este art&iacute;culo.Por ejemplo:<br /><code>http://www.flickr.com/photos/dannyqu/4753513735/</code>",
		"description2" => "Ingresa aqu&iacute; la URL de una imagen en Flickr. Para m&aacute;s informaci&oacute;n haz clic en \"&iquest;Qu&eacute; es esto?\""
		),
	);


function main_image_meta() {

	global $post, $main_image_meta;
	
	global $post_ID, $temp_ID;
	
	foreach($main_image_meta as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, 'image_url_value', true);
		

			
		echo '<div class="post-meta">';
		echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo '<h2 style="margin:5px;">'.$meta_box['title'].' &nbsp;<a href="#help-' . $meta_box['name'] . '" class="gesti-open">&iquest;Qu&eacute; es esto?</a></h2>';
		
		//cuadro de Ayuda
		echo '<div id="help-' . $meta_box['name'] . '" class="help-box">';
		echo '<p>' . $meta_box['description'] . '</p>';
		echo '<p><a href="#help-' . $meta_box['name'] . '" class="gesti-close">Cerrar</a></p>';
		echo '</div>';
		
		//Si el campo esta vacío
		if($meta_box_value == "") {
			echo '<input class="gesti-input" type="text" name="imageedit" id="imageedit" value="">';
			echo '<p><input type="file" name="' . $meta_box['name'] . '_value" class="gesti-input" value="" /></p>';
			
		}else {
			echo '<input class="gesti-input" type="text" name="imageedit" id="imageedit" value="' . $meta_box_value . '">';
			echo '<p><input type="file" name="' . $meta_box['name'] . '_value" class="gesti-input" value="" /></p>';

		}
		
		echo '<p>' . $meta_box['description2'] . '</p>';
		echo '</div>';

	}
}

function create_main_image_meta() {
	global $theme_name;
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'main_image-meta', 'Imagen Principal', 'main_image_meta', 'post', 'normal', 'high' );
	}
}

function save_main_image_meta( $post_id ) {
	global $post, $main_image_meta;
	
	foreach($main_image_meta as $meta_box) {
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
		
		//$data = $_POST['image_value'];
		$file = ( !empty($_FILES[$meta_box['name'].'_value'])) ? $_FILES[$meta_box['name'].'_value'] : false;

		if(get_post_meta($post_id, 'image_url_value') == "" && $_POST['imageedit'] != ""){
			flickr_image_attach ($_POST['imageedit'], $post_id);
			if($file){
				$arch = pathinfo($file['name']);
        $extension = $arch['extension'];
        if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG'){
        	$id = media_handle_sideload( $file, $post_id, $desc=null );
        	// If error storing permanently, unlink
					if ( is_wp_error($id) ) {
						return $id;
					}

					$fullsize_path = get_attached_file( $id ); // Full path
					if (function_exists('ewww_image_optimizer')) {
						ewww_image_optimizer($fullsize_path, $gallery_type = 4, $converted = false, $new = true, $fullsize = true);
					}
					$src = wp_get_attachment_url( $id );
					if (!empty($src)){
						update_post_meta($post_id, 'image_value', $src);
						set_post_thumbnail( $post_id, $id );
						return update_post_meta($post_id, 'Thumbnail', $src);
					}
				}
			}
		} elseif($_POST['imageedit'] != "" && $_POST['imageedit'] != get_post_meta($post_id, 'image_url_value', true)){
			flickr_image_attach ($_POST['imageedit'], $post_id);
			if($file){
				$arch = pathinfo($file['name']);
        $extension = $arch['extension'];
        if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG'){
        	$id = media_handle_sideload( $file, $post_id, $desc=null );
        	// If error storing permanently, unlink
					if ( is_wp_error($id) ) {
						return $id;
					}

					$fullsize_path = get_attached_file( $id ); // Full path
					if (function_exists('ewww_image_optimizer')) {
						ewww_image_optimizer($fullsize_path, $gallery_type = 4, $converted = false, $new = true, $fullsize = true);
					}
					$src = wp_get_attachment_url( $id );
					if (!empty($src)){
						update_post_meta($post_id, 'image_value', $src);
						set_post_thumbnail( $post_id, $id );
						return update_post_meta($post_id, 'Thumbnail', $src);
					}
				}
			}
		}	elseif($_POST['imageedit'] == ""){
			$post_thumbnail_id = get_post_thumbnail_id($post_id);
			wp_delete_attachment( $post_thumbnail_id, true );
			delete_post_meta($post_id, 'image_url_value');
			delete_post_meta($post_id, 'image_author_t_value');
			delete_post_meta($post_id, 'image_value');
			delete_post_thumbnail($post_id);
			delete_post_meta($post_id, 'Thumbnail');
		}
	}
}

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');

add_action('admin_menu', 'create_main_image_meta');
add_action('save_post', 'save_main_image_meta');

//Funciones para migrar imagen de Flickr a WordPress
function flickr_image_attach ($flickrurl, $post_id){
	preg_match('/http\:\/\/www\.flickr\.com\/photos\/(.*?)\/([0-9]+)\//si', $flickrurl, $m);
	if($m){
		$flickruser = $m[1];
		$photo_id = $m[2];
	}else{
		return;
	}
	update_post_meta($post_id, 'image_url_value', $flickrurl);
	return update_post_meta($post_id, 'image_author_t_value', $flickruser);
}

//Funciones para migrar imagen de Flickr a WordPress
function flickr_image_attach_deprecated ($flickrurl, $post_id){
	preg_match('/http\:\/\/www\.flickr\.com\/photos\/(.*?)\/([0-9]+)\//si', $flickrurl, $m);
	if($m){
		$flickruser = $m[1];
		$photo_id = $m[2];
	}else{
		return;
	}
	//$flickruser = getFlickrUser($photo_id);
	$file = getFlickrURL($photo_id);
	if ( ! empty($file) ) {
		// Download file to temp location
		$tmp = download_url( $file );

		// Set variables for storage
		// fix file filename for query strings
		preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
		$file_array['name'] = basename($matches[0]);
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc=null );
		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}

		$fullsize_path = get_attached_file( $id ); // Full path
		if (function_exists('ewww_image_optimizer')) {
			ewww_image_optimizer($fullsize_path, $gallery_type = 4, $converted = false, $new = true, $fullsize = true);
		}
		$src = wp_get_attachment_url( $id );
	}
	if (!empty($src)){

		update_post_meta($post_id, 'image_url_value', $flickrurl);
		update_post_meta($post_id, 'image_author_t_value', $flickruser);
		update_post_meta($post_id, 'image_value', $src);
		set_post_thumbnail( $post_id, $id );
		return update_post_meta($post_id, 'Thumbnail', $src);
	}
else return false;
}

function getFlickrUser($photo_id) {
	//$content = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
	$ch = curl_init("https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$content = curl_exec($ch);
	curl_close($ch);
	$rsp = new SimpleXmlElement($content);
	$flickrusername = $rsp->photo->owner['path_alias'];
	if($flickrusername){
		return $flickrusername;}
	else{
		return '';
	}
}
function getFlickrURL($photo_id) {
	//$content = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
	$ch = curl_init("https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$content = curl_exec($ch);
	curl_close($ch);
	//$xml = simplexml_load_string($xml_raw)
	$rsp = new SimpleXmlElement($content);
	$number = count($rsp->sizes->size);
	for ($i=0; $i<$number; $i++){
		if($rsp->sizes->size[$i]['width'] == 1024)
			return $rsp->sizes->size[$i]['source'];
	}
}
function externimg_getext ($file) {
	if (function_exists('mime_content_type'))
	$mime = mime_content_type($file);
	else return '';
	switch($mime) {
		case 'image/jpg':
		case 'image/jpeg':
			return '.jpg';
			break;
		case 'image/gif':
			return '.gif';
			break;
		case 'image/png':
			return '.png';
			break;
	}
	return '';
}
?>