
jQuery(function($){

	// When anything with data-toggle-class set is clicked
	$('body').on('click', '[data-toggle-class]', function() {

		// Get the class, or bail
		var state = $(this).data('toggle-class');
		if ( state.length < 1 ) {
			return false;
		}

		// Get the target, or set to element clicked
		var $target = $($(this).data('toggle-target'));
		if ( $target.length < 1 ) {
			var $target = $(this);
		}

		// Do the thing
		$target.toggleClass(state);

		// Don't do default thing
		return false;

	});

});


/* MARKUP EXAMPLES

** Toggle class on self
**
<p data-toggle-class="green">
	When this paragraph is clicked, the class "green" will be toggled on it.
	Maybe the CSS is .green { color: green; }
</p>

** Toggle class on another
** Clicking this anchor would toggle class "mobile-menu-active" on the html element.
** Helpful for mobile menus. Obviously.
**
<a href="#" data-toggle-class="mobile-menu-active" data-toggle-target="html">
	Menus
</a>

** Toggle class with form inputs
** This doesn't work yet.
**
<input type="radio" name="decision" value="Yes" data-toggle-class="active">

*/
