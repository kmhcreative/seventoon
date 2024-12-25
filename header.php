<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
* SevenToon v1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php
		/* translators: Hidden accessibility text. */
		_e( 'Skip to content', 'seventoon' );
		?>
	</a>

	<header id="masthead" class="site-header">
		<?php if ( has_nav_menu( 'top' ) ) { ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php } else { ?>
		<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>		
		<?php }; ?>

	<?php
		if ( is_active_sidebar( 'seventoon-front-promos') && is_front_page() ){
			echo get_template_part( 'template-parts/header/header', 'front-promos' );
		} else if ( seventoon_should_show_featured_image() && is_page() && !is_home() ){
			echo '<div class="custom-header">';
			echo '     <div class="custom-header-media">';
			echo get_the_post_thumbnail( get_queried_object_id(), 'seventoon-featured-image' );
			echo '     </div>';
			echo '     <div class="seventoon-custom-header-image" style="background-image:url('.get_the_post_thumbnail_url( get_queried_object_id(), 'seventoon-header-image').');">';
			echo '     </div>';
			echo '</div>';
		} else {
			echo get_template_part( 'template-parts/header/header', 'image' );
		}
	?>

	</header><!-- #masthead -->

	<div class="site-content-contain">
		<div id="content" class="site-content">
