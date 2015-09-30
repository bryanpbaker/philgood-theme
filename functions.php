<?php
/**
 * show-tell functions and definitions
 *
 * @package show-tell
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'knacc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such 
 * as indicating support for post thumbnails.
 */
function knacc_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on show-tell, use a find and replace
	 * to change 'show-tell' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'show-tell', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link', 'audio' ));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'show-tell' ),
	) );
}
endif; // knacc_setup
add_action( 'after_setup_theme', 'knacc_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function knacc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'show-tell' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Portfolio Sidebar', 'show-tell' ),
		'id'            => 'sidebar-portfolio',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'show-tell' ),
		'id'            => 'sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'knacc_widgets_init' );

function knacc_generate_options_css() {
    $ss_dir = get_template_directory();
    ob_start(); // Capture all output into buffer
    require ($ss_dir . '/inc/options-style.php'); // Grab the options-style.php file
    $css = ob_get_clean(); // Store output in a variable, then flush the buffer
    file_put_contents($ss_dir . '/css/options.css', $css, LOCK_EX); // Save it as a css file
}
add_action('acf/save_post', 'knacc_generate_options_css', 20); // Parse the output and write the CSS file

/**
 * Enqueue scripts and styles.
 */
function knacc_scripts() {
	wp_enqueue_style( 'show-tell-bootstrap', get_template_directory_uri(). '/bootstrap-3.0.3/css/bootstrap.css');
	//wp_enqueue_style( 'show-tell-bootstrap-theme', get_template_directory_uri(). '/bootstrap-3.0.3/css/theme.css');	
	wp_enqueue_style( 'show-tell-style', get_stylesheet_uri() );
	wp_enqueue_style( 'show-tell-flexslider', get_template_directory_uri(). '/css/flexslider.css');
	wp_enqueue_style( 'show-tell-custom-scrollbar', get_template_directory_uri(). '/css/jquery.mCustomScrollbar.css');
	wp_enqueue_style( 'show-tell-lightbox', get_template_directory_uri(). '/css/lightbox.css');

	// Font Awesome
    wp_register_style(
      $handle = 'font-awesome',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css",
      $deps = '',
      $ver = null,
      $media = 'all'
    );
    wp_enqueue_style('font-awesome');


	$colour_skin = get_field('colour_skin', 'option');

	if ($colour_skin && $colour_skin != 'skin-none') {
		wp_enqueue_style( 'show-tell-skin', get_template_directory_uri(). '/css/' . $colour_skin . '.css');
	}

	wp_enqueue_style('show-tell-options', get_template_directory_uri(). '/css/options.css');

	// Custom Styles
    wp_register_style(
      $handle = 'custom-styles',
      $src = get_bloginfo('template_directory') . '/sass/main.min.css',
      $deps = '',
      $ver = null,
      $media = 'all'
    );
    wp_enqueue_style('custom-styles');

	wp_enqueue_script( 'show-tell-bootstrap', get_template_directory_uri() . '/bootstrap-3.0.3/js/bootstrap.js', array('jquery'), '3.0.0', true );
	wp_enqueue_script( 'show-tell-custom-scrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '2.8.3', true );
	wp_enqueue_script( 'show-tell-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.2.2', true );
	wp_enqueue_script( 'show-tell-lightbox', get_template_directory_uri() . '/js/lightbox-2.6.min.js', array('jquery'), '2.6', true );
	wp_enqueue_script( 'show-tell-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0.3', true );
	wp_enqueue_script( 'show-tell-packery', get_template_directory_uri() . '/js/packery.pkgd.min.js', array('jquery'), '1.2.2', true );
	wp_enqueue_script( 'show-tell-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), '3.1.4', true );
	wp_enqueue_script( 'show-tell-jquery-custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'show-tell-google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '3.0', true );
	wp_enqueue_script( 'show-tell-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'covervid', get_template_directory_uri() . '/js/covervid.min.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'knacc_scripts' );

/**
 * Adds the custom page background colour / image inline css
 */
function add_custom_page_background() {

	if (is_page() || is_home()) {

		if (is_page()) {
			$page_id = get_the_ID();
		} elseif (is_home()) {
			$page_id = get_option('page_for_posts');
		}

    	$bg_colour = get_field('page_background_colour', $page_id);
    	$bg_image = get_field('page_background_image', $page_id);
    	$bg_image_repeat = get_field('page_background_image_repeat', $page_id);
    	$bg_size_css = null;

    	if ($bg_image_repeat == 'no-repeat') {
    		$bg_size_css = '-webkit-background-size: cover; -moz-background-size: cover!important; -o-background-size: cover!important; background-size: cover!important;';
    	}

    	if ($bg_colour || $bg_image) {
    		$custom_css = "body { background: url('" . $bg_image . "') " . $bg_image_repeat . " center center fixed" . $bg_colour . "!important; " . $bg_size_css ." }";
    		wp_add_inline_style( 'show-tell-style', $custom_css );
    	}
	}
}
add_action( 'wp_enqueue_scripts', 'add_custom_page_background' );

/**
 * Add any custom css from theme options
 */
function knacc_add_custom_css() {

	$custom_css = get_field('custom_css', 'options');

	if ($custom_css) {
		wp_add_inline_style('show-tell-style', $custom_css);
	}
}
add_action( 'wp_enqueue_scripts', 'knacc_add_custom_css' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/libraries/class-tgm-plugin-activation.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Load helper functions for this theme
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the Advanced Custom Fields Plugin
 * http://www.advancedcustomfields.com
 * define( 'ACF_LITE' , true );
 */
include_once get_template_directory() . '/libraries/advanced-custom-fields/acf.php';

/**
 * Load the Advanced Custom Fields Options Page Add-on
 * http://www.advancedcustomfields.com/add-ons/options-page
 */
include_once get_template_directory() . '/libraries/acf-options-page/acf-options-page.php';

/**
 * Load the Advanced Custom Fields Repeater Field Add-on
 * http://www.advancedcustomfields.com/add-ons/repeater-field
 */
include_once get_template_directory() . '/libraries/acf-repeater/acf-repeater.php';

/**
 * Load the Advanced Custom Fields Contact Form 7 Field Add-on
 * http://www.advancedcustomfields.com/add-ons/contact-form-7-field
 */
include_once get_template_directory() . '/libraries/acf-cf7-field/acf-cf7.php';

/**
 * Load the Advanced Custom Fields Image Select Field Add-on (user submitted)
 * https://github.com/cyberwani/ACF-Image-Select
 */
include_once get_template_directory() . '/libraries/acf-image-select/acf-image-select.php';

/**
 * Load theme options file.
 */
include_once get_template_directory() . '/inc/theme-options.php';

/**
 * Load custom fields file.
 */
include_once get_template_directory() . '/inc/custom-fields.php';

/**
 * Register portfolio category taxonomy
 */
add_action( 'init', 'create_portfolio_taxonomy' );

function create_portfolio_taxonomy() {
	register_taxonomy(
		'portfolio-categories', 
		null, 
		array(
			'label' => 'Portfolio Categories',
			'hierarchical' => true
		)
	);

	register_taxonomy(
		'portfolio-tags', 
		null, 
		array(
			'label' => 'Portfolio Tags',
		)
	);
}

/**
 * Register portfolio post type
 */
add_action( 'init', 'create_portfolio_post_type' );
function create_portfolio_post_type() {

	// Set the portfolio post type label
	if (get_field('portfolio_post_type_label', 'option')) {
		$portfolio_label = get_field('portfolio_post_type_label', 'option');
	} else {
		$portfolio_label = 'Portfolio';
	}

	// Set the portfolio post type slug
	if (get_field('portfolio_post_type_slug', 'option')) {
		$portfolio_slug = get_field('portfolio_post_type_slug', 'option');
	} else {
		$portfolio_slug = 'portfolio';
	}

	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'			=> __( $portfolio_label ),
				'singular_name' => __( $portfolio_label )
			),
		'public' 		=> true,
		'has_archive' 	=> false,
		'menu_position' => 20,
		'rewrite' => array('slug' => $portfolio_slug),
		'menu_icon' 	=> 'dashicons-screenoptions',
		'supports' 		=> array('title', 'thumbnail', 'excerpt'),
		'taxonomies' 	=> array('portfolio-categories', 'portfolio-tags')
		)
	);

	add_post_type_support( 'portfolio', 'post-formats', array( 'image', 'video', 'link', 'audio' ) );
}

/**
 * Register travel-films post type
 */
add_action( 'init', 'create_travel_films_post_type' );
function create_travel_films_post_type() {

	// Set the Travel Films post type label
	if (get_field('travel_films_post_type_label', 'option')) {
		$travel_films_label = get_field('travel_films_post_type_label', 'option');
	} else {
		$travel_films_label = 'Travel Films';
	}

	// Set the portfolio post type slug
	if (get_field('travel_films_post_type_slug', 'option')) {
		$travel_films_slug = get_field('travel_films_post_type_slug', 'option');
	} else {
		$travel_films_slug = 'travel-films';
	}

	register_post_type( 'travel-films',
		array(
			'labels' => array(
				'name'			=> __( $travel_films_label ),
				'singular_name' => __( $travel_films_label )
			),
		'public' 		=> true,
		'has_archive' 	=> false,
		'menu_position' => 20,
		'rewrite' => array('slug' => $travel_films_slug),
		'menu_icon' 	=> 'dashicons-screenoptions',
		'supports' 		=> array('title', 'thumbnail', 'editor'),
		'taxonomies' 	=> array('travel-films-categories', 'travel-films-tags')
		)
	);

	add_post_type_support( 'travel-films', 'post-formats', array( 'image', 'video', 'link', 'audio' ) );
}

/**
 * Add google analytics code to head
 */
add_action( 'wp_head', 'knacc_add_google_analytics_code_to_head' );
function knacc_add_google_analytics_code_to_head() {
	if (get_field('analytics_code', 'option')) {
		echo get_field('analytics_code', 'option');
	}
}

/**
 * Add custom body classes
 */
add_filter('body_class', 'knacc_add_body_classes');
function knacc_add_body_classes($classes) {

	//	Get the theme style options
	$colour_contrast_option = get_field('colour_contrast', 'option');

	// If the colour contrast option is set then load this classes
	if ($colour_contrast_option) {
		$colour_contrast = $colour_contrast_option;
	} else {
	// Otherwise we set a default
		$colour_contrast = 'contrast-sb-dark-bg-light';
	}

	$classes[] = $colour_contrast;

	return $classes;
}

add_action( 'tgmpa_register', 'knacc_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function knacc_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Revolution Slider Plugin
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> 'http://plugins.knacc.co/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.3.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// Contact Form 7 Plugin
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   				=> 'http://downloads.wordpress.org/plugin/contact-form-7.3.8.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// Bootstrap Shortcodes Plugin
		array(
			'name'     				=> 'Knacc Bootstrap Shortcodes', // The plugin name
			'slug'     				=> 'knacc-bootstrap-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> 'http://plugins.knacc.co/knacc-bootstrap-shortcodes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// Envato Wordpress Toolkit Plugin
		array(
			'name'     				=> 'Envato Wordpress Toolkit Plugin', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
			'source'   				=> 'http://plugins.knacc.co/envato-wordpress-toolkit.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		//array(
			//'name' 		=> 'BuddyPress',
			//'slug' 		=> 'buddypress',
			//'required' 	=> false,
		//),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'knacc-base';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/**
 * Display share buttons to social networks.
 */
function knacc_share_post() {
?>
	<aside class="share-post">
		<h1 class="share-title"><?php _e( 'Share', 'show-tell' ); ?></h1>
		<div class="share-links">
			<div class="share-link share-facebook"><a href="#" onclick="javascript:void(window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>','sharer','toolbar=0,status=0,width=620,height=430').focus()); return false;" title="<?php printf(__('Share on Facebook: %s', 'show-tell'), get_the_title()); ?>"><?php _e( 'Facebook', 'show-tell' ); ?></a></div>
			<div class="share-link share-twitter"><a href="#" onclick="javascript:void(window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;count=none/', 'tweet', 'height=300,width=550,resizable=1').focus()); return false;" title="<?php printf(__('Share on Twitter: %s', 'show-tell'), get_the_title()); ?>" target="blank"><?php _e( 'Twitter', 'show-tell' ); ?></a></div>
			<div class="share-link share-googleplus"><a href="#" onclick="javascript:void(window.open('https://m.google.com/app/plus/x/?v=compose&amp;content=<?php the_title(); ?> <?php the_permalink(); ?>','sharer','toolbar=0,status=0,width=620,height=400').focus()); return false;" target="_blank"><?php _e( 'Google +', 'show-tell' ); ?></a></div>
			<div class="share-link share-pinterest"><a href="#" onclick="javascript:void(window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo knacc_portfolio_first_image(); ?>&amp;description=<?php the_title(); ?> - <?php bloginfo('name'); ?>','sharer','toolbar=0,status=0,width=620,height=280').focus()); return false;" title="<?php printf(__('Pin it: %s', 'show-tell'), get_the_title()); ?>" target="_blank"><?php _e( 'Pinterest', 'show-tell' ); ?></a></div>
		</div><!-- .nav-links -->
	</aside><!-- .navigation -->
<?php
}

/**
 * Returns a select list of Google fonts
 */
function knacc_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Crete Round, serif' => 'Crete Round',
		'Arvo, serif' => 'Arvo',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Droid Serif, serif' => 'Droid Serif',
		'Lobster, cursive' => 'Lobster',
		'Nobile, sans-serif' => 'Nobile',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
		'Pacifico, cursive' => 'Pacifico',
		'Rokkitt, serif' => 'Rokkit',
		'PT Sans, sans-serif' => 'PT Sans',
		'Quattrocento, serif' => 'Quattrocento',
		'Raleway, cursive' => 'Raleway',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz',
		'Open Sans, sans-serif' => 'Open Sans',
		'Josefin Slab, serif' => 'Josefin Slab',
		'Lato, sans-serif' => 'Lato',
		'Vollkorn, serif' => 'Vollkorn',
		'Abril Fatface, serif' => 'Abril Fatface',
		'PT Sans, sans-serif' => 'PT Sans',
		'PT Serif, serif' => 'PT Serif',
		'Old Standard TT, sans-serif' => 'Old Standard TT',
		'Kotta One, serif' => 'Kotta One',
		'Alfa Slab One, cursive' => 'Alfa Slab One',
		'Source Sans Pro, sans-serif' => 'Source Sans Pro',
		'Nixie One, cursive' => 'Nixie One',
		'Fenix, serif' => 'Fenix',
		'Dosis, sans-serif' => 'Dosis',
		'Abel, sans-serif' => 'Abel',
		'Share Tech, sans-serif' => 'Share Tech',
		'Arbutus Slab, serif' => 'Arbutus Slab',
		'Habibi, serif' => 'Habibi',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Average Sans, sans-serif' => 'Average Sans',
		'Signika Negative, sans-serif' => 'Signika Negative',
		'Headland One, serif' => 'Headland One',
		'Lato, sans-serif' => 'Lato',
		'Antic Slab, serif' => 'Antic Slab',
		'Cabin, sans-serif' => 'Cabin',
		'BenchNine, sans-serif' => 'BenchNine',
		'Economica, sans-serif' => 'Economica',
		'Mate, serif' => 'Mate',
		'News Cycle, sans-serif' => 'News Cycle',
		'Rosarivo, serif' => 'Rosarivo',
		'PT Sans, sans-serif' => 'PT Sans',
		'Anaheim, sans-serif' => 'Anaheim',
		'Armata, sans-serif' => 'Armata',
		'Coustard, serif' => 'Coustard',
		'Rufina, serif' => 'Rufina',
		'Belgrano, serif' => 'Belgrano',
		'PT Sans Narrow, sans-serif' => 'PT Sans Narrow',
		'Corben, cursive' => 'Corben',
		'Petrona, serif' => 'Petrona',
		'Quicksand, sans-serif' => 'Quicksand',
		'Oleo Script, cursive' => 'Oleo Script',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'PT Serif Caption, serif' => 'PT Serif Caption',
		'Gudea, sans-serif' => 'Gudea',
		'Kite One, sans-serif' => 'Kite One',
		'Offside, cursive' => 'Offside',
		'Magra, sans-serif' => 'Magra',
		'Bitter, serif' => 'Bitter',
		'Carrois Gothic, sans-serif' => 'Carrois Gothic',
		'Lobster, cursive' => 'Lobster',
		'Kameron, serif' => 'Kameron',
		'Holtwood One SC, serif' => 'Holtwood One SC',
		'Crete Round, serif' => 'Crete Round',
		'Josefin Slab, serif' => 'Josefin Slab',
		'Russo One, sans-serif' => 'Russo One',
		'Copse, serif' => 'Copse',
		'Tienne, serif' => 'Tienne',
		'Graduate, cursive' => 'Graduate',
		'Exo, sans-serif' => 'Exo',
		'Cantarell, sans-serif' => 'Cantarell',
		'Ubuntu Condensed, sans-serif' => 'Ubuntu Condensed',
		'EB Garamond, serif' => 'EB Garamond',
		'Gafata, sans-serif' => 'Gafata',
		'Sanchez, serif' => 'Sanchez',
		'Strait, sans-serif' => 'Strait',
		'Wellfleet, cursive' => 'Wellfleet',
		'Titillium Web, sans-serif' => 'Titillium Web',
		'Archivo Narrow, sans-serif' => 'Archivo Narrow',
		'Trocchi, serif' => 'Trocchi',
		'Raleway Dots, cursive' => 'Raleway Dots',
		'Forum, cursive' => 'Forum',
		'Cutive, serif' => 'Cutive',
		'Satisfy, cursive' => 'Satisfy',
		'Inika, serif' => 'Inika',
		'Trykker, serif' => 'Trykker',
		'Doppio One, sans-serif' => 'Doppio One',
		'Carme, sans-serif' => 'Carme',
		'Varela Round, sans-serif' => 'Varela Round',
		'Advent Pro, sans-serif' => 'Advent Pro',
		'Oxygen, sans-serif' => 'Oxygen',
		'Signika, sans-serif' => 'Signika',
		'Maven Pro, sans-serif' => 'Maven Pro',
		'Cuprum, sans-serif' => 'Cuprum',
		'Pacifico, cursive' => 'Pacifico',
		'Alegreya SC, serif' => 'Alegreya SC',
		'Francois One, sans-serif' => 'Francois One',
		'Alice, serif' => 'Alice',
		'Fjord One, serif' => 'Fjord One',
		'Amatic SC, cursive' => 'Amatic SC',
		'Courgette, cursive' => 'Courgette',
		'Actor, sans-serif' => 'Actor',
		'Andada, serif' => 'Andada',
		'Lobster Two, cursive' => 'Lobster Two',
		'Didact Gothic, sans-serif' => 'Didact Gothic',
		'Bree Serif, serif' => 'Bree Serif',
		'Karla, sans-serif' => 'Karla',
		'Pontano Sans, sans-serif' => 'Pontano Sans',
		'Enriqueta, serif' => 'Enriqueta',
		'Varela, sans-serif' => 'Varela',
		'Shanti, sans-serif' => 'Shanti',
		'Nunito, sans-serif' => 'Nunito',
		'Amaranth, sans-serif' => 'Amaranth',
		'Imprima, sans-serif' => 'Imprima',
		'Bevan, cursive' => 'Bevan',
		'Patua One, cursive' => 'Patua One',
		'Noto Sans, sans-serif' => 'Noto Sans',
		'Noto Serif, serif' => 'Noto Serif',
		'Montserrat, sans-serif' => 'Montserrat',
	);
	return $google_faces;
}

/**
 * Gets selected fonts from theme options and calls enqueue function
 */
function knacc_typography_google_fonts() {

	// If heading font has been set in the theme options then use this
	if (get_field('headings_font', 'options')) {
		$heading_font = get_field('headings_font', 'options');
	} else {
		// Otherwise fallback to default
		$heading_font = 'Montserrat, sans-serif';
	}

	// If heading font has been set in the theme options then use this
	if (get_field('body_font', 'options')) {
		$body_font = get_field('body_font', 'options');
	} else {
		// Otherwise fallback to default
		$body_font = 'Ubuntu, sans-serif';
	}

	$font = knacc_format_google_font($heading_font);

	// If body font is different from the heading font then load this too
	if ($body_font != $heading_font) {
		$font = $font . '|' . knacc_format_google_font($body_font);
	}

	wp_enqueue_style( "knacc_google_font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'knacc_typography_google_fonts' );

/**
 * Outputs each enabled social network as a icon in a <li> for displaying a list of social network icons
 */
function knacc_output_social_networks() {

	// Get the social network urls from the theme social options and add to $networks array
	if (get_field('social_facebook', 'option')) 	$networks['facebook'] = get_field('social_facebook', 'option');
	if (get_field('social_twitter', 'option')) 		$networks['twitter'] = get_field('social_twitter', 'option');
	if (get_field('social_google', 'option')) 		$networks['google-plus'] = get_field('social_google', 'option');
	if (get_field('social_pinterest', 'option')) 	$networks['pinterest'] = get_field('social_pinterest', 'option');
	if (get_field('social_dribbble', 'option')) 	$networks['dribbble'] = get_field('social_dribbble', 'option');
	if (get_field('social_behance', 'option')) 		$networks['behance'] = get_field('social_behance', 'option');
	if (get_field('social_vimeo', 'option')) 		$networks['vimeo'] = get_field('social_vimeo', 'option');
	if (get_field('social_youtube', 'option')) 		$networks['youtube'] = get_field('social_youtube', 'option');
	if (get_field('social_instagram', 'option')) 	$networks['instagram'] = get_field('social_instagram', 'option');
	if (get_field('social_linkedin', 'option')) 	$networks['linkedin'] = get_field('social_linkedin', 'option');

	if (isset($networks)) {
		foreach ($networks as $network => $url) {
			echo '<li><a href="' . $url . '" target="blank"><span class="icon-knacc-' . $network . '"></span></a></li>';
		}
	}
}

add_filter('pre_get_posts', 'knacc_custom_post_type_search');
/**
 * This function modifies the main WordPress query to include an array of post types instead of the default 'post' post type.
 */
function knacc_custom_post_type_search($query) {
    if ($query->is_search)
		$query->set('post_type', array( 'post', 'portfolio'));
    return $query;
};

add_filter('excerpt_length', 'knacc_excerpt_length', 999);
/**
 * This function defines the excerpt length
 */
function knacc_excerpt_length($length) { 
	return 30;
}

