/**
 * Get preferred color scheme from local storage.
 */
const getThemePreference = () => {
	if ( localStorage.getItem( 'apcom-color-scheme' ) ) {
		return localStorage.getItem( 'apcom-color-scheme' );
	}
};

export default getThemePreference;
