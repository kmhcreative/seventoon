<?php
/**
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 *
* SevenToon v1.0
 * @version 1.0
 */

get_header(); ?>
<!--// template: front-page //-->
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
	
			<?php
			// Show the selected front page content.
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/page/content', 'front-page' );
				endwhile;
			else :
				get_template_part( 'template-parts/post/content', 'none' );
			endif;
			?>
			<div id="row1" class="front-row">
			<?php
					if ( is_active_sidebar('seventoon-front-r1-c1') ){ ?>
				<div id="r1_far_left">
					<?php dynamic_sidebar('seventoon-front-r1-c1'); ?>
				</div>
			<?php }
					if ( is_active_sidebar('seventoon-front-r1-c2') ){ ?>
				<div id="r1_left">
					<?php dynamic_sidebar('seventoon-front-r1-c2'); ?>
				</div>
			<?php }
					if ( is_active_sidebar('seventoon-front-r1-c3') ){ ?>
				<div id="r1_right">
					<?php dynamic_sidebar('seventoon-front-r1-c3'); ?>
				</div>
			<?php }
					if ( is_active_sidebar('seventoon-front-r1-c4') ){ ?>
				<div id="r1_far_right">
					<?php dynamic_sidebar('seventoon-front-r1-c4'); ?>
				</div>
			<?php } ?>
			</div>
			<div id="row2" class="front-row">
			<?php
				if ( is_active_sidebar('seventoon-front-r2-c1') ){ ?>
				<div id="r2_left">
					<?php dynamic_sidebar('seventoon-front-r2-c1'); ?>
				</div>
			<?php }
				if ( is_active_sidebar('seventoon-front-r2-c2') ){ ?>
				<div id="r2_right">
					<?php dynamic_sidebar('seventoon-front-r2-c2');?>
				</div>
			<?php } ?>
			</div>
			<div id="row3" class="front-row">
			<?php
				if ( is_active_sidebar('seventoon-front-r3-c1') ){ ?>
				<div id="r3">
					<?php dynamic_sidebar('seventoon-front-r3-c1'); ?>
				</div>
			<?php } ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php 
		/* blog list tests "true" for is_home() and is_front_page()
		 * static homepage tests "true" for is_front_page() but "false" for is_home()
		 */
		if ( is_home() ){
			get_sidebar(); 
		}
	?>
</div><!-- .wrap -->
<?php
get_footer();
