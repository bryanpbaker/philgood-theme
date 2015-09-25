<?php
/**
 * Template Name: Profile Template
 */

get_header(); ?>
<div class="hero-image">
	<img src="<?php the_field('hero_image'); ?>" alt="">
</div>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="profile-header">
						<div class="profile-details" style="background-image: url('<?php if (has_post_thumbnail(get_the_ID())) echo knacc_get_thumbnail_image_url(get_the_ID()); ?>')">
							<!-- <figure class="profile-image">
								<?php 
								if (get_field('profile_image')): ?>
									<img src="<?php the_field('profile_image')?>" alt="Profile Image">
								<?php 
								endif; ?>
							</figure> -->
							<div class="profile-info">
								<h1 class="profile-name">
									<?php the_field('profile_name'); ?>
								</h1>
								<h2 class="profile-job-title">
									<?php the_field('profile_job_title'); ?>
								</h2>
								<aside class="profile-icons">
									<?php the_field('profile_icons'); ?>
								</aside>
							</div>
						</div>
				
						<?php 
						if (get_field('profile_featured_text')): ?>
							<section class="profile-lead">
								<?php the_field('profile_featured_text'); ?>
							</section>
						<?php 
						endif; ?>
					</header>

					<?php 
					if (get_the_content()): ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'show-tell' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
					<?php 
					endif; ?>
					<?php edit_post_link( __( 'Edit', 'show-tell' ), '<span class="edit-link">', '</span>' ); ?>
				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

