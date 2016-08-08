
jQuery(function($){

	function scroll_to_hash( hash ) {

		// Bail if we don't have a valid hash
		if (hash.length == 0) { return false; }

		var $target = $(hash);

		// If no element by id, select by name
		$target = $target.length ? $target : $('[name=' + hash.slice(1) +']');

		// If no element, abort
		if ( !$target.length ) { return false; }

		// Get our target in pixels
		var scroll_target = $target.offset().top;

		// Offset by fixed header height, if we have one
		var $fixed_header = $('header.fixed');
		if ( $fixed_header.length ) {
			scroll_target = scroll_target - $fixed_header.outerHeight(true);
		}

		// Do the scrolling
		$('html,body').animate({
			scrollTop: scroll_target
		}, 800, 'easeInOutQuart');

		// Update URL with hash
		if (history.pushState) {
			history.pushState(null, null, hash);
		} else {
			location.hash = hash; // old browsers
		}

		// Prevent default behavior
		return false;

	}

	// Run right away when DOM is loaded.
	// So if the current URL has a hashtag, we'll scroll to it
	// and offset by fixed header
	scroll_to_hash(location.hash);

	// Links that start with #
	// and don't have .noscroll class (so you can cancel this with that class)
	$('a[href^=#]:not(.noscroll)').on('click', function() {

		scroll_to_hash(this.hash);

	});

});
