<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/image.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/file.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/media.php');
$year = ( isset($_POST['year']) && (int)$_POST['year'] ) ? esc_sql( $_POST['year'] ) : false;
$month = ( isset($_POST['month']) && (int)$_POST['month'] ) ? esc_sql( $_POST['month'] ) : false;
if(isset($_POST['submitted']) && $year){
  if($month){
    $args = array (
      'post_type'              => 'post',
      'post_status'            => 'publish',
      'posts_per_page'         => -1,
      'nopaging' => true,
      //'offset'               => 0,
      'order' => 'ASC',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => '_thumbnail_id',
          'value' => null,
          'compare' => 'NOT EXISTS'
        ),
        array(
          'key' => 'image_value',
          'compare' => 'EXISTS'
        ),
      ),
      'date_query' => array(
        array(
          'year'  => $year,
          'month' => $month,
        ),
      ),
    );
  }else {
    $args = array (
      'post_type'              => 'post',
      'post_status'            => 'publish',
      'posts_per_page'         => -1,
      'nopaging' => true,
      //'offset'               => 0,
      'order' => 'ASC',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => '_thumbnail_id',
          'value' => null,
          'compare' => 'NOT EXISTS'
        ),
        array(
          'key' => 'image_value',
          'compare' => 'EXISTS'
        ),
      ),
      'date_query' => array(
        array(
          'year'  => $year,
        ),
      ),
    );
  }
  $query = new WP_Query($args);
  if( $query->have_posts() ) { 
    $count = 0;
    echo '<h1>Listado de imágenes readjuntadas</h1><ol>';
    while ($query->have_posts()) : $query->the_post();
      $thumbid = get_post_meta( $post->ID, '_thumbnail_id', true );
      $imageurl = get_post_meta( $post->ID, 'image_value', true );
      // check if the custom field has a value
      if(empty($thumbid) && !empty($imageurl)) {
        //Utilizar función de media_sideload_image_1
        $result = media_sideload_image_1( $imageurl, $post->ID );
        if (!is_wp_error( $result )) {
          $count++;
          echo '<li>'.$result.'<li>';
        }
        sleep(1);
      } 
    endwhile;
    echo '</ol>';
    echo '<strong>'.$count.' imágenes reasinadas como principales</strong>';
  }
}

function media_sideload_image_1( $file, $post_id, $desc = null, $return = 'html' ) {
  if ( ! empty( $file ) ) {
    // Set variables for storage, fix file filename for query strings.
    preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
    $file_array = array();
    $file_array['name'] = basename( $matches[0] );

    // Download file to temp location.
    $file_array['tmp_name'] = download_url( $file );

    // If error storing temporarily, return the error.
    if ( is_wp_error( $file_array['tmp_name'] ) ) {
      return $file_array['tmp_name'];
    }

    // Do the validation and storage stuff.
    $id = media_handle_sideload( $file_array, $post_id, $desc );

    // If error storing permanently, unlink.
    if ( is_wp_error( $id ) ) {
      @unlink( $file_array['tmp_name'] );
      return $id;
    }
    /*$fullsize_path = get_attached_file( $id ); // Full path
    if (function_exists('ewww_image_optimizer')) {
      ewww_image_optimizer($fullsize_path, $gallery_type = 4, $converted = false, $new = true, $fullsize = true);
    }*/
    $src = wp_get_attachment_url( $id );
  }

 if ( ! empty( $src ) ) {
    //update_post_meta($post_id, 'image_value', $src);
    set_post_thumbnail( $post_id, $id );
    //update_post_meta($post_id, 'Thumbnail', $src);
    return get_post_meta( $post_id, 'image_value', true );
  } else {
    return new WP_Error( 'image_sideload_failed' );
  }
}
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <form role="form" id="signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" class="form-control" placeholder="Año" id="year" name="year" autocomplete="off" pattern="[0-9]{4}" title="Ingresa el año. Ej. 2015" required>
    <input type="text" class="form-control" placeholder="Mes" id="month" name="month" autocomplete="off" title="Ingresa el mes. Ej. 6">
    <input type="hidden" name="submitted" id="submitted" value="true" />
    <button type="submit" class="btn btn-info btn-lg">Enviar</button>
  </form>
</body>
</html>