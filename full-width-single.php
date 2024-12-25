<?php
/**
/**
 * Template Name: Full Width
 * Template Post Type: post
 *
 * Description: Blog posts with same layout as Comic Posts
 */

get_header(); ?>
<!--// template: full-width-single //-->
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation(
					array(
						/* translators: Hidden accessibility text. */
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'seventoon' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'seventoon' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"></span>%title</span>',
						/* translators: Hidden accessibility text. */
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'seventoon' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'seventoon' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"></span></span>',
					)
				);

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
