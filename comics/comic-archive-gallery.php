<?php
/**
 * The template for displaying Comic archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* SevenToon v1.0
 * @version 1.0
 */
 function mangapress_archive_body_class( $classes ){
 	// this page should only be loaded by Manga+Press Archive Gallery
 	$classes[] = 'archive';
 	$classes[] = 'tax-mangapress_series';
 	return $classes;
 }
		add_filter( 'body_class', 'mangapress_archive_body_class');
get_template_part( 'template-parts/header/header-comic-archive', get_post_format() ); ?>
<!--// template: MANGAPRESS archive-comic //-->
<div class="wrap">
	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		$archives = new WP_Query(array('post_type' => 'mangapress_comic', 'posts_per_page' => -1, 'order' => 'ASC'));
		if ( $archives->have_posts() ) :
			?>
			<?php
			// Start the Loop.
			while ( $archives->have_posts() ) :
				$archives->the_post();

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
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
