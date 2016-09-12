<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'Gestiopolis/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');

$post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
if($post_ID){
	$titulo=array_values(array_filter($_POST['exlinks_t']));
	$exlink=array_values(array_filter($_POST['exlinks_u']));
	//$clase=array_values(array_filter($_POST['exlinks_c']));
	$exlinks = array();
	for ($i=0; $i<count($titulo); $i++){
	   $exlinks[] = array("titulo" => $titulo[$i],"exlink" => $exlink[$i]/*,"clase" => $clase[$i]*/);
	}
	$data = ($exlinks == array()) ? "" : serialize($exlinks);

	if(get_post_meta($post_ID, 'exlinks_value') == "")
		add_post_meta($post_ID, 'exlinks_value', $data, true);
		
	elseif($data != get_post_meta($post_ID, 'exlinks_value', true))
		update_post_meta($post_ID, 'exlinks_value', $data);
		
	elseif($data == "")
		delete_post_meta($post_ID, 'exlinks_value', get_post_meta($post_ID, 'exlinks_value', true));
	
	if ( function_exists('w3tc_pgcache_flush_post') ) {
		w3tc_pgcache_flush_post( $post_ID );
	}
	wp_redirect( get_permalink( $post_ID ).'#exlink' ); exit;
}else{
	echo 'No deber&iacute;as estar aqu&iacute;';
}
?>