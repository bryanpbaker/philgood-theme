<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package show-tell
 */
?>

		</div><!-- #content -->

		<?php
		if (get_field('footer_text', 'option')): ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<?php do_action( 'knacc_credits' ); ?>
				<?php the_field('footer_text', 'option'); ?>
				<?php
				if (get_field('add_copyright', 'option')): ?>
					<span class="sep"> | </span> &copy; Copyright <?php echo date("Y") ?>
				<?php 
				endif; ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		<?php 
		endif; ?>
	</div><!-- #wrapper -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>