<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/image.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/file.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/media.php');

$type_edit = ( isset($_POST['type']) && (string)$_POST['type'] ) ? $_POST['type'] : false;
$post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
if($type_edit && $post_ID){
  switch ($type_edit) {
    case 'slugedit':
      $new_Slug = ( isset($_POST['newslug']) && (string)$_POST['newslug'] ) ? $_POST['newslug'] : false;
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
      $flickrurl = ( isset($_POST['flickrurl']) && (string)$_POST['flickrurl'] ) ? $_POST['flickrurl'] : false;
      if($flickrurl){
        flickr_image_attach ($flickrurl, $post_ID);

      }
      break;
    case 'imageupload':
      $file = ( !empty($_FILES['img_file'])) ? $_FILES['img_file'] : false;
      if($file){
        $arch = pathinfo($file['name']);
        $extension = $arch['extension'];
        if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG'){
          $id = media_handle_sideload( $file, $post_ID, $desc=null );
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
            update_post_meta($post_ID, 'image_value', $src);
            set_post_thumbnail( $post_ID, $id );
            return update_post_meta($post_ID, 'Thumbnail', $src);
          }
        }
      }
      break;  
    case 'deletepost':
      wp_delete_post($post_ID);
      wp_redirect( home_url('/') ); exit;
      break;
    case 'imagemargin':
      $immargin = ( isset($_POST['immargin']) && (int)$_POST['immargin'] ) ? $_POST['immargin'] : false;
      if($immargin){
        update_post_meta($post_ID, 'image_margin_top', $immargin);
      }
      break;
    case 'deleteimage':
      $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
      wp_delete_attachment( $post_thumbnail_id, true );
      delete_post_meta($post_ID, 'image_url_value');
      delete_post_meta($post_ID, 'image_author_t_value');
      delete_post_meta($post_ID, 'image_value');
      delete_post_thumbnail( $post_ID );
      delete_post_meta($post_ID, 'Thumbnail');
      delete_post_meta($post_ID, 'image_margin_top');
      break;
    case 'deletepdf':
      $attachment_id = get_post_meta($post_ID, "all2html_id", true);
      $pdf_path = get_post_meta($post_ID, "all2html_path", true);
      wp_delete_attachment( $attachment_id, true );
      if(get_post_meta($post_ID, "all2html_id_pdf", true) != ''){
        $attachment_id_pdf = get_post_meta($post_ID, "all2html_id_pdf", true);
        wp_delete_attachment( $attachment_id_pdf, true );
      }
      delTree($pdf_path);
      delete_post_meta($post_ID, 'all2html_docu');
      delete_post_meta($post_ID, 'all2html_pdf');
      delete_post_meta($post_ID, 'all2html_id');
      delete_post_meta($post_ID, 'all2html_id_pdf');
      delete_post_meta($post_ID, 'all2html_ext');
      delete_post_meta($post_ID, 'all2html_path');
      delete_post_meta($post_ID, 'all2html_php');
      delete_post_meta($post_ID, 'all2html_html');
      delete_post_meta($post_ID, 'all2html_css');
      delete_post_meta($post_ID, 'all2html_fullhtml');
      delete_post_meta($post_ID, 'all2html_excerpt');
      delete_post_meta($post_ID, 'output_convpdf');
      delete_post_meta($post_ID, 'output_copiar');
      delete_post_meta($post_ID, 'output_pdf2html');
      delete_post_meta($post_ID, 'output_php');
      delete_post_meta($post_ID, 'output_full');
      delete_post_meta($post_ID, 'all2html_ok');
      delete_post_meta($post_ID, 'all2html_upf');
      delete_post_meta($post_ID, 'all2html_arch');
      delete_post_meta($post_ID, 'all2html_pdfpath');
      delete_post_meta($post_ID, 'all2html_pdfoptpath');
      delete_post_meta($post_ID, 'output_optpdf');
      delete_post_meta($post_ID, 'all2html_htmlcontent');
      delete_post_meta($post_ID, 'all2html_hash');
      delete_post_meta($post_ID, 'all2html_zip');
      delete_post_meta($post_ID, 'all2html_outzip');
      delete_post_meta($post_ID, 'all2html_postID');
    break;        
  }
  if ( function_exists('w3tc_pgcache_flush_post') ) {
    w3tc_pgcache_flush_post( $post_ID );
  }
}else{
  echo 'No deber&iacute;as estar aqu&iacute;';
}
function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  }
?>