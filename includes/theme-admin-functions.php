<?php
/*
	SevenToon Admin Functions
	This file has all the functions that only work
	on the Admin back-end
*/

function seventoon_set_custom_comic_columns( $columns ){
	if ( !seventoon_comic_plugin_enabled() ){
		$columns['comic_image'] = __( 'Comic Image', 'seventoon' );
	}
	return $columns;
}

function seventoon_custom_comic_column( $column, $post_id ){
	if ( !seventoon_comic_plugin_enabled() ){
		if ($column == 'comic_image' ){
			echo get_the_post_thumbnail( $post_id, array(120,'*') );
		// make sure image will fit:
	?><style type="text/css">
		.column-comic_image{
			width:<?php echo $size; ?>px;
		}
	  </style>
	<?php
		}
	}
}
add_filter( 'manage_comic_posts_columns', 'seventoon_set_custom_comic_columns' );
add_filter( 'manage_comic_posts_custom_column', 'seventoon_custom_comic_column', 10, 2);

/* Adds Drop-down list of Chapters to Filter Comic Post Management List */
function add_seventoon_taxonomy_filters() {
	if (!seventoon_comic_plugin_enabled() ){
		global $typenow;
	 
		// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array('chapters');
	 
		// must set this to the post type you want the filter(s) displayed on
		if( $typenow == 'comic'){
	
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if(count($terms) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>Show All $tax_name</option>";
					foreach ($terms as $term) {
						echo '<option value='. $term->slug, isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
					}
					echo "</select>";
				}
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'add_seventoon_taxonomy_filters' );