<?php

function admin_register_head() {
	
	global $post;
	$template_url = get_bloginfo('template_url');

	$screen = get_current_screen();

	if ( 'post' != $screen->base )
    return;
	
	//Incluye el CSS del Admin
	echo '<link rel="stylesheet" type="text/css" href="' . $template_url . '/assets/css/admin.css" />';
	
	//Retrieve which page template is selected
	$current_template = get_post_meta($post->ID,'_wp_page_template',true);
	
}

add_action('admin_head', 'admin_register_head');

add_action( 'admin_enqueue_scripts', 'gest_enqueue_scripts' );
function gest_enqueue_scripts()
{
    $screen = get_current_screen();
    if ( 'post' != $screen->base )
    return;
  
    wp_enqueue_script(
		'admin-js',
		get_template_directory_uri() . '/assets/js/admin.js',
		array('jquery')
	);
}

?>