<?php
namespace Roots\Sage\ThemeCustomizer;

/**
* Customization Options for the themem
*/
class ThemeCustomizer
{
	
	function __construct()
	{
        add_action( 'customize_register', array($this, 'customize_manager' ));
	}

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
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }


    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager( $wp_manager )
    {
        $this->section( $wp_manager );
    }

    public function section( $wp_manager )
    {
        $wp_manager->add_section( 'customizer_section', array(
            'title'          => 'Additional Settings',
            'priority'       => 35,
        ) );

        // Background Color Setting
        $wp_manager->add_setting( 'bg_color_setting', array(
            'default'        => '#000000',
        ) );

        $wp_manager->add_control( new \WP_Customize_Color_Control( $wp_manager, 'bg_color_setting', array(
            'label'   => 'Splash Page Background Color',
            'section' => 'customizer_section',
            'settings'   => 'bg_color_setting',
            'priority' => 1
        ) ) );

        // Health Header Banner Image Setting
        $wp_manager->add_setting( 'hb_image_setting', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new \WP_Customize_Image_Control( $wp_manager, 'hb_image_setting', array(
            'label'   => 'Header Banner Image (minimum/maximum width: 1170px)',
            'section' => 'customizer_section',
            'settings'   => 'hb_image_setting',
            'priority' => 2
        ) ) );

        // Car Header Banner Image Setting
        $wp_manager->add_setting( 'cb_image_setting', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new \WP_Customize_Image_Control( $wp_manager, 'cb_image_setting', array(
            'label'   => 'Car Header Banner Image (minimum/maximum width: 1170px)',
            'section' => 'customizer_section',
            'settings'   => 'cb_image_setting',
            'priority' => 3
        ) ) );

        // Car Header Banner Image Setting
        $wp_manager->add_setting( 'floating_text_setting', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new \WP_Customize_Control( $wp_manager, 'floating_text_setting', array(
            'label'   => 'Floating Box Content',
            'section' => 'customizer_section',
            'settings'   => 'floating_text_setting',
            'type'      => 'textarea',
            'priority' => 4
        ) ) );

    }
}

//Instantiate the class
ThemeCustomizer::init();