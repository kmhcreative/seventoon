<?php
/**
 * Displays header media
 *
* SevenToon v1.0
 * @version 1.0
 */

?>
<div class="custom-header">
		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>
		<div class="seventoon-custom-header-image" style="background-image:url('<?php echo get_header_image(); ?>');">
		</div>
</div><!-- .custom-header -->
