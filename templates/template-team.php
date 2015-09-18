<?php
/**
 * Template Name: Team Template
 */

get_header(); ?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('no-radius'); ?>>
						<section class="team-members <?php if (!get_the_content()) echo 'no-content'; ?> clearfix">
							<?php
								$team_members = get_field('team_members');
								$team_members_count = count($team_members); 

								if ($team_members_count == 1):
									$ul_class = 'col-1';
								elseif ($team_members_count == 2):
									$ul_class = 'col-2';
								elseif ($team_members_count == 3):
									$ul_class = 'col-3';
								elseif ($team_members_count == 4):
									$ul_class = 'col-2';
								else:
									$ul_class = 'col-3';
								endif;
							?>
							<ul class="<?php echo $ul_class; ?>">
								<?php
								foreach($team_members as $member): ?>
									<li>
										<figure class="member-image" style="background-image: url('<?php echo $member['member_image']; ?>')">
											<?php 
											if (!$member['member_image']): ?>
												<span class="knacc icon-knacc-avatar"></span>
											<?php 
											endif; ?>
										</figure>
										<h1 class="member-name">
											<?php echo $member['member_name']; ?>
										</h1>
										<h2 class="member-job-title">
											<?php echo $member['member_job_title']; ?>
										</h2>
										<aside class="member-icons">
											<?php echo $member['member_icons']; ?>
										</aside>
									</li>
								<?php 
								endforeach; ?>
							</ul>
						</section>
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

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

