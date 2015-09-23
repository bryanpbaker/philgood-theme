<?php
/**
 * Template Name: Portfolio Template
 *
 * This is the main index template to list all of the posts for the portfolio post type
 */

get_header(); ?>

<div id="primary" class="content-area portfolio-template-index">
	<main id="main" class="site-main" role="main">
		
		<?php 
		while ( have_posts() ) : the_post();

			$slider_alias = get_field('portfolio_top_slider_alias');
			if ($slider_alias):
				echo do_shortcode("[rev_slider $slider_alias]");
			endif;

			if (get_the_content()):
				get_template_part( 'content', 'page' );
			endif;

		endwhile; // end of the loop.
		
		// Get the portfolio page layout options
		$thumbnail_style = get_field('portfolio_thumbnail_style');
		$thumbnail_margin = get_field('portfolio_thumbnail_margin');
		$columns_num = get_field('portfolio_columns_number');
		if (empty($columns_num)):
			$columns_num = 3;
		endif; ?>
		
		<?php
		// Portfolio post type query
		$query = new WP_Query( array('post_type' => 'portfolio', 'posts_per_page' => -1));
	
		if ( $query->have_posts() ) : ?>
		
		<div class="portfolio-wrapper" <?php if ($thumbnail_margin) echo 'style="padding: ' . $thumbnail_margin .  'px 0 0 ' . $thumbnail_margin . 'px;"'; ?>>

			<ul class="portfolio-list portfolio-masonry <?php if ($thumbnail_style == 'title-underneath') echo 'portfolio-has-title'; ?>" data-columns="<?php echo $columns_num; ?>">

				<?php 
				while ( $query->have_posts() ) : $query->the_post();
					
					//	Get the featured image for the post
					if (has_post_thumbnail()):
						$thumbnail_image_id = get_post_thumbnail_id();
						$thumbnail_image_url = wp_get_attachment_image_src($thumbnail_image_id,'large', true);
						$thumbnail_image = $thumbnail_image_url[0];
					else:
						$thumbnail_image = get_template_directory_uri() . '/images/no-image.jpg';
					endif;
	
					$post_format = get_post_format();

					if (get_field('double_size') == true):
						$double_size_class = 'portfolio-double-size';
					else:
						$double_size_class = false;
					endif;
	
					// If standard post format
					// ------------------------------------------------------------------------------------
					if ($post_format == ''):
					
					// Get the featured image or first portfolio image
					$the_image = knacc_portfolio_first_image(); ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format is-loading <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" <?php if ($thumbnail_margin) echo 'style="margin: 0 ' . $thumbnail_margin .  'px ' . $thumbnail_margin .  'px 0;"'; ?>>
								<img src="<?php echo $the_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<img src="<?php the_field('portfolio_page_rollover_image'); ?>" alt="">
									<?php
									/* 
									if (get_the_title()): ?>
										<h1 class="title"><?php the_title(); ?></h1>
										<?php
										if ($thumbnail_style == 'title-underneath' && has_excerpt()): ?>
											<span class="excerpt"><?php the_excerpt(); ?></span>
										<?php 
										endif; ?>
									<?php 
									endif; */?>
								</header>
							</a>
						</li>
		
						<?php
						//	Reset image_url variable for the next loop
						$the_image = NULL; ?>
						
					<?php
					// If video post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'video'): ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-video is-loading <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" <?php if ($thumbnail_margin) echo 'style="margin: 0 ' . $thumbnail_margin .  'px ' . $thumbnail_margin .  'px 0;"'; ?>>
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<img src="<?php the_field('portfolio_page_rollover_image'); ?>" alt="">
									<?php /*
									if (get_the_title()): ?>
										<h1 class="title"><?php the_title(); ?></h1>
										<?php
										if ($thumbnail_style == 'title-underneath' && has_excerpt()): ?>
											<span class="excerpt"><?php the_excerpt(); ?></span>
										<?php 
										endif; ?>
									<?php 
									endif; */?>
								</header>
							</a>
						</li>
	
					<?php
					// If image post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'image'):
						
						// Get the lightbox image from the post lightbox image fields
						if (get_field('lightbox_image_upload')):
							$lightbox_image = get_field('lightbox_image_upload');
						elseif (get_field('lightbox_image_url')):
							$lightbox_image = 'http://' . get_field('lightbox_image_url');
						else:
							$lightbox_image = get_template_directory_uri() . '/images/no-image.jpg';
						endif;

						if (has_post_thumbnail()):
							$image_thumbnail_image = $thumbnail_image;
						else:
							$image_thumbnail_image = $lightbox_image;
						endif;
						
						$lightbox_image_title = pathinfo($lightbox_image, PATHINFO_BASENAME); ?>
	
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-image is-loading <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php echo $lightbox_image; ?>" data-lightbox="<?php echo $lightbox_image_title; ?>" <?php if ($thumbnail_margin) echo 'style="margin: 0 ' . $thumbnail_margin .  'px ' . $thumbnail_margin .  'px 0;"'; ?>>
								<img src="<?php echo $image_thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<img src="<?php the_field('portfolio_page_rollover_image'); ?>" alt="">
									<?php 
									/*
									if (get_the_title()): ?>
										<h1 class="title"><?php the_title(); ?></h1>
										<?php
										if ($thumbnail_style == 'title-underneath' &&  has_excerpt()): ?>
											<span class="excerpt"><?php the_excerpt(); ?></span>
										<?php 
										endif; ?>
									<?php 
									endif; */ ?>
								</header>
							</a>
						</li>
	
					<?php
					// If link post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'link'): ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-link is-loading <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="http://<?php the_field('external_link') ?>" target="blank" <?php if ($thumbnail_margin) echo 'style="margin: 0 ' . $thumbnail_margin .  'px ' . $thumbnail_margin .  'px 0;"'; ?>>
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
							</a>
						</li>
	
					<?php
					// If audio post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'audio'): ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-audio is-loading <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" <?php if ($thumbnail_margin) echo 'style="margin: 0 ' . $thumbnail_margin .  'px ' . $thumbnail_margin .  'px 0;"'; ?>>
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<img src="<?php the_field('portfolio_page_rollover_image'); ?>" alt="">
									<?php 
									/*
									if (get_the_title()): ?>
										<h1 class="title"><?php the_title(); ?></h1>
										<?php
										if ($thumbnail_style == 'title-underneath' &&  has_excerpt()): ?>
											<span class="excerpt"><?php the_excerpt(); ?></span>
										<?php 
										endif; ?>
									<?php 
									endif; */?>
								</header>
							</a>
						</li>
	
					<?php 
					endif; ?>
				<?php 
				endwhile; ?>
			</ul>

			<?php 
			//if ($featured_items): ?>
				<!-- <script type="text/javascript">
			//		jQuery(document).ready(function($){
			//			$(".featured-slider").flexslider({
			//				animation: "slide",
			//				start: function(slider) {
			//					$('.portfolio-masonry').packery();
			//				}
			//			});
			//		});
			//	</script> -->
			<?php 
			//endif; ?>
	
			<?php knacc_paging_nav(); ?>
			
		</div><!-- .portfolio-wrapper -->
	
		<?php else : ?>
	
			<?php get_template_part( 'content', 'none' ); ?>
	
		<?php endif; ?>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
