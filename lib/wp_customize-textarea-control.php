<?php
namespace Roots\Sage\WP_Customize_TextArea_Control;
/**
 * WP_Customize TextArea Control Class
 *
 * Since NARGA v0.5
 **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class WP_Customize_TextArea_Control extends WP_Customize_Control {
        public $type = 'textarea';
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'sage' ) );
            parent::__construct( $manager, $id, $args );
        }
 
        public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php

            $content = $this->value();
            $editor_id = $this->id;
            $settings = array( 'media_buttons' => true, 'drag_drop_upload'=>true );

            wp_editor( $content, $editor_id, $settings );

            ?>
        </label>
        <?php
        }
    }
 
}