<?php get_header(); ?>

<div class="wrapper front">

			<header>
									
				<?php $sticky = get_option( 'sticky_posts' ); $my_query = array("showposts" => 1, 'post__not_in' => get_option( 'sticky_posts' ) ); $my_query = new WP_Query($my_query); ?>
				<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID;?>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>	
				<div class="head_article lrg_title" style="background-image: url(<?php echo $url; ?>);">
					<div>
						<section>
							<article>
								<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="s_first"><?php the_category(); ?></span></h1><br />
								<h3><?php the_tags('',',',''); ?></h3>
								<h3>BY: <?php the_author_posts_link(); ?></h3>
								<h3><?php the_time('F j, Y'); ?></h3><br />
								<p>
									<?php the_excerpt(); ?>
								</p>

								<?php endwhile; else: ?>
									<p>There are no posts.</p>
								<?php endif ?>

							</article>
						</section>
					</div>
				</div>
				<?php $my_query = array("showposts" => 2, 'post__not_in' => array_merge($do_not_duplicate,$sticky)); $my_query = new WP_Query($my_query); ?>
				<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID;?>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<div class="head_article" style="background-image: url('<?php echo $url; ?>');">
					<div>
						<section>
							<article>
								<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span><?php the_category(); ?></span></h1><br />
								<h3><?php the_tags('',',',''); ?></h3>
								<h3>BY: <?php the_author_posts_link(); ?></h3>
								<h3><?php the_time('F j, Y'); ?></h3><br />
							</article>
						</section>
					</div>
				</div>

				<?php endwhile; else: ?>
					<p>There are no posts.</p>
				<?php endif ?>


				<div class="clr">
					<?php $my_query = array("showposts" => 2, 'post__not_in' => array_merge($do_not_duplicate,$sticky)); $my_query = new WP_Query($my_query); ?>
					<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID;?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<div class="head_article" style="background-image: url('<?php echo $url; ?>');">
						<div class="darken">
							<section>
								<article>
									<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span><?php the_category(); ?></span></h1><br />
									<h3><?php the_tags('',',',''); ?></h3>
									<h3>BY: <?php the_author_posts_link(); ?></h3>
									<h3><?php the_time('F j, Y'); ?></h3><br />
								</article>
							</section>
						</div>
					</div>

					<?php endwhile; else: ?>
						<p>There are no posts.</p>
					<?php endif ?>
				</div>
				<?php $my_query = array("showposts" => 1, 'post__not_in' => array_merge($do_not_duplicate,$sticky)); $my_query = new WP_Query($my_query); ?>
				<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID;?>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<div class="head_article lrg_title" style="background-image: url('<?php echo $url; ?>');">
					<div>
						<section>
							<article>
								<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span><?php the_category(); ?></span></h1><br />
								<h3><?php the_tags('',',',''); ?></h3>
								<h3>BY: <?php the_author_posts_link(); ?></h3>
								<h3><?php the_time('F j, Y'); ?></h3><br />
								<p>
									<?php the_excerpt(); ?>
								</p>
							</article>
						</section>
					</div>
				</div>

				<?php endwhile; else: ?>
					<p>There are no posts.</p>
				<?php endif ?>
				
			</header>
	
				
		</div><!-- End of Wrapper -->

		<article class="stream_bar">
			<div>
				<span>LIVE NOW</span>
				<?php $online_users = array(); $my_streams = array('post_type' => 'streams'); $my_streams = new WP_Query($my_streams); ?>
				<?php if ( $my_streams->have_posts() ) : while ( $my_streams->have_posts() ) : $my_streams->the_post(); ?>
					<?php $username = get_field('username'); ?>
					<?php array_push($online_users, $username); ?>
					

				<?php endwhile; ?>
					<?php $online_string = implode(",",$online_users);?>
					<?php 
					$mycurl = curl_init();

					curl_setopt ($mycurl, CURLOPT_HEADER, 0);
					curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);

					$apiurl = "http://api.justin.tv/api/stream/list.json?channel=" . $online_string; 
					curl_setopt ($mycurl, CURLOPT_URL, $apiurl);

					$web_response =  curl_exec($mycurl); 

					$results = json_decode($web_response); 
					foreach ($results as $s): ?>
						<a href="http://www.twitch.tv/<?php echo $s->channel->login; ?>"><?php echo $s->channel->login; ?></a>
					<?php endforeach; ?>
				<?php else: ?>
					 <p> No one. </p>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</div>
		</article>

		<div class="row">
			<div class="container" id="container">
				<div class="item_wrapper">

					<!-- Post Most Recent News & Posts -->
					<?php $sticky = get_option( 'sticky_posts' ); $stickyOne = array($sticky[0]); $posttypes = array('post','blog'); $my_query = array('post_type' => $posttypes,"showposts" => 9, 'post__not_in' => array_merge($do_not_duplicate,$stickyOne), 'orderby' => 'date'); $my_query = new WP_Query($my_query); ?>
					<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID; ?>
						<div class="item">
							<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
							<h2><a href="<?php the_permalink() ;?>"><?php the_title(); ?></a></h2>
							<h3><?php the_category(); ?><span class="game"><?php the_tags('',',',''); ?></span></h3>
							<a href="<?php the_permalink() ;?>"><?php $custom_field = get_post_meta($post->ID, 'article_image', true); ?>
  							<?php if(trim($custom_field) != '') { ?><img src="<?php the_field( 'article_image' ); ?>"><?php } ?><?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) the_post_thumbnail(); ?></a>
							<h3>By: <?php the_author_posts_link(); ?><span class="comment_box"><?php comments_number('0','1','%'); ?></span><span class="comment_tri"></span></h3>
							<h3><?php the_time('F j, Y'); ?></h3>
							<p>
								<?php the_excerpt(); ?>
							</p>
						</div>
					<?php endwhile; else: ?>
						<p>There are no posts.</p>
					<?php endif ?>

					
				</div>
			</div>
		</div>
		<!-- Post First Sticky Post -->
		<?php
		$sticky = get_option( 'sticky_posts' ); $my_query = array('posts_per_page' => 1,'post__in'  => $sticky,'ignore_sticky_posts' => 1); $my_query = new WP_Query($my_query);
		if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<div class="featured_article row" style="background-image: url(<?php echo $url; ?>);">
			<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'><span class="comment_box"><?php comments_number('0','1','%'); ?></span><span class="comment_tri"></span></span>
			<div class="container">
				<h1><a href="<?php the_permalink() ;?>"><?php the_title(); ?></a></h1>
				<span class="title_wrap">
					<h3><?php the_category(); ?><span class="game"><?php the_tags('',',',''); ?></h3>
					<h3>By: <?php the_author_posts_link(); ?></h3>
					<h3><?php the_time('F j, Y'); ?></h3>
				</span>
				<p>
					<?php the_excerpt(); ?>
				</p>
			</div>
		</div>
		<?php endwhile; else: ?>
			<!-- There were no posts to display, play sad music. -->
		<?php endif ?>


		<!-- Post Next Blog / News -->
		<?php $posttypes = array('post','blog'); $my_query = array('post_type' => $posttypes,"showposts" => 9, 'post__not_in' => array_merge($do_not_duplicate,$stickyOne)); $my_query = new WP_Query($my_query); ?>
		<?php if ( $my_query->have_posts() ) : ?>
		<div class="row">
			<div class="container" id="container2">
				<div class="item_wrapper">

					<?php while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate[] = $post->ID; ?>
						<div class="item">
							<span class="comment_bar" style='width:<?php $cnum = comments_number('0','1','%');$mul = 10;if ($cnum > 100) {echo 100;} elseif ($cnum > 0) {echo $cnum;} ?>%;'></span>
							<h2><a href="<?php the_permalink() ;?>"><?php the_title(); ?></a></h2>
							<h3><?php the_category(); ?><span class="game"><?php the_tags('',',',''); ?></span></h3>
							<a href="<?php the_permalink() ;?>"><?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) the_post_thumbnail(); ?></a>
							<h3>By: <?php the_author_posts_link(); ?><span class="comment_box"><?php comments_number('0','1','%'); ?></span><span class="comment_tri"></span></h3>
							<h3><?php the_time('F j, Y'); ?></h3>
							<p>
								<?php the_excerpt(); ?>
							</p>
						</div>
					<?php endwhile; ?>
					
	
				</div>
			</div>
		</div>
		<?php else: ?>
			<!-- There were no posts to display, play sad music. -->
		<?php endif ?>



<?php get_footer(); ?>