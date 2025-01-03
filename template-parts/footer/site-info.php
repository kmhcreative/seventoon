<?php
/**
 * Displays footer site info
 *
 * @subpackage Seven_Toon
 * @since SevenToon 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	if ( !empty(get_theme_mod('copyright_notice')) ){
		echo '<p class="copyright-notice">&copy;' . date_i18n('Y') .' '.  esc_html( get_theme_mod('copyright_notice') ) . '</p>';
	}
	if ( get_theme_mod('powered_by') == 'show_powered' ){
		if ( function_exists( 'classicpress_version' ) ){
			$platform = "ClassicPress";
			$project  = "https://www.classicpress.net";
		} else {
			$platform = "WordPress";
			$project  = "https://wordpress.org";
		}
	?>
	<p class="powered-by"><a href="<?php echo esc_url( __( $project, 'seventoon' ) ); ?>" class="imprint">
		<?php
			/* translators: %s: WordPress */
		printf( __( 'Powered by %s', 'seventoon' ), $platform );
		?>
	</a> Using the <?php echo '<svg width="16" height="16" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill:currentColor;fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
    <g transform="matrix(0.00817049,0,0,0.00817049,-0.367639,-0.504307)">
        <path fill="currentColor" d="M63.339,61.723L1984.92,239.573L1758.65,1538.87L1457.84,1506.03L1980.38,2019.99L1063.38,1545.1L191.1,1431.11L63.339,61.723ZM906.237,571.206L947.101,762.034L1190.64,709.881L1286.07,1311.05L1575.21,1339.45L1429.44,658.744L1672.99,606.591L1616.63,343.437L906.237,571.206ZM195.512,313.284C195.512,313.284 263.043,481.336 324.075,504.2L677.506,431.389C677.506,431.389 352.588,875.008 331.519,1094.02L515.158,1218.33C515.158,1218.33 609.804,641.856 970.845,415.763C970.845,415.763 884.647,239.002 810.272,243.565C735.897,248.127 208.47,297.159 195.512,313.284Z"/>
    </g>
</svg>'; ?>SevenToon Theme</p>
	<?php }; ?>
</div><!-- .site-info -->
