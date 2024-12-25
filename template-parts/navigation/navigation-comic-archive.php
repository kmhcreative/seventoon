<?php
/**
 * Displays top navigation on Comic Chapter Archive Pages
 *
 * This was rewritten to (hopefully) work with pure CSS and screenreaders
 * in modern browsers that support :focus-within which should be every
 * browser now. All desktop and mobile browsers adopted it in 2017 except
 * for MS Edge, which did so in 2020.  Only IE and old browsers are left out.
 *
* SevenToon v1.0
 * @version 1.2
 */

?>

<nav id="site-navigation" class="main-navigation comic-archive-nav" aria-label="<?php esc_attr_e( 'Top Menu. Move outside menu to close it.', 'seventoon' ); ?>" >
	<!--// no menu toggle button so give screen readers a way to skip lengthy menus //-->
	<a class="skip-link screen-reader-text" href="#content">
		<?php
		/* translators: Hidden accessibility text. */
		_e( 'Skip Menu', 'seventoon' );
		?>
	</a>
	<!--// needs tabindex or touch can't activate //-->
	<header class="menu-toggle" tabindex="0" title="<?php _e( 'Menu', 'seventoon' ); ?>">
	
	</header>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
		)
	);
	?>

</nav><!-- #site-navigation -->
