<footer class="content-info" role="contentinfo">
  <div class="container">
    <!-- Floating Bar -->
    <div class="alert floating-bar alert-dismissible" style="display: none;">
        <button type="button" class="close glyphicon glyphicon-remove-sign" data-dismiss="alert" aria-label="Close"></button>
        <div class="content">
            <?php echo do_shortcode( get_theme_mod( 'floating_text_setting' ) ); ?>
        </div>
    </div>
    <!-- End Floating Bar -->
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="row">
    	<div class="col-md-9">
	    <?php
	    if (has_nav_menu('footer_navigation')) :
	      wp_nav_menu(
            ['theme_location' => 'footer_navigation', 
            'menu_class' => 'nav nav-pills dark-bg',
            ]);
	    endif;
	    ?>
	    <div classs="copyright">Copyright &copy; <?php echo date("Y")?> <?php echo get_bloginfo('name') ?>. All Rights Reserved. </div>
    	</div>
    	<div class="col-md-3">
    	<!-- social media icons -->
        <a href="#"><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/facebook.png " width="39" height="38"></a>&nbsp;
        <a href="#"><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/tumblr.png " width="39" height="38"></a>&nbsp;
        <a href="#"><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/twitter.png " width="39" height="38"></a>&nbsp;
    	</div>
    </div>
  </div>
</footer>       