<?php
/**
 * SevenToon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
* SevenToon v1.0
 */

// Check for ClassicPress
function is_classicpress() {
	if ( function_exists( 'classicpress_version' ) ){
		return classicpress_version();
	} else {
		return false;
	}
}

function seventoon_setup() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Enables custom line height for blocks
	 */
	add_theme_support( 'custom-line-height' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'seventoon-header-image', 1000, 346, true );

	add_image_size( 'seventoon-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'seventoon' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	if ( is_classicpress() === false || is_classicpress() < 2 ){
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);
	};
	add_theme_support(
		'post-formats',
		array(
			'image',
			'gallery'
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width. When fonts are
	 * self-hosted, the theme directory needs to be removed first.
	 */
	$font_stylesheet = str_replace(
		array( get_template_directory_uri() . '/', get_stylesheet_directory_uri() . '/' ),
		'',
		(string) seventoon_fonts_url()
	);
	add_editor_style( array( 'assets/css/editor-style.css', $font_stylesheet ) );


	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

}
add_action( 'after_setup_theme', 'seventoon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seventoon_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filters SevenToon content width of the theme.
	 *
	 * @since SevenToon 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'seventoon_content_width', $content_width );
}
add_action( 'template_redirect', 'seventoon_content_width', 0 );

if ( ! function_exists( 'seventoon_fonts_url' ) ) :
	/**
	 * Register custom fonts.
	 *
	 * @since SevenToon 1.0
	 * @since SevenToon 3.2 Replaced Google URL with self-hosted fonts.
	 *
	 * @return string Fonts URL for the theme.
	 */
	function seventoon_fonts_url() {
		$fonts_url = '';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
		 */
		$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'seventoon' );

		if ( 'off' !== $libre_franklin ) {
			$fonts_url = get_template_directory_uri() . '/assets/fonts/font-libre-franklin.css';
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function seventoon_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Post Sidebar', 'seventoon' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'seventoon' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'seventoon' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'			=> __( 'Comic Sidebar', 'seventoon' ),
			'id'		    => 'comic-sidebar',
			'description'	=> __( 'Add widgets here to appear on pages using the Comic templates', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'			=> __( 'Comic Archive Ad Before', 'seventoon' ),
			'id'		    => 'comic-ad-before',
			'description'	=> __( 'A widget space for advertisements or announcements on Comic Archive pages BEFORE the comics.', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'			=> __( 'Comic Archive Ad After', 'seventoon' ),
			'id'		    => 'comic-ad-after',
			'description'	=> __( 'A widget space for advertisements or announcements on Comic Archive pages AFTER the comics.', 'seventoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'seventoon_widgets_init' );


// Create SevenToon Front "Sidebar" Sections
function seventoon_register_front_sections() {

		foreach (array(
				    __('Front Promos', 'seventoon'),
					__('Front R1 C1', 'seventoon'),
					__('Front R1 C2','seventoon'),
					__('Front R1 C3', 'seventoon'),
					__('Front R1 C4', 'seventoon'),
					__('Front R2 C1', 'seventoon'),
					__('Front R2 C2', 'seventoon'),
					__('Front R3 C1', 'seventoon')				
					) as $sidebartitle) {
			register_sidebar(array(
						'name'=> $sidebartitle,
						'id' => 'seventoon-'.sanitize_title($sidebartitle),
						'description' => __('Front Page Rows and Columns', 'seventoon'),
						'before_widget' => "<div id=\"".'%1$s'."\" class=\"widget ".'%2$s'."\">\r\n<div class=\"widget-head\"></div>\r\n<div class=\"widget-content\">\r\n",
						'after_widget'  => "</div>\r\n<div class=\"clear\"></div>\r\n<div class=\"widget-foot\"></div>\r\n</div>\r\n",
						'before_title'  => "<h2 class=\"widgettitle\">",
						'after_title'   => "</h2>\r\n"
						));
		}

}

add_action('widgets_init', 'seventoon_register_front_sections');



/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since SevenToon 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function seventoon_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. Only visible to screen readers. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'seventoon' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'seventoon_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since SevenToon 1.0
 */
function seventoon_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'seventoon_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function seventoon_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'seventoon_pingback_header' );

/**
 * Display custom color CSS.
 */
function seventoon_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/includes/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo seventoon_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'seventoon_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function seventoon_scripts() {
	// Add custom fonts, used in the main stylesheet.
	$font_version = ( 0 === strpos( (string) seventoon_fonts_url(), get_template_directory_uri() . '/' ) ) ? '20230328' : null;
	wp_enqueue_style( 'seventoon-fonts', seventoon_fonts_url(), array(), $font_version );

	// Theme stylesheet.
	wp_enqueue_style( 'seventoon-style', get_stylesheet_uri(), array(), '20240716' );
	
	// Load Dashicons (I like it more than SVG sprites)
	wp_enqueue_style( 'dashicons' );
	
	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'seventoon-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'seventoon-style' ), '20240412' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seventoon_scripts' );


/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since SevenToon 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function seventoon_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'seventoon_widget_tag_cloud_args' );
/**
 * Show the featured image below the header on single posts and pages, unless the
 * page is the front page.
 *
 * Use the filter `seventoon_should_show_featured_image` in a child theme or
 * plugin to change when the image is shown. This example prevents the image
 * from showing:
 *
 *     add_filter(
 *         'seventoon_should_show_featured_image',
 *         '__return_false'
 *     );
 *
 *
 * @return bool Whether the post thumbnail should be shown.
 */
function seventoon_should_show_featured_image() {
	$show_featured_image = ( is_single() || ( is_page() && !is_home() ) ) && has_post_thumbnail( get_queried_object_id() );
	return apply_filters( 'seventoon_should_show_featured_image', $show_featured_image );
}
/**
 * Get Frontend Only Functions if Not in Admin
 */
if (!is_admin()){
	require get_parent_theme_file_path( '/includes/theme-frontend-functions.php' );
}
/** 
 *	Get theme widget(s)
 */
 require get_parent_theme_file_path( '/includes/widgets.php' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/includes/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/includes/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/includes/template-functions.php' );
// Plugin Update Check can no longer be inside if-else
@require get_parent_theme_file_path( '/plugin-update-checker/plugin-update-checker.php' );
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$SevenToonUpdateChecker = PucFactory::buildUpdateChecker(
'https://github.com/kmhcreative/seventoon',
	__FILE__,'seventoon'
);
$SevenToonUpdateChecker->getVcsApi()->enableReleaseAssets();

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/includes/customizer.php' );

	function seventoon_promo_slider_enqueue_script() {   //Enqueue script on widget page
		global $pagenow;
		if($pagenow=='widgets.php'||$pagenow=='customize.php')
		{
			wp_enqueue_style( 'seventoon-promos-admin-style', get_template_directory_uri() .'/assets/css/admin-style.css');
			wp_enqueue_media();
			
			wp_enqueue_script('jquery-ui-core');

			$seventoon_translation_array = array(
			'newtab_string' => __( 'Open link in a new tab', 'seventoon' ),
			'newtab_value' => __( 'New tab', 'seventoon' ),
			'sametab_value' => __( 'Same tab', 'seventoon' ),
			'confirm_message' => __( 'This is the last image of this Widget. Are you sure want to proceed.', 'seventoon' )
			);
	        wp_register_script( 'seventoon-promos-admin-script', get_template_directory_uri() .'/assets/js/admin.js',array("jquery"));
			wp_enqueue_script( 'seventoon-promos-admin-script');
		}
	}
	add_action('admin_enqueue_scripts', 'seventoon_promo_slider_enqueue_script');
