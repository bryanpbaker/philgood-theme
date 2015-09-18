<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package show-tell
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

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<nav id="site-navigation" class="main-navigation icons" role="navigation">
		<div class="site-branding">
			<div class="logo">
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home">
					<?php 
					if (get_field('site_logo', 'option')):
						$logo = get_field('site_logo', 'option'); ?>
						<img src="<?php echo $logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>">
					<?php 
					else: ?>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/site-logo.png" alt="<?php bloginfo( 'name' ); ?>">
					<?php 
					endif; ?>
				</a>
			</div>
		</div>

		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'show-tell' ); ?></a>

		<div class="primary-menu-container">
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'container_class' => 'primary-menu-container'
		) ); ?>
		</div><!-- .primary-menu-container -->

		<?php get_sidebar(); ?>

	</nav><!-- #site-navigation -->
	
	<div id="wrapper" class="site-wrapper"><!-- #wrapper -->

	<div class="mobile-nav-btn"></div>
	
	<?php
	if (is_page()):
		$display_header_option = get_field_object('display_page_header', get_the_ID());
	elseif (is_home()):
		$display_header_option = get_field_object('display_page_header', get_option('page_for_posts'));
	endif;

	if (empty($display_header_option['default_value']) || $display_header_option['value'] == true): ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="inner">
				<h1>
					<?php 
					if (is_home()):
						single_post_title();
					elseif (is_singular() || is_page()):
						the_title();
					elseif (is_search()):
						printf( __( 'Search %s', 'show-tell' ), '<small>' . get_search_query() . '</small>' );
					elseif (is_archive()):
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_tax() ) :
							single_term_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'show-tell' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'show-tell' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'show-tell' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'show-tell' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'show-tell' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'show-tell' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'show-tell');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'show-tell');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'show-tell' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'show-tell' );

						else :
							_e( 'Archives', 'show-tell' );

						endif;
					elseif (is_404()):
						echo __( '404 Page Not Found', 'show-tell' );
					endif; ?>
				</h1>
	
				<ul class="header-social-icons">
					<?php knacc_output_social_networks(); ?>
				</ul>	
			</div>
		</header><!-- #masthead -->
	<?php 
	endif; ?>