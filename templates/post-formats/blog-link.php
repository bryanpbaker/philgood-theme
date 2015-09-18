<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php edit_post_link( __( 'Edit', 'show-tell' ), '<span class="edit-link">', '</span>' ); ?>

	<?php 
		$format = get_post_format();
		$format_link = get_post_format_link($format); 
	?>
	<a class="post-format-link" href="<?php echo $format_link; ?>" rel="bookmark"><?php echo $format; ?></a>

	<header class="entry-header">
		<?php
		if (knacc_get_content_link()): ?>
			<a class="entry-link" href="<?php echo knacc_get_content_link(); ?>" rel="bookmark">
				<h1 class="entry-title">
					<?php the_title(); ?> 
					<small class="post-format-permalink-link"><?php echo knacc_get_content_link(); ?></small>
				</h1>

				<?php if (has_post_thumbnail()): ?>
				<figure class="post-thumb" style="background-image: url('<?php echo knacc_get_thumbnail_image_url(get_the_ID()); ?>')"></figure><!-- .post-thumb -->
				<?php endif; ?>
			</a>
		<?php 
		else: ?>
			<a class="entry-link" href="<?php echo get_the_content(); ?>" rel="bookmark">
				<h1 class="entry-title">
					<?php the_title(); ?>
					<small class="post-format-permalink-link"><?php echo get_the_content(); ?></small>
				</h1>

				<?php if (has_post_thumbnail()): ?>
				<figure class="post-thumb" style="background-image: url('<?php echo knacc_get_thumbnail_image_url(get_the_ID()); ?>')"></figure><!-- .post-thumb -->
				<?php endif; ?>
			</a>
		<?php 
		endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php knacc_posted_on(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( '<span>Leave a comment</span>', 'show-tell' ), __( '<span>1 Comment</span>', 'show-tell' ), __( '<span>% Comments</span>', 'show-tell' ) ); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	
	</header><!-- .entry-header -->

	<?php
	if (knacc_get_content_link()): ?>
		<div class="entry-content">
			<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'show-tell' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( is_single() ) : ?>
	<footer class="entry-meta">		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ' ', 'show-tell' ) );
			if ( $categories_list && knacc_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( '%1$s', 'show-tell' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) :
		?>
		<span class="tags-links">
			<?php printf( __( '%1$s', 'show-tell' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>
	</footer><!-- .entry-meta -->
		
	<?php knacc_share_post(); ?>
	
	<?php endif; ?>
</article><!-- #post-## -->