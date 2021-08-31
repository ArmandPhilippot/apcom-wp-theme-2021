/**
 * Add an attribute to body element to define current theme.
 */
const setBodyTheme = () => {
	if ( ! localStorage.getItem( 'apcom-color-scheme' ) ) {
		return;
	}

	const body = document.getElementById( 'body' );
	const colorScheme = localStorage.getItem( 'apcom-color-scheme' );

	body.setAttribute( 'data-color-scheme', colorScheme );
};

/**
 * Use an observer to detect the existence of body tag.
 */
const observer = new MutationObserver( () => {
	if ( document.body ) {
		setBodyTheme();
		observer.disconnect();
	}
} );

observer.observe( document.documentElement, { childList: true } );
