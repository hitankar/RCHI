<?php 
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>
<hr>
<?php if (have_posts()):?>
<div class="row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
</div>
<?php endif; ?>
