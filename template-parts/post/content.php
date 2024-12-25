<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* SevenToon v1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
		if ( is_single() ) {
				seventoon_posted_on();
		} else {
				echo seventoon_time_link();
				seventoon_edit_link();
		}
		echo '</div><!-- .entry-meta -->';
		}
		?>
	</header><!-- .entry-header -->
<!--// before featured image /-->
	<?php
	if ( has_post_thumbnail() && ! is_single()  ) { ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php } else { ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php } ?>

<!--// afer featured image /-->
	<div class="entry-content">
	<!--// from template-parts/content.php //-->
		<?php
		the_content(
			sprintf(
				/* translators: %s: Post title. Only visible to screen readers. */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'seventoon' ),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'seventoon' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		seventoon_entry_footer();
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->
