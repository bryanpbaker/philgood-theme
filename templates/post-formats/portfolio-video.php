<?php
$post_videos = get_field('portfolio_videos');

if (get_field('video_slider')): ?>
	<div class="flexslider">
<?php 
else: ?>
	<div class="portfolio-images">
<?php 
endif; ?>
	<ul class="slides">
	<?php
	foreach ($post_videos as $video): ?>
		<li>
			<?php
			switch ($video['video_type']):
				case 'upload':
					$attr = array(
						'src'      => $video['video_upload'],
						'loop'     => '',
						'autoplay' => '',
						'preload' => 'none',
						'poster'   => $video['poster_image'],
					);
	
					echo wp_video_shortcode($attr);
				break;
	
				case 'url':
					$attr = array(
						'src'      => $video['video_url'],
						'loop'     => '',
						'autoplay' => '',
						'preload' => 'none',
						'poster'   => $video['poster_image'],
					);
	
					echo wp_video_shortcode($attr);
				break;
	
				case 'embed':
					echo $video['video_embed'];
				break;
			endswitch ?>
		</li>
	<?php
	endforeach; ?>
	</ul>
</div>