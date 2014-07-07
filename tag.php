<?php get_header(); ?>

<!-- This is the tag file -->
<div class="wrapper ">
	<div class="row">
		<div class="container" id="container">
			<div class="item_wrapper">

				<?php $page_title = wp_title('', false); $page_tag = str_replace(' ', '-', $page_title); $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged, 'tag' => $page_tag );
				$wp_query = new WP_Query($args);
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				
					<div class="item">
						<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
						<h2><a href="<?php the_permalink() ;?>"><?php the_title(); ?></a></h2>
						<h3><?php the_category(); ?><span class="game"><?php the_tags('',',',''); ?></span></h3>
						<a href="<?php the_permalink() ;?>"><?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) the_post_thumbnail(); ?></a>
						<h3>By: <?php the_author_posts_link(); ?><span class="comment_box"><a class="commentsLink" href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span><span class="comment_tri"></span></h3>
						<h3><?php the_time('F j, Y'); ?></h3>
						<p>
							<?php the_excerpt(); ?>
						</p>
					</div>
				
				<?php endwhile;?>
			</div>
		</div>
		<div class="next-prev-wrap container">

		<span class="next"><?php next_posts_link( '&larr; Older posts', $the_query->max_num_pages ); ?></span>
		<span class="prev"><?php previous_posts_link( 'Newer posts &rarr;', $the_query->max_num_pages ); ?></span>

		</div>
	</div>

</div>


<?php get_footer(); ?>