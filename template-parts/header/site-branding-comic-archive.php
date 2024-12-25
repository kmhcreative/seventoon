<?php
/**
 * Displays header site branding on Comic Archive Pages
 *
* SevenToon v1.0
 * @version 1.0
 */

?>
<!--// site-branding-comic-archive //-->
<div class="site-branding">
	<?php 
	if ( has_custom_logo() ) {
		the_custom_logo(); 
	} else { ?>
		<div class="site-branding-text">
			<?php if ( is_front_page() ) { ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php } else { ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php } ?>
		</div><!-- .site-branding-text -->
	<?php 
	}
	if ( ( seventoon_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) { ?>
		<a href="#content" class="menu-scroll-down"><span class="screen-reader-text">
			<?php
			/* translators: Hidden accessibility text. */
			_e( 'Scroll down to content', 'seventoon' );
			?>
		</span></a>
	<?php } ?>
</div><!-- .site-branding -->
