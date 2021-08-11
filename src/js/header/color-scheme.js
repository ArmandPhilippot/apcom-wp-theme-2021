import getThemePreference from '../utils/get-theme-preference';
import updateColorScheme from '../utils/update-color-scheme';

/**
 * Use an observer to detect the existence of body tag.
 */
const observer = new MutationObserver( () => {
	if ( document.body ) {
		updateColorScheme();
		observer.disconnect();
	}
} );

getThemePreference();
observer.observe( document.documentElement, { childList: true } );
