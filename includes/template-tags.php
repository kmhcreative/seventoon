<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
* SevenToon v1.0
 */

if ( ! function_exists( 'seventoon_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function seventoon_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: Post author. */
			__( 'by %s', 'seventoon' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . seventoon_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}
endif;


if ( ! function_exists( 'seventoon_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function seventoon_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: Post date. */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'seventoon' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;


if ( ! function_exists( 'seventoon_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function seventoon_entry_footer() {

		$separate_meta = __( ', ', 'seventoon' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure it is not.
		if ( ( $categories_list || $tags_list ) || get_edit_post_link() ) {

			echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<span class="cat-links">' .
							/* translators: Hidden accessibility text. */
							'<span class="screen-reader-text">' . __( 'Categories', 'seventoon' ) . '</span>' .
							$categories_list .
						'</span>';
					}

					if ( $tags_list && ! is_wp_error( $tags_list ) ) {
						echo '<span class="tags-links">'.
							/* translators: Hidden accessibility text. */
							'<span class="screen-reader-text">' . __( 'Tags', 'seventoon' ) . '</span>' .
							$tags_list .
						'</span>';
					}

					echo '</span>';
				}
			}

			seventoon_edit_link();

			echo '</footer> <!-- .entry-footer -->';
		}
	}
endif;


if ( ! function_exists( 'seventoon_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function seventoon_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Post title. Only visible to screen readers. */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'seventoon' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
