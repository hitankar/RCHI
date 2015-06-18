<?php
namespace Roots\Sage\FrontPageCodeBox;
use Roots\Sage\TemplateMetaBox;
use Roots\Sage\CodeBox;

/**
* Implement CodeBox class for the post/page that uses front-page.php template file.
*/
class FrontPageCodeBox extends CodeBox\CodeBox
{

  public function __construct()
  {
    add_action( 'add_meta_boxes_page',  array( $this, 'register' ) );
    add_action( 'save_post',  array( $this, 'save' ) );
  }
  
  /**
   * Inintite TemplateMetaBox class and setup the metaboxes to be shown in the admin page
   **/
  public function register()
  {
    global $post;
  
    $setup = new TemplateMetaBox\TemplateMetaBox($post);

    // top section
    $setup->add_meta_box(
      'splash-page-text-top',
      'Splash Page Text Top',
      function($post) {
        // Add a nonce field so we can check for it later.
        wp_nonce_field( 'frontpage_codebox', 'rchi_new_nonce' );

        $value = get_post_meta( $post->ID, '_splashpage_text_top', true );

        echo '<label for="splashpage-text-top">';
        _e( 'Custom content for the splashpage top section', 'myplugin_textdomain' );
        echo '</label><br /> ';
        wp_editor( $value , 'splashpage-text-top', array(
          'textarea_name' =>'splashpage-text-top',
          'wpautop'       => false,
          ) );
      },
      'page', 'advanced', 'core'
    );

    // left text
    $setup->add_meta_box(
      'splash-page-text-left',
      'Splash Page Text Left',
      function($post) {
        // Add a nonce field so we can check for it later.
        wp_nonce_field( 'frontpage_codebox', 'rchi_new_nonce' );

        $value = get_post_meta( $post->ID, '_splashpage_text_left', true );

        echo '<label for="splashpage-text-left">';
        _e( 'Custom content for the splashpage left section', 'myplugin_textdomain' );
        echo '</label><br /> ';
        wp_editor( $value , 'splashpage-text-left', array(
          'textarea_name' =>'splashpage-text-left',
          'wpautop'       => false,
          ) );
      },
      'page', 'advanced', 'core'
    );

    //Right text
    $setup->add_meta_box(
      'splash-page-text-right',
      'Splash Page Text Right',
      function($post) {
        // Add a nonce field so we can check for it later.
        wp_nonce_field( 'frontpage_codebox', 'rchi_new_nonce' );

        $value = get_post_meta( $post->ID, '_splashpage_text_right', true );

        echo '<label for="splashpage-text-right">';
        _e( 'Custom content for the splashpage right section', 'myplugin_textdomain' );
        echo '</label><br /> ';
        wp_editor( $value , 'splashpage-text-right', array(
          'textarea_name' =>'splashpage-text-right',
          'wpautop'       => false,
          ) );
      },
      'page', 'advanced', 'core'
    );

    $setup->init('front-page.php');
  }

  /** 
   * Save post handler
   */
  function save($post_id) {
    
    parent::save($post_id);
    
    if ( ! isset( $_POST['splashpage-text-top'] ) ) {
      return;
    }
    if ( ! isset( $_POST['splashpage-text-left'] ) ) {
      return;
    }
    if ( ! isset( $_POST['splashpage-text-right'] ) ) {
      return;
    }
    // add more if needed

    update_post_meta( $post_id, '_splashpage_text_top', $_POST['splashpage-text-top'] );
    update_post_meta( $post_id, '_splashpage_text_left', $_POST['splashpage-text-left'] );
    update_post_meta( $post_id, '_splashpage_text_right', $_POST['splashpage-text-right'] );
  }
}

//Initiate the class
FrontPageCodeBox::init();