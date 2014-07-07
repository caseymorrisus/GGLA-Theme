<?php 

/*
	
	Template Name: Blog Page

*/

get_header(); ?>

<div class="wrapper ">
	<div class="row">
		<div class="container" id="container">
			<div class="item_wrapper">
			<?php if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }
				$args = array( 'numberposts' => '','post_type' => 'blog', 'posts_per_page' => 5, 'paged' => $paged );
				$wp_query = new WP_Query($args);
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<div class="item">
						<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
						<h2><a href="<?php the_permalink() ;?>"><?php the_title(); ?></a></h2>
						<h3><?php the_category(); ?><span class="game"><?php the_tags('',',',''); ?></span></h3>
						<a href="<?php the_permalink() ;?>"><img src="<?php the_field( 'article_image' ); ?>"></a>
						<h3>By: <?php the_author_posts_link(); ?><span class="comment_box"><a class="commentsLink" href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span><span class="comment_tri"></span></h3>
						<h3><?php the_time('F j, Y'); ?></h3>
						<p>
							<?php the_excerpt(); ?>
							
						</p>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="next-prev-wrap container">

		<span class="next"><?php next_posts_link( '&larr; Older posts', $the_query->max_num_pages ); ?></span>
		<span class="prev"><?php previous_posts_link( 'Newer posts &rarr;', $the_query->max_num_pages ); ?></span>

		</div>
	</div>
</div>


	
</div>

<?php get_footer(); ?>