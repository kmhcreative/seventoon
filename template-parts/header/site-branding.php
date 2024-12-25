<?php
/**
 * Displays header site branding
 *
* SevenToon v1.0
 * @version 1.0
 */

?>
<div class="site-branding">
		<?php the_custom_logo(); ?>

		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>
		</div><!-- .site-branding-text -->

		<?php if ( ( seventoon_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
		<a href="#content" class="menu-scroll-down"><span class="screen-reader-text">
			<?php
			/* translators: Hidden accessibility text. */
			_e( 'Scroll down to content', 'seventoon' );
			?>
		</span></a>
	<?php endif; ?>
</div><!-- .site-branding -->
