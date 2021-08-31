/* global color_scheme_vars */
/**
 * Get a sun icon as SVG element.
 *
 * @return {HTMLElement} An svg icon.
 */
function getSunIcon() {
	const sunIcon = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
	sunIcon.setAttribute( 'viewBox', '0 0 100 100' );
	sunIcon.setAttribute( 'aria-hidden', 'true' );
	sunIcon.classList.add( 'btn__icon', 'btn__icon--sun' );
	sunIcon.innerHTML = '<path d="M70 50a20 20 0 0 1-20 20 20 20 0 0 1-20-20 20 20 0 0 1 20-20 20 20 0 0 1 20 20zm28.557 1.16c2.74.07 1.192 12.435-1.48 11.819l-16.03-3.7c-2.67-.616-1.676-8.604 1.064-8.535zM79.931 89.565c1.695 2.156-9.31 8.877-10.44 6.38l-6.776-14.991c-1.13-2.499 5.358-6.48 7.051-4.324zM38.26 99.068c-.603 2.675-12.753-1.73-11.521-4.18l7.39-14.698c1.231-2.45 8.353.156 7.75 2.83zM4.81 72.51C2.362 73.741-1.81 61.508.864 60.905l16.049-3.619c2.674-.603 5.046 6.602 2.597 7.834zm-.02-43.073C2.34 28.205 9.394 17.36 11.47 19.15l12.465 10.737c2.077 1.79-1.997 8.172-4.448 6.94zm33.425-26.59C37.612.171 50.497-1.118 50.43 1.623l-.408 16.446c-.068 2.74-7.585 3.5-8.189.825zm41.655 9.446c1.686-2.163 10.761 7.085 8.598 8.77L75.49 31.172c-2.164 1.685-7.415-3.739-5.73-5.902zm18.686 38.419c2.74-.068 1.201 12.848-1.47 12.231l-16.029-3.7c-2.671-.616-1.687-8.056 1.053-8.124z"/>';

	return sunIcon;
}

/**
 * Get a moon icon as SVG element.
 *
 * @return {HTMLElement} An svg icon.
 */
function getMoonIcon() {
	const moonIcon = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
	moonIcon.setAttribute( 'viewBox', '0 0 100 100' );
	moonIcon.setAttribute( 'aria-hidden', 'true' );
	moonIcon.classList.add( 'btn__icon', 'btn__icon--moon' );
	moonIcon.innerHTML = '<path d="M51.283 0A45.12 45.12 0 0 1 73.95 39.135a45.12 45.12 0 0 1-45.12 45.12 45.12 45.12 0 0 1-25.09-7.618A50.133 50.133 0 0 0 46.126 100 50.133 50.133 0 0 0 96.26 49.867 50.133 50.133 0 0 0 51.283 0z"/>';

	return moonIcon;
}

/**
 * Get the button text container.
 *
 * @return {HTMLElement} The text container.
 */
function getButtonTextContainer() {
	const label = document.createElement( 'span' );
	label.classList.add( 'btn__body', 'btn__body--light', 'screen-reader-text' );
	return label;
}

/**
 * Detect if user prefers dark color scheme.
 *
 * @return {boolean} True if user prefers dark color scheme.
 */
function prefersDarkScheme() {
	if (
		window.matchMedia &&
		window.matchMedia( '(prefers-color-scheme: dark)' ).matches
	) {
		return true;
	}
}

/**
 * Save the preferred color scheme in local storage.
 *
 * @param {string} theme A color scheme, either `light` or `dark`.
 */
function saveThemePreference( theme ) {
	localStorage.setItem( 'apcom-color-scheme', theme );
}

/**
 * Get preferred color scheme from local storage.
 */
function getThemePreference() {
	if ( ! localStorage.getItem( 'apcom-color-scheme' ) ) {
		return;
	}
	return localStorage.getItem( 'apcom-color-scheme' );
}

/**
 * Define the preferred color scheme based on local storage or browser settings.
 */
function initThemePreference() {
	let colorScheme = '';

	if ( getThemePreference() ) {
		colorScheme = getThemePreference();
	} else if ( prefersDarkScheme() ) {
		colorScheme = 'dark';
	} else {
		colorScheme = 'light';
	}

	saveThemePreference( colorScheme );
}

/**
 * Add an attribute to body element to define current theme.
 *
 * @param {string} theme The theme name.
 */
function setBodyAttribute( theme ) {
	const body = document.getElementById( 'body' );
	body.setAttribute( 'data-color-scheme', theme );
}

/**
 * Define button icon and label.
 *
 * @param {HTMLElement} button A button element.
 * @param {string}      theme  The theme name.
 */
function setButtonContent( button, theme ) {
	let buttonIcon;
	const buttonLabel = getButtonTextContainer();

	button.innerHTML = '';

	if ( theme === 'dark' ) {
		buttonIcon = getSunIcon();
		buttonLabel.innerHTML = color_scheme_vars.darkThemeText;
	} else {
		buttonIcon = getMoonIcon();
		buttonLabel.innerHTML = color_scheme_vars.lightThemeText;
	}

	button.appendChild( buttonLabel );
	button.appendChild( buttonIcon );
}

/**
 * Add a button element to the toolbar.
 */
function createButton() {
	const toolbar = document.getElementById( 'toolbar' );
	const button = document.createElement( 'button' );

	button.id = 'switch-theme';
	button.classList.add( 'toolbar__item', 'btn', 'btn--round' );
	button.title = color_scheme_vars.title;
	button.type = 'button';

	toolbar.insertBefore( button, toolbar.firstChild );
}

/**
 * Update the button content based on a theme.
 *
 * @param {string} theme The theme name.
 */
function updateButton( theme ) {
	const button = document.getElementById( 'switch-theme' );

	setButtonContent( button, theme );
}

/**
 * Switch the theme based on the current color scheme and update stored
 * preference.
 */
function switchColorScheme() {
	const body = document.getElementById( 'body' );
	let preferredTheme;

	if ( body.getAttribute( 'data-color-scheme' ) === 'light' ) {
		preferredTheme = 'dark';
	} else if ( body.getAttribute( 'data-color-scheme' ) === 'dark' ) {
		preferredTheme = 'light';
	}

	saveThemePreference( preferredTheme );
	setBodyAttribute( preferredTheme );
	updateButton( preferredTheme );
}

/**
 * Apply the theme to all tabs.
 *
 * @param {string} theme The theme name.
 */
function syncThemeBetweenTabs( theme ) {
	const body = document.getElementById( 'body' );

	body.addEventListener( 'storage', ( e ) => {
		if ( e.key === 'apcom-color-scheme' ) {
			setBodyAttribute( theme );
			updateButton( theme );
		}
	} );
}

/**
 * Initialize the theme to use based on user preferences.
 */
function initTheme() {
	initThemePreference();

	const theme = getThemePreference();

	setBodyAttribute( theme );
	createButton();
	updateButton( theme );
	syncThemeBetweenTabs( theme );
}

initTheme();

document.getElementById( 'switch-theme' ).addEventListener( 'click', () => {
	switchColorScheme();
} );
