<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
* SevenToon v1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );
				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
