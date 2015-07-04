<article <?php post_class("col-sm-6 col-md-4 col-lg-4"); ?>>
<?php if ( has_post_thumbnail() ) {
	the_post_thumbnail( array(300,150), ['class' => 'img-responsive post-featured-image']);
} ?>
  <header>
    <h2 class=" h4 entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
