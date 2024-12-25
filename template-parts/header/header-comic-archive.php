<?php
/**
 * The header for our Comic Archives
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
	<?php get_template_part( 'template-parts/header/site', 'branding-comic-archive' ); ?>	
		<div class="archive-header">
			<h1 class="archive-title">
			<?php 
				if (is_tax()){
					single_term_title();
				} else if ( is_category() ){
					single_cat_title();
				} else if ( is_post_type_archive() ){
					post_type_archive_title();
				} else if (is_archive()) {
					the_archive_title();
				} else {
					echo 'Archive'; // but we don't know what kind?	
				}
			?></h1>
		</div><!-- .page-header -->

		
	<?php if ( have_posts() ) :
		the_posts_pagination(
				array(
					/* translators: Hidden accessibility text. */
					'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'seventoon' ) . '</span>',
					/* translators: Hidden accessibility text. */
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'seventoon' ) . '</span>',
					/* translators: Hidden accessibility text. */
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'seventoon' ) . ' </span>',
				)
			);
	?>
		<?php if ( has_nav_menu( 'top' ) ) { ?>
			<div class="navigation-top comic-archive">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'comic-archive' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php } else { ?>
	
		<?php }; ?>
	<?php endif; ?>
	</header><!-- #masthead -->

	<div class="site-content-contain">
		<div id="content" class="site-content">
