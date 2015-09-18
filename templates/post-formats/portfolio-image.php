<?php
// Get the lightbox image from the post lightbox image fields
if (get_field('lightbox_image_upload')):
	$lightbox_image = get_field('lightbox_image_upload');
elseif (get_field('lightbox_image_url')):
	$lightbox_image = 'http://' . get_field('lightbox_image_url');
else:
	$lightbox_image = get_template_directory_uri() . '/images/no-image.jpg';
endif; ?>

<img src="<?php echo $lightbox_image; ?>">