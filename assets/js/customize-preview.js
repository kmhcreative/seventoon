/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load.
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'seventoon-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! to.length ) {
					$( '#seventoon-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-branding, .site-branding a, .site-description, .site-description a' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Color scheme.
	wp.customize( 'colorscheme', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'colorscheme_hue', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				h = style.data( 'hue'),
				s = style.data( 'saturation'),
				l = style.data( 'lightness' ),
				rs = style.data( 'reduced-saturation'),
				textvalue = style.data( 'textvalue'),
				one_step  = style.data( 'one_step'),
				backstep  = style.data( 'backstep'),
				css = style.html();
console.log('IMPORTED:');
console.log('h = '+h+', s = '+s+', l = '+l);
console.log('rs= '+rs+', textvalue = '+textvalue+', one_step = '+one_step+', backstep = '+backstep);
			/* Customizer Color Saves HEX color code, we need HSL for Color Scheme
			 * This is a JS version of PHP code in color-patterns.php 
			 */
	function hex2hsl( hexstr ){		
			// set up all our fun vars
			var R, G, B, RGB, r, g, b, max, min, h, s, l, d, ladj = 0;

			if ( typeof(hexstr) != "array" ){
				hexstr = to.replace('#','');
				if (hexstr.length == 3){
					hexstr = hexstr[0] + hexstr[0] + hexstr[1] + hexstr[1] + hexstr[2] + hexstr[2];
				}
				R = parseInt( hexstr[0] + hexstr[1], 16);
				G = parseInt( hexstr[2] + hexstr[3], 16);
				B = parseInt( hexstr[4] + hexstr[5], 16);
				RGB = [R,G,B];
			}
			// scale the RGB values to 0 to 1 percentages
			r = RGB[0]/255;
			g = RGB[1]/255;
			b = RGB[2]/255;
			max = Math.max(r,g,b);
			min = Math.min(r,g,b);
			// lightness calculation, 0 to 1 scale to percentage
			l = ( max + min )/2;
			// saturation calculation, percent
			d = max - min;
			if ( d == 0){
				// achromatic (gray) color
				h = s = 0;
			} else {
				s = d/( 1 - Math.abs( (2 * l) -1) );
				// hue (if not gray) calculated directly in degrees 0-360
				switch( max ){
					case r:
						h = 60 * (((g-b)/d) % 6);
						if ( b > g ){ // will have negative h value
							h += 360;
						}
						break;
					case g:
						h = 60 * ((b-r)/d+2);
						break;
					case b:
						h = 60 * ((r-g)/d+4);
						break;
				} // end switch
			} // end else
			// make lightness adjustment
			if ( ladj > 0) { // never will be
				l += (1-l)*ladj/100;
			} else {
				l += l * ladj/100;
			}
			h = Math.round(h);
			s = Math.round(s*100);
			l = Math.round(l*100);
			return [h,s,l];
		}; // end of hex2hsl
		
		hsl = hex2hsl(to);
		h = hsl[0];
		s = hsl[1];
		l = hsl[2];
		

			rs = (.8*s);
			if (l >= 50){
				textvalue = 0;
				one_step  = 1.5;
				backstep  = .15;
			} else {
				textvalue = 100;
				one_step  = .15;
				backstep  = 1.5;
			}
console.log('EXPORTED:');
console.log(hsl);
console.log('text color: '+textvalue);
console.log('stepped: '+(l*one_step)+'%');
console.log('step_one = '+one_step);
console.log('backstep = '+backstep);
			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.replace(/--main-hue:[\s]+[0-9]+\;/gi,'--main-hue: '+h+';');
			css = css.replace(/--saturation:[\s]+[0-9]+\;/gi,'--saturation: '+s+';');
			css = css.replace(/--saturation-reduced:[\s]+[0-9]+\;/gi,'--saturation-reduced: '+rs+';');
			css = css.replace(/--lightness:[\s]+[0-9]+\;/gi,'--lightness: '+l+';');
			css = css.replace(/--text-value:[\s]+[0-9]+\;/gi,'--text-value: '+textvalue+';');
			css = css.replace(/--one-step:[\s]+(1.5|0.15)\;/gi,'--one-step: '+one_step+';');
			css = css.replace(/--backstep:[\s]+(1.5|0.15)\;/gi,'--backstep: '+backstep+';');

			style.html( css ).data( 'hue', h );
			style.html( css ).data( 'saturation', s);
			style.html( css ).data( 'lightness', l);
			style.html( css ).data( 'reduced-saturation', rs);
			style.html( css ).data( 'textvalue', textvalue);
			style.html( css ).data( 'one_step' , one_step);
			style.html( css ).data( 'backstep' , backstep);
console.log(css);
		});
	});

	wp.customize( 'nav_position', function( value ) {
		value.bind( function( to ) {
			if ( 'fixed-nav' === to ){
				$( 'body' ).addClass( 'fixed-nav' ).removeClass( 'unfixed-nav' );	
			} else {
				$( 'body' ).addClass( 'unfixed-nav' ).removeClass( 'fixed-nav' );
			}
		});
	});
	
	wp.customize( 'powered_by', function( value ) {
		value.bind( function( to ) {
			if( 'show_powered' === to ){
				$( '.powered-by' ).show();
			} else {
				$( '.powered-by' ).hide();
			}
		});
	});
	
	wp.customize( 'copyright_notice', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-notice' ).text( to );
		});
	});

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Toggle a body class if a custom header exists.
	$.each( [ 'header_image' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}
			} );
		} );
	} );

} )( jQuery );
