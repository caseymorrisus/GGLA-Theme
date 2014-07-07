<?php get_header(); ?>


	<div class="page_wrapper">

		<div class="container row nextprev">
			<div class="previous"><?php previous_post_link(); ?></div>
			<div class="next"><?php next_post_link(); ?></div>
		</div>


		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID;?>
			<div class="title">
				<div class="container">
					<div>
						<h1><?php the_title(); ?></h1>
						<p>
							<?php the_tags('',',',''); ?> <br />
							By: <?php the_author_posts_link(); ?><br />
							<?php the_time('F j, Y'); ?> <br />
					</div>
						<img src="<?php the_field( 'article_image' ); ?>">
					</p>
				</div>
			</div>

			<div class="row article">
				<div class="container">

					<div class="col span_two_thirds follow">
						<div class="content_title">
							<p>
								Be up to date on eSports. Follow <a href="http://www.twitch.tv/gglatv">GGLA</a> now!
							</p>
							<p>

								<a href="https://www.facebook.com/GoldGamingLosAngeles"><img src="<?php bloginfo('template_directory');?>/images/facebook_orig.png"></a>
								<a href="https://twitter.com/goldgamingLA"><img src="<?php bloginfo('template_directory');?>/images/twitter_orig.png"></a>
								<a href="http://www.youtube.com/user/goldgamingla"><img src="<?php bloginfo('template_directory');?>/images/youtube.png"></a>
								<a href="https://plus.google.com/105651646126170603226/posts"><img src="<?php bloginfo('template_directory');?>/images/google+.png"></a>
								<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory');?>/images/rss.png"></a>
							
							</p>
						</div>

						<div class="content">
							
							<?php the_content(); ?>
													
							<?php comments_template(); ?>

						</div>

						

					</div>

					<div class="sidebar col span_one_third">

						<div class="sidebar_title">
							<p>
								STORYSTREAM &#x25BC;
							</p>
						</div>

						<?php
							$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => $do_not_duplicate ) );
							if( $related ) foreach( $related as $post ) {
							setup_postdata($post); 
								 $do_not_duplicate[] = $post->ID; ?>


								<div class="sidebar_div">
									<p>
										<em><?php the_time('M j, Y'); ?></em>
										<?php the_category(', '); ?>
									</p>
									<p>	
										<em><a class="altc" rel="external" href="<?php the_permalink();?>"><?php the_title(); ?></a></em>
										BY <?php the_author_posts_link(); ?>
									</p>		
								</div>



								<?php }
							wp_reset_postdata(); ?>

							
							

						
						
						<!-- End of News Article List -->

						
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

							$results = json_decode($web_response); ?>
							<?php if($results) : ?>
								<div class="sidebar_title">
								<p>
									LIVESTREAMS &#x25BC;
								</p>
							</div>
							<?php endif; ?>
							<?php foreach ($results as $s): ?>

								<div class="sidebar_div stream">
									<p>
										<?php echo $s->meta_game ?>
									</p>
									<p>	
										<a href="http://www.twitch.tv/<?php echo $s->channel->login; ?>"><?php echo $s->channel->login; ?></a>
										<?php echo $s->channel_count . ' VIEWERS'?>
									</p>		
								</div>

							<?php endforeach; ?>
						<?php else: ?>
							No one. 
						<?php endif; ?>
						<?php wp_reset_query(); ?>

						
						<!-- End of Livestreams List -->

						<div class="sidebar_title">
							<p>
								OTHER NEWS &#x25BC;
							</p>
						</div>

						<?php
							$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => $do_not_duplicate,  ) );
							if( $related ) foreach( $related as $post ) {
							setup_postdata($post); 
								 $do_not_duplicate[] = $post->ID; ?>


								<div class="sidebar_div">
									<p>
										<em><?php the_time('M j, Y'); ?></em>
										<?php the_category(', '); ?>
									</p>
									<p>	
										<em><a class="altc" rel="external" href="<?php the_permalink();?>"><?php the_title(); ?></a></em>
										BY <?php the_author_posts_link(); ?>
									</p>		
								</div>



								<?php }
							wp_reset_postdata(); ?>
						
						<!-- End of Other News List -->
						<div class="sidebar_image">
							<img src="<?php bloginfo('template_directory'); ?>/images/grid.jpg">
						</div>
		

					</div>

				</div>
			</div><!-- End of Row -->
		<?php endwhile; else: ?>
			<p>There are no posts.</p>
		<?php endif ?>
	</div><!-- End of Wrapper -->


<?php get_footer(); ?>