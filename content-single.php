<?php
/**
 * @package show-tell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
	<figure class="post-thumb">	
		<?php the_post_thumbnail(); ?>
	</figure><!-- .post-thumb -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'show-tell' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php knacc_posted_on(); ?>
		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'show-tell' ) );
			if ( $categories_list && knacc_categorized_blog() ) :
		?>
		<span data-icon="A" class="cat-links icon">
			<?php printf( __( '%1$s', 'show-tell' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) :
		?>
		<span data-icon="!" class="tags-links icon">
			<?php printf( __( '%1$s', 'show-tell' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<?php edit_post_link( __( 'Edit', 'show-tell' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
