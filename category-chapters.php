<?php
/**
 * The template for displaying archive pages
 * for CATEGORY "Chapters" using regular posts as comics
 *
* SevenToon v1.0
 * @version 1.0
 */

get_template_part( 'template-parts/header/header-comic-archive', get_post_format() ); ?>
<!--// template: category-chapters //-->
<div class="wrap">
<?php
 if ( is_active_sidebar( 'comic-ad-before' ) ) {
?>
		<aside id="ad_before" class="widget-area" aria-label="<?php esc_attr_e( 'Advertising/Announcement', 'seventoon' ); ?>">
			<?php dynamic_sidebar( 'comic-ad-before' ); ?>
		</aside>
<?php
 }
 if ( have_posts() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_term_title(); ?></h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
			?>
			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;

			

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		
		if ( is_active_sidebar( 'comic-ad-after' ) ) {
		?>
			<aside id="ad_after" class="widget-area" aria-label="<?php esc_attr_e( 'Advertising/Announcement', 'seventoon' ); ?>">
				<?php dynamic_sidebar( 'comic-ad-after' ); ?>
			</aside>
		<?php
		}	
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
