<?php
/**
 * The blog index template
 *
 * @package show-tell
 */

get_header(); ?>

<?php 
$page_id = get_option('page_for_posts');
$blog_layout = get_field('blog_page_layout', $page_id);
$blog_layout_columns = get_field('blog_layout_columns', $page_id); ?>

<div id="content" class="site-content <?php if ($blog_layout == 'masonry') echo 'blog-masonry'; ?>" <?php if ($blog_layout == 'masonry') echo 'data-columns="' . $blog_layout_columns . '"'; ?>>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ($blog_layout == 'masonry') echo '<ul class="blog-grid">'; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php if ($blog_layout == 'masonry') echo '<li class="blog-item">'; ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'templates/post-formats/blog', get_post_format() );
				?>
				<?php if ($blog_layout == 'masonry') echo '</li>'; ?>

			<?php endwhile; ?>
			
			<?php if ($blog_layout == 'masonry') echo '</ul>'; ?>

			<?php knacc_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>