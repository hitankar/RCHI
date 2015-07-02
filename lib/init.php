<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer_navigation'  => __('Footer Navigation', 'sage'),
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 300, 150, true );

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget col-xs-6 col-sm-6 col-md-4 col-lg-4 %1$s %2$s"><div class="widget-content">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3 class="h4">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget col-xs-6 col-sm-6 col-md-4 col-lg-4 %1$s %2$s"><div class="widget-content">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3 class="h4">',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/** Custom Rewrite Rule **/
// add_action('init', function() {
//   add_rewrite_rule('health/(.*)?$', 'http://www.guidetoaffordableinsurance.com/health/$1', 'top');
// });

add_action('init', function() {

  $fileName = ".htaccess";
  $wordpressPath = get_home_path();
  $structure = "{$wordpressPath}health/";
  $file = "{$structure}{$fileName}";

  if ( file_exists ( $file ) )
    return false;

  if (!mkdir($structure, 0777, true)) {

      die('Failed to create folders. Please create /health/ at the root of your Wordpress installation');

  } else {

    $htaccessFile = fopen($file, "w") or die('Unable to create .htaccess file.');
    $txt = <<<TEXT
  <IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteRule ^(.*)$ http://www.guidetoaffordableinsurance.com/health/$1 [P,L]
  </IfModule>
TEXT;
    fwrite($htaccessFile, $txt);
    fclose($htaccessFile);
  }

});


/** Custom shortcode for customizable sections through the editor **/
add_action('init', function() {

    call_user_func(__NAMESPACE__ . '\\rchi_mce_editor_buttons', 'rchi_section_button', 'rchi_section_button.js');
    
});

/** Custom shortcode for customizable steps through the editor **/
add_action('init', function() {

    call_user_func(__NAMESPACE__ . '\\rchi_mce_editor_buttons', 'rchi_steps_button', 'rchi_steps_button.js');
});

/** Generic function to setup custom mceEditor Buttons **/
function rchi_mce_editor_buttons($rchi_mceEditor_buttons_id, $js_file) {

      // Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      // Add a callback to regiser our tinymce plugin   
      add_filter("mce_external_plugins", function($plugin_array) use ($rchi_mceEditor_buttons_id, $js_file)  {
        $plugin_array[$rchi_mceEditor_buttons_id] = get_template_directory_uri() . "/dist/scripts/{$js_file}";
        return $plugin_array;
      }); 

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', function($buttons) use ($rchi_mceEditor_buttons_id) {
        // Add the button ID to the $button array
        $buttons[] = $rchi_mceEditor_buttons_id;
        return $buttons;
      });
}


// Removing autoparagraph
remove_filter('the_content','wpautop');

//decide when you want to apply the auto paragraph

add_filter('the_content',function ($content) {
  if(get_post_type()=='page') //if it does not work, you may want to pass the current post object to get_post_type
    return $content;//no autop
  else
    return wpautop($content);
});



function get_home_path() {
  $home    = set_url_scheme( get_option( 'home' ), 'http' );
  $siteurl = set_url_scheme( get_option( 'siteurl' ), 'http' );
  if ( ! empty( $home ) && 0 !== strcasecmp( $home, $siteurl ) ) {
    $wp_path_rel_to_home = str_ireplace( $home, '', $siteurl ); /* $siteurl - $home */
    $pos = strripos( str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] ), trailingslashit( $wp_path_rel_to_home ) );
    $home_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
    $home_path = trailingslashit( $home_path );
  } else {
    $home_path = ABSPATH;
  }

  return str_replace( '\\', '/', $home_path );
}