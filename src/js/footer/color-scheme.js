/* global color_scheme_vars */
import getThemePreference from '../utils/get-theme-preference';
import updateColorScheme from '../utils/update-color-scheme';

/**
 * Get the light theme icon to display on dark theme.
 *
 * @return {HTMLElement} An svg icon.
 */
function getLightThemeIcon() {
	const sunIcon = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
	sunIcon.setAttribute( 'viewBox', '0 0 100 100' );
	sunIcon.setAttribute( 'aria-hidden', 'true' );
	sunIcon.classList.add( 'btn__icon', 'btn__icon--sun' );
	sunIcon.innerHTML =
	'<path d="M70 50a20 20 0 01-20 20 20 20 0 01-20-20 20 20 0 0120-20 20 20 0 0120 20zm28.557 1.16c2.74.07 1.192 12.435-1.48 11.819l-16.03-3.7c-2.67-.616-1.676-8.604 1.064-8.535zM79.931 89.565c1.695 2.156-9.31 8.877-10.44 6.38l-6.776-14.991c-1.13-2.499 5.358-6.48 7.051-4.324zM38.26 99.068c-.603 2.675-12.753-1.73-11.521-4.18l7.39-14.698c1.231-2.45 8.353.156 7.75 2.83zM4.81 72.51C2.362 73.741-1.81 61.508.864 60.905l16.049-3.619c2.674-.603 5.046 6.602 2.597 7.834zm-.02-43.073C2.34 28.205 9.394 17.36 11.47 19.15l12.465 10.737c2.077 1.79-1.997 8.172-4.448 6.94zm33.425-26.59C37.612.171 50.497-1.118 50.43 1.623l-.408 16.446c-.068 2.74-7.585 3.5-8.189.825zm41.655 9.446c1.686-2.163 10.761 7.085 8.598 8.77L75.49 31.172c-2.164 1.685-7.415-3.739-5.73-5.902zm18.686 38.419c2.74-.068 1.201 12.848-1.47 12.231l-16.029-3.7c-2.671-.616-1.687-8.056 1.053-8.124z"/>';

	return sunIcon;
}

/**
 * Get the dark theme icon to display on light theme.
 *
 * @return {HTMLElement} An svg icon.
 */
function getDarkThemeIcon() {
	const moonIcon = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
	moonIcon.setAttribute( 'viewBox', '0 0 100 100' );
	moonIcon.setAttribute( 'aria-hidden', 'true' );
	moonIcon.classList.add( 'btn__icon', 'btn__icon--moon' );
	moonIcon.innerHTML =
		'<path d="M51.283 0A45.12 45.12 0 0173.95 39.135a45.12 45.12 0 01-45.12 45.12 45.12 45.12 0 01-25.09-7.618A50.133 50.133 0 0046.126 100 50.133 50.133 0 0096.26 49.867 50.133 50.133 0 0051.283 0z"/>';

	return moonIcon;
}

/**
 * Get the light theme label to display on dark theme.
 *
 * @return {HTMLElement} A span containing label text.
 */
function getDarkThemeLabel() {
	const span = document.createElement( 'span' );
	const label = color_scheme_vars.lightThemeText;

	span.innerHTML = label;
	span.classList.add( 'btn__body', 'btn__body--light', 'screen-reader-text' );

	return span;
}

/**
 * Get the dark theme label to display on light theme.
 *
 * @return {HTMLElement} A span containing label text.
 */
function getLightThemeLabel() {
	const span = document.createElement( 'span' );
	const label = color_scheme_vars.darkThemeText;

	span.innerHTML = label;
	span.classList.add( 'btn__body', 'btn__body--dark', 'screen-reader-text' );

	return span;
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
 * Update the preferred color scheme in local storage.
 *
 * @param {string} preference A color scheme, either `light` or `dark`.
 */
function updateThemePreference( preference ) {
	localStorage.setItem( 'apcom-color-scheme', preference );
}

/**
 * Define the preferred color scheme based on local storage or browser settings.
 */
function defineThemePreference() {
	let colorScheme = '';

	if ( getThemePreference() ) {
		colorScheme = getThemePreference();
	} else if ( prefersDarkScheme() ) {
		colorScheme = 'dark';
	} else {
		colorScheme = 'light';
	}

	updateThemePreference( colorScheme );
}

/**
 * Switch the theme based on the current color scheme and update stored
 * preference.
 */
function switchColorScheme() {
	const body = document.getElementById( 'body' );

	if ( body.getAttribute( 'data-color-scheme' ) === 'light' ) {
		updateThemePreference( 'dark' );
	} else if ( body.getAttribute( 'data-color-scheme' ) === 'dark' ) {
		updateThemePreference( 'light' );
	}

	updateColorScheme();
}

/**
 * Create a button to switch between color schemes.
 */
function createSwitchThemeButton() {
	const preferredColorScheme = getThemePreference();
	const toolbar = document.getElementById( 'toolbar' );
	const switchButton = document.createElement( 'button' );
	let switchButtonIcon = '';
	let switchButtonLabel = '';

	if ( preferredColorScheme === 'dark' ) {
		switchButtonLabel = getLightThemeLabel();
		switchButtonIcon = getLightThemeIcon();
	} else {
		switchButtonLabel = getDarkThemeLabel();
		switchButtonIcon = getDarkThemeIcon();
	}

	switchButton.id = 'switch-theme';
	switchButton.classList.add( 'toolbar__item', 'btn', 'btn--round' );
	switchButton.title = color_scheme_vars.title;
	switchButton.type = 'button';
	switchButton.appendChild( switchButtonLabel );
	switchButton.appendChild( switchButtonIcon );

	toolbar.insertBefore( switchButton, toolbar.firstChild );
}

/**
 * Update the button content when user switch theme.
 */
function updateSwitchThemeButton() {
	const preferredColorScheme = getThemePreference();
	const toggleButton = document.getElementById( 'switch-theme' );
	let switchButtonIcon = '';
	let switchButtonLabel = '';

	toggleButton.innerHTML = '';

	if ( preferredColorScheme === 'dark' ) {
		switchButtonLabel = getLightThemeLabel();
		switchButtonIcon = getLightThemeIcon();
	} else {
		switchButtonLabel = getDarkThemeLabel();
		switchButtonIcon = getDarkThemeIcon();
	}

	toggleButton.appendChild( switchButtonLabel );
	toggleButton.appendChild( switchButtonIcon );
}

/**
 * Initialize the theme to use based on user preferences.
 */
function initializeColorScheme() {
	defineThemePreference();
	createSwitchThemeButton();
	updateColorScheme();
}

/**
 * Apply the theme to all tabs.
 */
function syncColorSchemeBetweenTabs() {
	const body = document.getElementById( 'body' );

	body.addEventListener( 'storage', ( e ) => {
		if ( e.key === 'apcom-color-scheme' ) {
			updateColorScheme();
			updateSwitchThemeButton();
		}
	} );
}

initializeColorScheme();
syncColorSchemeBetweenTabs();

document.getElementById( 'switch-theme' ).addEventListener( 'click', () => {
	switchColorScheme();
	updateSwitchThemeButton();
} );
