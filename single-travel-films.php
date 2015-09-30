<?php
/**
 * The Template for displaying all single posts.
 *
 * @package show-tell
 */

get_header(); ?>
	
	<div id="primary" class="content-area portfolio-template-single">
		<main id="main" class="site-main" role="main">
	
			<?php if(have_posts()): ?>
				<?php while(have_posts()) : ?>
					<?php the_post(); ?>
						<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>	

		</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>