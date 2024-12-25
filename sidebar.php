<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
* SevenToon v1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Post Sidebar', 'seventoon' ); ?>">
	<!--// sidebar-1 //-->
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
