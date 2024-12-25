<?php
/**
/**
 * MangaPress Latest Comic Template
 *
 */

get_header(); 
?>
<!--// MANGAPRESS Single Comic //-->
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php 
			mangapress_start_latest_comic();
			if ( have_posts() ){
			
			// Start the Loop.
			while ( have_posts() ) :
				mangapress_comic_navigation();
				the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );
				
				$terms = get_the_terms( $post->ID, 'mangapress_series');
				echo '<p>Series: ';
				$series = [];
				foreach ( $terms as $term ){
					$series[] = '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
				}
				echo implode(', ', $series);
				echo '</p>';

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
			mangapress_end_latest_comic();
			} else {
				get_template_part('comics/error', 'comic');
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php 
if ( is_single() || is_date() ){
	get_sidebar();
}
?>
</div><!-- .wrap -->
<?php
get_footer();
