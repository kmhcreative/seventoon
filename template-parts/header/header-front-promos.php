<?php
/**
 * Displays header promos
 *
* SevenToon v1.0
 * @version 1.0
 */

?>
<div class="custom-header">
		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>
		<div id="front_promos" class="seventoon-custom-header-image" >
			<?php dynamic_sidebar('seventoon-front-promos'); ?>
		</div>
</div><!-- .custom-header -->
