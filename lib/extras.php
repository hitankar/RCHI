<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Reduce Excerpt Length
 */
add_filter('excerpt_length', function() {
  return 30;
});


/**
 * ShortCode for call to action "Conversion button" 
 * Example: [conversion_button textbox_placeholder="Optional text" button_text="Optionaal Button Text"]
 **/
add_shortcode( 'conversion_button', function( $atts ) {
  $a = shortcode_atts( array(
        'textbox_placeholder' => 'Enter Zipcode',
        'button_text' => 'Click Me',
    ), $atts );
  $random = floor(rand(1,100));
  return <<<HTML
<form id="conversion_form_{$random}" name="zipform" method="get" class="form-inline conversion_form" action="/health/cafe">
  <div class="cform-group">
    <label class="sr-only" for="conversion-zipcode">{$a['textbox_placeholder']}</label>
    <input type="text" name="conversion_zipcode" id="conversion-zipcode" value="" placeholder="{$a['textbox_placeholder']}" class="form-control" />
    <input type="hidden" name="curl" value="reallycheaphealthinsurance.com" />
    <input type="hidden" name="from" value="reallycheaphealthinsurance" />
    <input type="hidden" name="sid" value="TE-H-A-BSI-1" />
    <input type="hidden" name="c2" value="" />
    <input type="hidden" name="c3" value="" />
    <input type="hidden" name="psv" value="1" />
    <input type="hidden" name="type" value="health" />
  </div>
  <button type="submit" name="conversion_button" id="conversion-button" class="btn btn-default" >{$a['button_text']}</button>
</form>
HTML;
} );

/**
 * Shortcode for replacing shortcode to actual HTML tags
 **/
add_shortcode( 'section', function( $atts, $content ) {
  $a = shortcode_atts( array(
        'css_class' => 'basic',
    ), $atts );
  $content = do_shortcode($content);
  return <<<HTML
<section class="page-section {$a['css_class']}" >
  $content
</section>
HTML;
} );

/**
 * Steps shortcode
 * Exmaple [steps class=""][/steps]
 **/
add_shortcode( 'steps', function( $atts, $content ) {
  $a = shortcode_atts( array(
      'css_basic' => '',
    ), $atts );
  $content = do_shortcode($content);
  return <<<HTML
<div class="steps {$a['css_basic']}" >
{$content}
</div>
HTML;
});

/**
 * Steps shortcode
 * Exmaple [step step-number="1" image-file="http://example.com/image.png" caption="This is a step" /]
 **/
add_shortcode( 'step', function( $atts ) {
  $a = shortcode_atts( array(
      'step_number' => '1',
      'image_file'  => '',
      'caption'     => '',
    ), $atts );
  return <<<HTML
<div class="step-container ">
  <div class="step-number img-circle">{$a['step_number']}</div>
  <img src="{$a['image_file']}" class="img-circle step-img" width="180" height="180" />
  <span class="step-caption">{$a['caption']}</span>
</div>
HTML;
});