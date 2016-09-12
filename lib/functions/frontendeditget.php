<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/image.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/file.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/media.php');

$type_edit = ( isset($_REQUEST['type']) && (string)$_REQUEST['type'] ) ? $_REQUEST['type'] : false;
//$post_ID = ( isset($_REQUEST['postid']) && (int)$_REQUEST['postid'] ) ? $_REQUEST['postid'] : false;
if($type_edit/* && $post_ID*/){
	switch ($type_edit) {
		case 'slugedit':
			$new_Slug = ( isset($_REQUEST['newslug']) && (string)$_REQUEST['newslug'] ) ? $_REQUEST['newslug'] : false;
			if($new_Slug){
				$new_Slug = sanitize_title($new_Slug);
				$post = array();
				$post['ID'] = $post_ID;
				$post['post_name'] = $new_Slug;
				wp_update_post( $post );
				wp_redirect( get_permalink( $post_ID ) ); exit;
			}
			break;
		
		case 'imageedit':
			global $wpdb;
			$recs = $wpdb->get_results($wpdb->prepare("SELECT post_id, meta_value FROM {$wpdb->prefix}postmeta WHERE meta_key = %s", 'image_url_value'));
			$i = 1;
			$total = count($recs);
			foreach($recs as $rec){
				flickr_image_attach ($rec->meta_value, $rec->post_id);
				usleep(250000);
				if($i == $total) echo 'Terminado: ' . $i . ' columnas modificadas.';
				$i++;
			}
			break;
	}
}else{
	echo 'No deber&iacute;as estar aqu&iacute;';
}

//Funciones para migrar imagen de Flickr a WordPress
function flickr_image_attach ($flickrurl, $post_id){
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
	$content = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
	$rsp = new SimpleXmlElement($content);
	$flickrusername = $rsp->photo->owner['path_alias'];
	if($flickrusername){
		return $flickrusername;}
	else{
		return '';
	}
}
function getFlickrURL($photo_id) {
	$content = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=ffdc73baf6e955d9048ecc77ebd6b2c7&photo_id=".$photo_id);
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