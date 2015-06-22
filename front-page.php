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
            <div class="col-md-12 dark-bg" style="background-color: <?php echo get_theme_mod( 'bg_color_setting'); ?>;"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_top', true ) ); ?></div>
            <div class="col-md-6"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_left', true ) ); ?></div>
            <div class="col-md-6"><?php echo do_shortcode( get_post_meta( get_the_ID(), '_splashpage_text_right', true ) ); ?></div>
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


