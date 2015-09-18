<?php
// Get the portfolio post custom field data
$portfolio_images = get_field('portfolio_images'); ?>

<?php 
if (get_field('image_slider')): ?>
	<div class="flexslider flexslider-<?php echo the_ID(); ?>">
<?php 
else: ?>
	<div class="portfolio-images">
<?php 
endif; ?>
	<?php 
	if ($portfolio_images): ?>
		<ul class="slides">
			<?php
			foreach ($portfolio_images as $images): 
				if ($images['image_upload']): ?>
					<li><img src="<?php echo $images['image_upload']['url'] ?>" alt=""></li>
				<?php
				else: ?>
					<li><img src="http://<?php echo $images['image_url'] ?>" alt=""></li>
				<?php 
				endif;
			endforeach; ?>	
		</ul>
	<?php 
	else: ?>
		<img src="<?php echo get_template_directory_uri() . '/images/no-image.jpg'; ?>" alt="">
	<?php 
	endif; ?>
</div>

<?php 
if (get_field('image_slider')): ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".flexslider-<?php echo the_ID(); ?>").flexslider({
				animation: "slide",
			});
		});
	</script>
<?php 
endif; ?>