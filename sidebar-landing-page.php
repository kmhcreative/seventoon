<?php
/**
 * The sidebar for comic landing pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
* SevenToon v1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'comic-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Comic Landing Page Sidebar', 'seventoon' ); ?>">
	<!--// sidebar landing-page //-->
	<?php dynamic_sidebar( 'comic-sidebar' ); ?>
</aside><!-- #secondary -->
