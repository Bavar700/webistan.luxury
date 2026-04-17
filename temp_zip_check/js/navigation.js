/**
 * File navigation.js.
 */
(function() {
	const container = document.getElementById( 'site-navigation' );
	if ( ! container ) return;

	const button = container.getElementsByClassName( 'menu-toggle' )[0];
	if ( 'undefined' === typeof button ) return;

	const menu = container.getElementsByTagName( 'ul' )[0];
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	button.addEventListener( 'click', function() {
		container.classList.toggle( 'toggled' );
		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
            menu.classList.add('hidden');
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
            menu.classList.remove('hidden');
            menu.classList.add('flex', 'flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-4', 'shadow-xl', 'space-y-4', 'border-t', 'border-gray-100');
		}
	} );
}());
