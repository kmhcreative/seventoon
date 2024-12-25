<?php
/**
 * Displays top navigation
 *
* SevenToon v1.0
 * @version 1.2
 */

?>
<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'seventoon' ); ?>">
	<div id="mobilemenu">	
		<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
			<?php _e( 'Menu', 'seventoon' ); ?>
		</button>
	
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'top',
				'menu_id'        => 'top-menu',
			)
		);
		?>
	</div>
</nav><!-- #site-navigation -->
