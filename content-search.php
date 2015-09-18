<?php
/**
 * @package show-tell
 */
?>
<article id="post-<?php the_ID(); ?>" class="post">

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php 
		$format = get_post_format();
		$format_link = get_post_format_link($format); 
	?>

	<?php edit_post_link( __( 'Edit', 'show-tell' ), '<span class="edit-link">', '</span>' ); ?>

	<?php if (get_the_excerpt()): ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php endif; ?>

</article><!-- #post-## -->