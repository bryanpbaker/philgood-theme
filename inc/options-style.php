<?php
// Get the theme colour options
// ------------------------------------------------------------------------
//$colour_skin	 			= get_field('colour_skin', 'option');
$primary_colour 			= get_field('primary_colour', 'option');
$secondary_colour 			= get_field('secondary_colour', 'option');
$body_bg_colour 			= get_field('body_background_colour', 'option');
$body_bg_image 				= get_field('body_background_image', 'option');
$sidebar_bg_colour 			= get_field('sidebar_background_colour', 'option');
$sidebar_bg_image			= get_field('sidebar_background_image', 'option');
$colour_contrast	 		= get_field('colour_contrast', 'option');
$header_background_color	= get_field('header_bg_color', 'option');



// Get the theme font options
// ------------------------------------------------------------------------
$headings_font 				= get_field('headings_font', 'option');
$body_font 					= get_field('body_font', 'option');
$body_font_size 			= get_field('body_font_size', 'option');

// Generate the Options CSS
// ------------------------------------------------------------------------

// Body font size
if ($body_font_size != '') {
	echo '.contrast-sb-dark-bg-light, .contrast-sb-dark-bg-dark, .contrast-sb-light-bg-light, .contrast-sb-light-bg-dark { font-size: ' . $body_font_size .  'px; } ';
}

// Background colour
if ($body_bg_colour != '') {
	echo '.contrast-sb-dark-bg-light, .contrast-sb-dark-bg-dark, .contrast-sb-light-bg-light, .contrast-sb-light-bg-dark { background-color: ' . $body_bg_colour .  '; } ';
}

// Background bg
if ($body_bg_image != '') {
	echo '.contrast-sb-dark-bg-light, .contrast-sb-dark-bg-dark, .contrast-sb-light-bg-light, .contrast-sb-light-bg-dark { background-image: url("' . $body_bg_image .  '"); } ';
}

// Sidebar colour
if ($sidebar_bg_colour != '') {
	echo '.contrast-sb-dark-bg-light .main-navigation, .contrast-sb-dark-bg-dark .main-navigation, .contrast-sb-light-bg-light .main-navigation, .contrast-sb-light-bg-dark .main-navigation { background-color: ' . $sidebar_bg_colour .  '; } ';
}

// Sidebar bg
if ($sidebar_bg_image != '') {
	echo '.contrast-sb-dark-bg-light .main-navigation, .contrast-sb-dark-bg-dark .main-navigation, .contrast-sb-light-bg-light .main-navigation, .contrast-sb-light-bg-dark .main-navigation { background-image: url("' . $sidebar_bg_image .  '"); } ';
}

// Heading font
if ($headings_font != '') {
	echo 'h1, h2, h3, h4, h5, h6, .main-navigation .primary-menu-container .menu a, .portfolio-template-single .post-navigation .nav-links a, .entry-quote blockquote, .profile-lead { font-family: ' . $headings_font .  '; } ';
}

// Body font
if ($headings_font != '') {
	echo 'body { font-family: ' . $body_font .  '; } ';
}

// Primary color
if ($primary_colour != '') {
	echo '::selection { background-color: ' . $primary_colour .  '; } 
	.posted-on a:hover,
	.byline a:hover,
	.cat-links a:hover,
	.tags-links a:hover,
	.comments-link a:hover,
	.more-link:hover,
	.format-link .entry-link,
	.hentry .edit-link a:hover,
	.post-format-link:link,
	.post-format-link:visited,
	.post-thumb,
	.entry-quote,
	.profile-lead,
	.main-navigation .widget-area .tagcloud a:hover,
	.comments-area .edit-link a:hover,
	.comment-reply-link:hover,
	.portfolio-template-single .project-link a:hover,
	.portfolio-template-single .external-link a:hover,
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover { background-color: ' . $primary_colour .  '; } ';
	echo '.posted-on a:hover,
	.byline a:hover, 
	.cat-links a:hover,
	.tags-links a:hover,
	.comments-link a:hover,
	.more-link,
	.portfolio-item .entry-header:after,
	.gallery-item a:after,
	.portfolio-template-single .project-link a:hover,
	.portfolio-template-single .external-link a:hover,
	.share-post .share-link a:hover:after,
	.comments-area .edit-link a:hover,
	.hentry .edit-link a:hover,
	.comment-reply-link:hover { border-color: ' . $primary_colour .  '; } ';
	echo 'a,
	a:visited,
	.entry-title a:hover,
	.site-header .header-social-icons a:hover,
	.mobile-nav-btn:before,
	.more-link, 
	.main-navigation a:hover,
	.main-navigation.icons .primary-menu-container .menu-item:hover:before,
	.main-navigation.icons .primary-menu-container .current-menu-item:before,
	.main-navigation.icons .primary-menu-container .menu-item.current-menu-item:before,
	.main-navigation.icons .widget:hover:before,
	.portfolio-item .entry-header:after,
	.is-loading:before,
	.gallery-item a:after,
	.share-post .share-link a:hover,
	.share-post .share-link a:hover:before,
	.comment-meta .comment-metadata a:hover,
	.profile-header .profile-icons a:hover,
	.site-footer a:hover { color: ' . $primary_colour .  '; } ';
}

// And so on...