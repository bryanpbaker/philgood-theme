<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package show-tell
 */

get_header(); ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'show-tell' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'show-tell' ); ?></p>

					<?php get_search_form(); ?>

					<div class="clearfix">
						<div class="col-md-6">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						</div>

						<?php if ( knacc_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
						<div class="widget widget_categories col-md-6">
							<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'show-tell' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->
						<?php endif; ?>
					</div><!-- .widget -->

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>