<?php
namespace Roots\Sage\CodeBox;
/**
 * CodeBox abstract class for creating editable sections in a template specific post/page
 **/
abstract class CodeBox
{
  /**
   * self initating class: singleton
   **/
  public static function init()
  {
      static $instance = null;
      if (null === $instance) {
          $instance = new static();
      }

      return $instance;
  }

  /**
   * Register abstract method for the actual setup of the CodeBox to wordpress.
   */
  abstract public function register();

  /**
   * Run off the mill validation for save_post action
   */
  public function save( $post_id ) {

    if ( ! isset( $_POST['rchi_new_nonce'] ) ) {
        return;
    }

    if ( !wp_verify_nonce( $_POST['rchi_new_nonce'], 'frontpage_codebox' ) ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if ( wp_is_post_revision( $post_id ) ) {
        $post_id = wp_is_post_revision($post_id);
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
      }

    } else {

      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
      }
    } 

  }

}