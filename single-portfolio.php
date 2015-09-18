<?php
/**
 * The Template for displaying all single posts.
 *
 * @package show-tell
 */

get_header(); ?>
	
	<div id="primary" class="content-area portfolio-template-single">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				// We need to determine from theme options which page layout to use for this page (fixed or fluid)
				// Once we know, this is then loaded as a class name in the post class function for the css to work

				// Get global portfolio single page layout option (from portfolio options page)
				$global_layout = get_field_object('global_portfolio_single_page_layout', 'option');

				// Use the layout option field from the post if set (overrides global option) and if 'use global option' is not selected
				if (get_field('portfolio_single_page_layout') != '' && get_field('portfolio_single_page_layout') != 'use-global'):
					$layout_class = get_field('portfolio_single_page_layout');

				// Otherwise we default to the global option value
				elseif ($global_layout['value']):
					$layout_class = $global_layout['value'];

				// And if no global option value is set then we resort to the deafult value of the global option
				else:
					$layout_class = $global_layout['default_value'];
				endif;
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($layout_class); ?>>
				<div class="portfolio-content-format">

				<?php
				//	Include the post format template
				$format = get_post_format();
	  			get_template_part( 'templates/post-formats/portfolio', $format ); ?>

	  			</div>

	  			<div class="entry-content">

				<header class="entry-header">
					
					<h1 class="entry-title"><?php the_title(); ?></h1>		

					<?php
					//	Project Date
					if ( get_field('project_date') || get_field('client_name') || get_field('project_url') || get_field('external_link') ): ?>
					<aside class="entry-meta">
					<?php
					//	Project Date
					if ( get_field('project_date') ): 
						$date = DateTime::createFromFormat('Ymd', get_field('project_date')); ?>
						<span class="entry-date"><?php echo $date->format('d-m-Y'); ?></span>
					<?php 
					endif; ?>

					<?php
					//	Client Name
					if ( get_field('client_name') ): ?>
						<span class="client-name"><?php the_field('client_name'); ?></span>
					<?php
					endif; ?>

					<?php
					//	Project Link
					if ( get_field('project_url') ): ?>
						<span class="project-link"><a href="http://<?php the_field('project_url'); ?>"><?php the_field('project_url'); ?></a></span>
					<?php
					endif; ?>

					<?php
					//	External Link Link
					if ( get_field('external_link') ): ?>
						<span class="external-link"><a href="http://<?php the_field('external_link'); ?>"><?php the_field('external_link'); ?></a></span>
					<?php
					endif; ?>
					</aside><!-- .entry-meta -->
					<?php
					endif; ?>

				</header><!-- .entry-header -->
				
				<?php
				//	Project Description
				if (get_field('project_description')): ?>
					<div class="entry-description">
						<?php the_field('project_description'); ?>
					</div><!-- .entry-description -->
				<?php
				endif; ?>

				<?php  
				$categories_slug = get_the_term_list($post->ID, 'portfolio-categories', '<span class="cat-links">', ' ', '</span>');
				$tags_slug = get_the_term_list($post->ID, 'portfolio-tags', '<span class="tags-links">', ' ', '</span>');
				
				if ( $categories_slug || $tags_slug ):
				?>
					<footer class="entry-meta">
						<?php
						//	Post Categories
						echo $categories_slug;

						//	Post Tags
						echo $tags_slug;
						?>
					</footer>
				<?php 
				endif; ?>

			</div><!-- .entry-content -->

			<?php knacc_share_post(); ?>

			</article><!-- .entry-meta -->

			<?php knacc_post_nav(); ?>
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>