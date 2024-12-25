<?php
/**
 * SevenToon: Customizer
 *
* SevenToon v1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seventoon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'seventoon_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'seventoon_customize_partial_blogdescription',
		)
	);

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting(
		'colorscheme',
		array(
			'default'           => 'light',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'seventoon_sanitize_colorscheme',
		)
	);

	$wp_customize->add_setting(
		'colorscheme_hue',
		array(
			'default'           => '#ffffff',
			'transport'         => 'postMessage',
//			'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		'colorscheme',
		array(
			'type'     => 'radio',
			'label'    => __( 'Color Scheme', 'seventoon' ),
			'choices'  => array(
				'light'  => __( 'Light', 'seventoon' ),
				'dark'   => __( 'Dark', 'seventoon' ),
				'custom' => __( 'Custom', 'seventoon' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'colorscheme_hue',
			array(
				'mode'     => 'full',
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);
	

	/**
	 * Theme options.
	 */	 
	 
	$wp_customize->add_section(
		'theme_options',
		array(
			'title'    => __( 'Theme Options', 'seventoon' ),
			'priority' => 130, // Before Additional CSS.
			'capability' => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_setting(
		'nav_position',
		array(
			'default'		 	=> 'unfixed-nav',
			'sanitize_callback' => 'seventoon_sanitize_nav_position',
			'transport'			=> 'postMessage',
		)
	);
	$wp_customize->add_control(
		'nav_position',
		array(
			'label'			=> __( 'Navigation Position', 'seventoon' ),
			'section'		=> 'theme_options',
			'type'			=> 'radio',
			'description'	=> __( 'Normally the main navigation only has a fixed position on the Comic Archive pages, this option allows you to apply fixed navigation site-wide.', 'seventoon' ),
			'choices'		=> array(
				'fixed-nav' 	=> __( 'Fixed Navigation Bar',   'seventoon' ),
				'unfixed-nav'	=> __( 'Unfixed Navigation Bar', 'seventoon' ),
			),
			'active_callback'	=> 'seventoon_is_view_with_nav_position',
		)
	);	
	$wp_customize->add_section(
		'footer_options',
		array(
			'title'		=> __( 'Footer Optons', 'seventoon' ),
			'priority'  => 130,
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
		'powered_by',
		array(
			'default'			=> 'show_powered',
			'sanitize_callback' => 'seventoon_sanitize_powered_by',
			'transport'			=> 'postMessage',
		)
	);
	$wp_customize->add_control(
		'powered_by',
		array(
			'label'			=> __( 'Powered By Text', 'seventoon' ),
			'section'	    => 'footer_options',
			'type'		    => 'radio',
			'description'   => __( 'The "Powered By Wordpress Using the Seventoon Theme" text in the footer', 'seventoon' ),
			'choices'		=> array(
				'show_powered'	=> __( 'Show Text', 'seventoon' ),
				'hide_powered'  => __( 'Hide Text', 'seventoon' ),
			),
			'active_callback' => 'seventoon_is_view_with_powered_option',
		)
	);
	$wp_customize->add_setting(
		'copyright_notice',
		array(
			'default'		    => '',
			'sanitize_callback' => 'seventoon_sanitize_copyright_notice',
			'transport' 		=> 'postMessage',
		)
	);
	$wp_customize->add_control(
		'copyright_notice',
		array(
			'label'			=> __( 'Copyright Notice', 'seventoon' ),
			'section'		=> 'footer_options',
			'type'			=> 'text',
			'description'	=> __( 'Add a copyright notice to the footer area. No need to add the year, it is automatically kept current.', 'seventoon' ),
			'active_callback' => 'seventoon_is_view_with_copyright_notice',
		)
	);
		
}
add_action( 'customize_register', 'seventoon_customize_register' );


/**
 * Sanitize the navigation setting
 *
 * @param string $input Nav position
 */
function seventoon_sanitize_nav_position( $input ) {
	$valid = array(
		'fixed-nav'		=> __( 'Fixed Navigation Bar',   'seventoon' ),
		'unfixed-nav' 	=> __( 'Unfixed Navigation Bar', 'seventoon' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}
	return '';
}

/**
 * Sanitize Powerd By Text
 *
 * @param string $input Powered By.
*/
function seventoon_sanitize_powered_by( $input ){
	$valid = array(
		'show_powered' => __( 'Show Text', 'seventoon' ),
		'hide_powered' => __( 'Hide Text', 'seventoon' ),
	);
	if (array_key_exists( $input, $valid ) ){
		return $input;
	}
	return '';
}
/**
 * Sanitize Copyright Notice
 *
 * @param strong $input Copyrignt notice
 */
function seventoon_sanitize_copyright_notice( $input ){
	return sanitize_text_field( $input );
}

/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 */
function seventoon_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since SevenToon 1.0
 *
 * @see seventoon_customize_register()
 *
 * @return void
 */
function seventoon_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since SevenToon 1.0
 *
 * @see seventoon_customize_register()
 *
 * @return void
 */
function seventoon_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 *
 * This function is an alias for seventoon_is_frontpage().
 *
 * @since SevenToon 1.0
 * @since SevenToon 3.3 Converted function to an alias.
 *
 * @return bool Whether the current page is the front page and static.
 */
function seventoon_is_static_front_page() {
	return seventoon_is_frontpage();
}

/**
 * Return whether we're on a view that supports fixed navigation bar.
 */
function seventoon_is_view_with_nav_position() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Return whether we're on a view that supports the footer in layout
 */
function seventoon_is_view_with_powered_option() {
	// available on all pages.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}
/**
 * Return wehther we're on a view that supports fooder in layout
 */
function seventoon_is_view_with_copyright_notice() {
	// available on all pages.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function seventoon_customize_preview_js() {
	wp_enqueue_script( 'seventoon-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '20161002', array( 'in_footer' => true ) );
}
add_action( 'customize_preview_init', 'seventoon_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function seventoon_panels_js() {
	wp_enqueue_script( 'seventoon-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '20161020', array( 'in_footer' => true ) );
}
add_action( 'customize_controls_enqueue_scripts', 'seventoon_panels_js' );
