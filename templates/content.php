<article <?php post_class("col-xs-6 col-sm-6 col-md-4 col-lg-4"); ?>>
  <header>
    <h2 class=" h4 entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
