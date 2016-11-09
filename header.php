<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bstrap-lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrap container" role="document">
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bstrap-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->
		<!-- Show cpt-bootstrap-carouselplugin if active, show header image if it's not -->
			<?php if (function_exists('cptbc_columns_head')) { ?>

				<div class="header-image">
					<?php echo do_shortcode('[image-carousel]'); ?>
				</div> <!-- .header-image -->

			<?php } else {

			$header_image = get_header_image();
			if ( ! empty($header_image) ) { ?>

				<div> <!--class="header-image"-->
					<img src="<?php header_image(); ?>" />
				</div> <!-- .header-image -->

			<?php } } ?>
		
		</header><!-- #masthead -->
		<nav class="navbar navbar-default" role="navigation">
					<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<!-- display site title in mobile menu -->
						<a class="navbar-brand visible-xs-inline-block" href="<?php echo esc_url( home_url() ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
					</div>							
					<div class="navbar-collapse collapse navbar-responsive-collapse">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'depth'      => 2,
							'container'  => false,
							'menu_class'     => 'nav navbar-nav',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
						);


						?>
						<?php get_search_form(); ?>
					</div>
				          
			</nav><!-- #site-navigation -->
	

	<div id="content" class="site-content">
