<!DOCTYPE html>
<html>

	<head>
		<title>
			<?php

				wp_title( '-', true, 'right');

				bloginfo( 'name' );

			?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<?php wp_head(); ?>
	</head>
	<body>
	


		<nav>
			<div class="nav_container">
				<div class="logo">
					<figure>
						<a href="<?php echo get_option('home'); ?>"></a>
					</figure>
				</div>
				<span class="logo_text"><em>GOLD GAMING</em> LOS ANGELES</span>
				<div id="nav">
					<?php
						
						$args = array(
							'menu' => 'main-menu',
							'container' => ''
						);

						wp_nav_menu( $args);

					?>
				</div>
			</div>
		</nav>

