<?php 
/*
	
	Template Name: Streams Page

*/
get_header(); ?>
<div class="page_wrapper">
	
	<?php $my_streams = array('post_type' => 'streams'); $my_streams = new WP_Query($my_streams); ?>
	<?php if ( $my_streams->have_posts() ) : while ( $my_streams->have_posts() ) : $my_streams->the_post(); ?>
	<?php if(get_field('is_featured') == 1) : ?>
		<article class="featured_stream">
			<div class="container">
				<object type="application/x-shockwave-flash"
				        id="live_embed_player_flash" 
				        data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php the_field('username'); ?>" 
				        bgcolor="#000000">
				  <param  name="allowFullScreen" 
				          value="true" />
				  <param  name="allowScriptAccess" 
				          value="always" />
				  <param  name="allowNetworking" 
				          value="all" />
				  <param  name="movie" 
				          value="http://www.twitch.tv/widgets/live_embed_player.swf" />
				  <param  name="flashvars" 
				          value="hostname=www.twitch.tv&channel=<?php the_field('username'); ?>&auto_play=true&start_volume=50" />
				</object>
			</div>
		</article>
	<?php endif; ?>
	<?php endwhile; else: ?>
		
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<div class="row stream_row">
		<div class="container streams">

			<?php
			$pstring = get_field('stream_one');
			$stream_list = explode(',' , $pstring);
			$string=implode(",",$stream_list);
			$streamlength = count($stream_list);
			$my_streams = array('post_type' => 'streams'); $my_streams = new WP_Query($my_streams); 
			if ( $my_streams->have_posts() ) : while ( $my_streams->have_posts() ) : $my_streams->the_post(); 

				$mycurl = curl_init();

				curl_setopt ($mycurl, CURLOPT_HEADER, 0);
				curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);

				$url = "http://api.justin.tv/api/stream/list.json?channel=" . get_field('username'); 
				curl_setopt ($mycurl, CURLOPT_URL, $url);

				$web_response =  curl_exec($mycurl); 

				$results = json_decode($web_response); 
				foreach ($results as $s){
				}; ?>
				
				<div class="col span_6 c_2">
					<div class="stream_info">
						<div><span><a href="http://www.twitch.tv/<?php echo get_field('username') ?>"><?php echo get_field('username') ?></a></span></div>
						<div><span><?php if($s != '') : echo $s->channel_count . ' viewers'; endif; ?><?php echo $results->channel_count ?><?php if($s == '') : echo 'Offline'; endif;?></span></div>
						<div><span><?php $thetwitter = get_post_meta($post->ID, 'twitter', TRUE); if($thetwitter != '') : ?><a href="<?php the_field('twitter'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"></a><?php endif; ?><?php $thefacebook = get_post_meta($post->ID, 'facebook', TRUE); if($thefacebook != '') : ?><a href="<?php the_field('facebook'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png"></a><?php endif; ?></span></div>
					</div>

					<object type="application/x-shockwave-flash" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo get_field('username') ?>" bgcolor="#000000"><param  name="allowFullScreen" value="true" /><param  name="allowScriptAccess" value="always" /><param  name="allowNetworking" value="all" /><param  name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param  name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo get_field('username') ?>&auto_play=false&start_volume=0" />
					</object>
				</div>


			<?php $s = '';?>
			<?php endwhile; else: ?>
				<p>There are no posts.</p>
			<?php endif; ?>
			<?php wp_reset_query(); ?>

		
			

		</div>
	</div>

</div><!-- End of Wrapper -->


<?php get_footer(); ?>
