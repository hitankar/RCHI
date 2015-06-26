<?php
/**
 * Template Name: FrontPage
 *
 * @package Roots
 * @subpackage Sage
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <!-- Splash Page -->
  <div id="splash-page" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <section class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 dark-bg splash-text-top" style="background-color: <?php echo get_theme_mod( 'bg_color_setting'); ?>;"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_top', true ) ); ?></div>
            <div class="col-xs-12 col-sm-6 col-md-6 splash-text-left"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_left', true ) ); ?></div>
            <div class="col-xs-12 col-sm-6 col-md-6 splash-text-right"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_right', true ) ); ?></div>
          </section>
          
        </div>
        <div class="modal-footer aligncenter">
          <button type="button" class="close glyphicon glyphicon-remove-sign img-circle" data-dismiss="modal" aria-label="Close"></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Splash Page -->
<?php endwhile; ?>


