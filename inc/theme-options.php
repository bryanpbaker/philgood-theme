<?php
/**
 * Knacc Show + Tell Theme Options Set-up
 *
 **/

add_filter('acf/options_page/settings', 'theme_options_settings');
function theme_options_settings( $options )
{
	$options['title'] = 'Show + Tell';
	$options['pages'] = array(
		__('General', 'show_tell'),
		__('Design / Style', 'show_tell'),
		__('Portfolio', 'show_tell'),
		__('Social', 'show_tell')
	);

	return $options;
}