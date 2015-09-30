<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php if(is_page('home')) : ?>
				<div class="full-screen-video">
					<video class="covervid-video" style="height: 100%;" autoplay loop>
						<source src="<?php the_field('video') ?>" type="video/mp4">
					</video>
					<img src="<?php the_field('logo'); ?>" alt="" class="home-center-logo">
				</div>
			<?php endif; ?>

			<?php if(is_page('photography-2' || 'resume' || 'travel-films')) : ?>
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php endif; ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<script type="text/javascript">
		$('.full-screen-video').coverVid(1280, 720);
	</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>