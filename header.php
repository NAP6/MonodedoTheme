<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MonodedoTheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'monodedotheme'); ?></a>

		<header id="masthead" class="site-header">
			<nav id="menu" class="navbar navbar-dark navbar-expand-lg bg-mono-b fixed-top" role="navigation">
				<div class="container-fluid">
					<!-- <div class="site-branding navbar-brand"> -->
					<?php

					if (has_custom_logo()) { ?>
						<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php the_custom_logo(); ?></a>
						<?php } else {
						if (is_front_page() && is_home()) :
						?>
							<h1 class="site-title  text-white"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php
						else :
						?>
							<p class="site-title  text-white"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
						endif;
					}
					?>
					<!--</div> .site-branding -->


					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<?php
					wp_nav_menu(array(
						'theme_location'    => 'Primary',
						'depth'             =>  2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'navbarSupportedContent',
						'menu_class'        => 'nav navbar-nav  ml-auto text-white',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker(),
					));
					?>
				</div>
				<?php
				if (function_exists('monodedotheme_woocommerce_header_cart')) {
					//monodedotheme_woocommerce_header_cart();
				}
				?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
		<div class="py-4 my-2"></div>