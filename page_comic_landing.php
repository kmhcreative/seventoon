<?php
/**
 * Template Name: Comic Landing Page
 *
 * This is the template for Comic Landing Pages.
 * It is designed to ape the general layout of a certain
 * popular webcomics website.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* SevenToon v1.0
 * @version 1.0
 */

get_header(); ?>
<!--// template: page_comic_landing //-->
<div class="wrap"><!--// page_comic_landing //-->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar('comic-sidebar'); ?>
</div><!-- .wrap -->

<?php
get_footer();
