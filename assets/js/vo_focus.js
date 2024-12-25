/* Taken from here:
	https://linkedlist.ch/setting_voiceover_focus_with_javascript_17/
*/


function setVoiceOverFocus(element) {
  var focusInterval = 10; // ms, time between function calls
  var focusTotalRepetitions = 10; // number of repetitions

  element.setAttribute('tabindex', '0');
  element.blur();

  var focusRepetitions = 0;
  var interval = window.setInterval(function() {
    element.focus();
    focusRepetitions++;
    if (focusRepetitions >= focusTotalRepetitions) {
      window.clearInterval(interval);
    }
  }, focusInterval);
}

(function( $ ) {
	masthead = $( '#masthead' );
	menuToggle = masthead.find( '.menu-toggle' );
	siteNavContain = masthead.find( '.main-navigation' );
	siteNavigation = masthead.find( '.main-navigation > div > ul' );
	
	siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a')
		.on( 'focus', function(e){ 
			var el = $( this ).parent( 'li' );
			var focusInterval = 10;
			var focusTotalRepetitions = 10;
			el.setAttribute('tabindex', '0');
			el.blur();
			var focusRepetitions = 0;
			var interval = window.setInterval(function(){
				el.focus();
				focusRepetitions++;
				if (focusRepetitions >= focusTotalRepetitions){
					window.clearInterval(interval);
				}
			}, focusInterval);		
		},false);
})( jQuery );