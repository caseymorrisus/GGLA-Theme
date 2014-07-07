<?php 
/*
	
	Template Name: Roster Page

*/

get_header(); ?>


<div class="page_wrapper">

	<div class="container player">
		<?php
		$args = array( 'numberposts' => '','post_type' => 'player' );
		$wp_query = new WP_Query($args);
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<h1><?php the_field( 'first_name' ); ?> <em>"<?php the_field( 'username' ); ?>"</em> <?php the_field( 'last_name' ); ?> </h1>
			<section class="player_wrap">
				<div>
					<div>
					<a href="<?php the_field( 'player_twitch' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitch.png"></a>
					<a href="<?php the_field( 'player_twitter' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"></a>
					<a href="<?php the_field( 'player_facebook' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png"></a>
					</div>
				</div>
				<figure style="background-image: url(<?php the_field('player_image') ?>);">
					<!-- PLAYER IMAGE -->
				</figure>
				<article>
					<div>
						<h3>HOMETOWN <span><?php the_field( 'player_hometown' ); ?></span></h3>
						<h3>AGE <span><?php the_field( 'player_age' ); ?></span></h3>
						<h3>POSITION <span><?php the_field( 'player_role' ); ?></span></h3><br />
						<h3>FAVORITE FOOD <span><?php the_field( 'player_favorite_food' ); ?></span></h3>
						<h3>HOBBIES <span><?php the_field( 'player_hobbies' ); ?></span></h3><br />
						<h3>BIO <span></span></h3><br />
						<p>
						<?php the_field( 'player_bio' ); ?>
						</p>
					</div>
				</article>
			</section>

		<?php endwhile; ?>

		
		
		
	</div>

</div><!-- End of Wrapper -->


<?php get_footer(); ?>
