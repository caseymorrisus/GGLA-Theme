<?php get_header(); ?>

<p>This is the page.php file</p>
<div class="wrapper">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
		<hr>

	<?php endwhile; else: ?>

		<p>There are no posts.</p>

	<?php endif ?>
</div>

<?php get_footer(); ?>