<?php
if (has_post_thumbnail()): ?>
	<img src="<?php echo knacc_get_thumbnail_image_url(get_the_ID()) ?>" alt="">
<?php 
endif; ?>

<?php
$audio_upload = get_field('audio_upload');
$audio_url = get_field('audio_url');

if ($audio_upload) {
	$src = $audio_upload;
} elseif ($audio_url) {
	$src = $audio_url;
} else {
	$src = null;
}

$attr = array(
	'src'      => $src,
	'loop'     => '',
	'autoplay' => '',
	'preload' => 'none'
);

echo wp_audio_shortcode( $attr );