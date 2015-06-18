<header class="banner navbar-fixed-top" role="banner">
  <div class="container">
    
    <nav class="navbar navbar-rchi" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
          <?php bloginfo('name'); ?>
          <small><?php bloginfo('description'); ?></small>
        </a>
      </div>
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav navbar-right']);
        endif;
        ?>
      </div>
    </nav>
  </div>
</header>
