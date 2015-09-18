<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package show-tell
 */
?>

	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>	

	    <?php 
		//	If post type equals 'post' then we display the blog sidebar widget area
	    if (get_post_type() == 'post'): ?>
	    
	    	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-1')) ?>

	    <?php 
	    //	If displaying the portfolio index template or the portfolio post type then we display the portfolio sidebar widget area
	    elseif (is_page_template('templates/template-portfolio.php') || get_post_type() == 'portfolio'): ?>

	    	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-portfolio')) ?>

		<?php 
	    //	If display a standard page then display the primary sidebar widget area
	    else: ?>
			
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-page')) ?>

	    <?php endif; ?>

	</div><!-- #secondary -->
