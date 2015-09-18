<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<div class="full-screen-video">
				<video class="covervid-video" autoplay loop>
					<source src="<?php the_field('video') ?>" type="video/mp4">
				</video>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<script type="text/javascript">
		$('.full-screen-video').coverVid(1280, 720);
	</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>