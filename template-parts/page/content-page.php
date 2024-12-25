<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* SevenToon v1.0
 * @version 1.0
 */

?>
<!--// template part: content-page //-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if ( is_front_page() && is_home() ){
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ). '" rel="bookmark">', '</a></h1>' );
		} else {
			the_title( '<h1 class="entry-title">', '</h1>' ); 
		}
		?>
		<?php seventoon_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'seventoon' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
