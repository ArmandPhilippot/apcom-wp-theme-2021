import getThemePreference from './get-theme-preference';

/**
 * Update the theme to use based on the preferred color scheme.
 */
const updateColorScheme = () => {
	const body = document.getElementById( 'body' );
	const preferredColorScheme = getThemePreference();

	if ( preferredColorScheme === 'dark' ) {
		body.setAttribute( 'data-color-scheme', 'dark' );
	} else {
		body.setAttribute( 'data-color-scheme', 'light' );
	}
};

export default updateColorScheme;
