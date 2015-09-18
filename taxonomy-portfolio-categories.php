<?php
/**
 * The template for displaying the portfolio tags taxonomy
 */

get_header(); ?>

<div id="primary" class="content-area portfolio-template-index">
	<main id="main" class="site-main" role="main">
		<?php
		
		// Get the portfolio tag term
		$term = get_term_by('slug', get_query_var('term'), 'portfolio-categories');

		// Filter wp query by portfolio categoy taxonomy
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => -1,
			'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-categories',
							'field' => 'slug',
							'terms' => $term->slug,
						)
			),
		);

		// Portfolio post type query
		$query = new WP_Query($args);
	
		if ( $query->have_posts() ) : ?>
		
		<div class="portfolio-wrapper">
	
			<ul class="portfolio-list portfolio-masonry" data-columns="3">
				
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
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $the_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<h1 class="title"><?php the_title(); ?></h1>
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
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-video <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<h1 class="title"><?php the_title(); ?></h1>
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
	
						$lightbox_image_title = pathinfo($lightbox_image, PATHINFO_BASENAME); ?>
	
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-image <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php echo $lightbox_image; ?>" data-lightbox="<?php echo $lightbox_image_title; ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $lightbox_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<h1 class="title"><?php the_title(); ?></h1>
								</header>
							</a>
						</li>
	
					<?php
					// If link post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'link'): ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-link <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="http://<?php the_field('external_link') ?>" target="blank" title="<?php the_title(); ?>">
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<h1 class="title"><?php the_title(); ?></h1>
								</header>
							</a>
						</li>
	
					<?php
					// If audio post format
					// ------------------------------------------------------------------------------------
					elseif ($post_format == 'audio'): ?>
						
						<li id="post-<?php the_ID(); ?>" class="portfolio-item portfolio-post-format-audio <?php if ($double_size_class != false) echo $double_size_class; ?>">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php echo $thumbnail_image; ?>" alt="<?php the_title(); ?>">
								<header class="entry-header">
									<h1 class="title"><?php the_title(); ?></h1>
								</header>
							</a>
						</li>
	
					<?php 
					endif; ?>
				<?php 
				endwhile; ?>
			</ul>
	
			<?php knacc_paging_nav(); ?>
			
		</div><!-- .portfolio-wrapper -->
	
		<?php else : ?>
	
			<?php get_template_part( 'content', 'none' ); ?>
	
		<?php endif; ?>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>