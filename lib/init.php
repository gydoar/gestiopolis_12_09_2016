<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/roots-translations
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots')
  ));

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 120, 120, true );
  add_image_size( 'sidebar-thumb', 304, 171, true );
  add_image_size( 'search-thumb', 226, 120, true );
  add_image_size( 'featured-img', 1024, 400, true );
  add_image_size( 'dest-img', 742, 250, true );
  add_image_size( 'main-thumb', 742, 556, true );

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'search-form'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');

  //Añadir nuevo rol para los colaboradores
  add_role('colaborador_ges', 'Colaborador GestioPolis', array('read' => true,'edit_posts' => true,'delete_posts' => false,'upload_files' => true,));

  //Añadir nuevo rol para los editores de gestiopolis
  add_role('editor_ges', 'Editor GestioPolis', array('read' => false,'edit_posts' => false,'delete_posts' => false,'upload_files' => false,));

  //Disable the Admin Bar.
  add_filter( 'show_admin_bar', '__return_false' );

  //Remove the Admin Bar preference in user profile
  remove_action( 'personal_options', '_admin_bar_preferences' );

}
add_action('after_setup_theme', 'roots_setup');


/**
 * Register sidebars
 */
function roots_widgets_init() {
  register_sidebar(array(
    'name'          => __('Primary', 'roots'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'roots'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'roots_widgets_init');
