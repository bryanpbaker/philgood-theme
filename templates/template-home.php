<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php 
			while ( have_posts() ) : the_post();

			$slider_alias = get_field('home_slider_alias');
			if ($slider_alias):
				echo do_shortcode("[rev_slider $slider_alias]");
			endif;

			if (get_the_content()):
				get_template_part( 'content', 'page' );
			endif;

			endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>