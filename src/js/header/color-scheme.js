/**
 * Get preferred color scheme from local storage.
 */
function getThemePreference() {
	if (localStorage.getItem('apcom-color-scheme')) {
		return localStorage.getItem('apcom-color-scheme');
	}
}

/**
 * Update the theme to use based on the preferred color scheme.
 */
function updateColorScheme() {
	let body = document.getElementById('body');
	let preferredColorScheme = getThemePreference();

	if (preferredColorScheme === 'dark') {
		body.setAttribute('data-color-scheme', 'dark');
	} else {
		body.setAttribute('data-color-scheme', 'light');
	}
}

/**
 * Use an observer to detect the existence of body tag.
 */
const observer = new MutationObserver(() => {
	if (document.body) {
		updateColorScheme();
		observer.disconnect();
	}
});

getThemePreference();
observer.observe(document.documentElement, { childList: true });
