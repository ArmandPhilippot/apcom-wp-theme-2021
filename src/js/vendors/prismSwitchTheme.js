/* global prism_vars */
/* global Prism */
/**
 * Add to the Prism toolbar a button to switch between dark and light theme.
 */
Prism.plugins.toolbar.registerButton( 'switch-theme', function() {
	/**
	 * Get button text.
	 *
	 * @param {string} theme The theme name. Either "light" or "dark".
	 * @return {HTMLElement} A span containing button text.
	 */
	function getButtonTxt( theme ) {
		const span = document.createElement( 'span' );
		const buttonTxt = document.createElement( 'span' );
		span.classList.add( 'prism__label' );
		buttonTxt.classList.add( 'btn__body', 'screen-reader-text' );

		if ( theme === 'light' ) {
			buttonTxt.innerHTML = prism_vars.lightThemeText;
			buttonTxt.classList.add( 'btn__body--light' );
		} else if ( theme === 'dark' ) {
			buttonTxt.innerHTML = prism_vars.darkThemeText;
			buttonTxt.classList.add( 'btn__body--dark' );
		}

		return buttonTxt;
	}

	/**
	 * Get the right SVG icon depending on color scheme.
	 *
	 * @param {string} theme The color scheme name. Either "dark" or "light".
	 * @return {HTMLElement} The SVG icon.
	 */
	function getIcon( theme ) {
		const icon = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
		icon.setAttribute( 'viewBox', '0 0 100 100' );
		icon.setAttribute( 'aria-hidden', 'true' );
		icon.classList.add( 'btn__icon' );

		if ( theme === 'light' ) {
			icon.innerHTML = '<path d="M51.283 0A45.12 45.12 0 0 1 73.95 39.135a45.12 45.12 0 0 1-45.12 45.12 45.12 45.12 0 0 1-25.09-7.618A50.133 50.133 0 0 0 46.126 100 50.133 50.133 0 0 0 96.26 49.867 50.133 50.133 0 0 0 51.283 0z"/>';
			icon.classList.add( 'btn__icon--light' );
		} else if ( theme === 'dark' ) {
			icon.innerHTML = '<path d="M70 50a20 20 0 0 1-20 20 20 20 0 0 1-20-20 20 20 0 0 1 20-20 20 20 0 0 1 20 20zm28.557 1.16c2.74.07 1.192 12.435-1.48 11.819l-16.03-3.7c-2.67-.616-1.676-8.604 1.064-8.535zM79.931 89.565c1.695 2.156-9.31 8.877-10.44 6.38l-6.776-14.991c-1.13-2.499 5.358-6.48 7.051-4.324zM38.26 99.068c-.603 2.675-12.753-1.73-11.521-4.18l7.39-14.698c1.231-2.45 8.353.156 7.75 2.83zM4.81 72.51C2.362 73.741-1.81 61.508.864 60.905l16.049-3.619c2.674-.603 5.046 6.602 2.597 7.834zm-.02-43.073C2.34 28.205 9.394 17.36 11.47 19.15l12.465 10.737c2.077 1.79-1.997 8.172-4.448 6.94zm33.425-26.59C37.612.171 50.497-1.118 50.43 1.623l-.408 16.446c-.068 2.74-7.585 3.5-8.189.825zm41.655 9.446c1.686-2.163 10.761 7.085 8.598 8.77L75.49 31.172c-2.164 1.685-7.415-3.739-5.73-5.902zm18.686 38.419c2.74-.068 1.201 12.848-1.47 12.231l-16.029-3.7c-2.671-.616-1.687-8.056 1.053-8.124z"/>';
			icon.classList.add( 'btn__icon--dark' );
		}

		return icon;
	}

	/**
	 * Set the preferred color scheme in local storage.
	 *
	 * @param {string} preference A color scheme, either `light` or `dark`.
	 */
	function setPreference( preference ) {
		localStorage.setItem( 'apcom-code-theme', preference );
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
		return false;
	}

	/**
	 * Define the preferred color scheme based on local storage or browser
	 * settings.
	 */
	function initializePreference() {
		let colorScheme = '';

		if ( prefersDarkScheme() ) {
			colorScheme = 'dark';
		} else {
			colorScheme = 'light';
		}

		setPreference( colorScheme );
	}

	/**
	 * Get the preferred color scheme defined in local storage.
	 *
	 * @return {string} The color scheme name.
	 */
	function getPreference() {
		if ( ! localStorage.getItem( 'apcom-code-theme' ) ) {
			initializePreference();
		}

		return localStorage.getItem( 'apcom-code-theme' );
	}

	/**
	 * Update the theme to use based on the preferred color scheme.
	 */
	function updateTheme() {
		const codeBlocks = document.getElementsByClassName( 'code-toolbar' );
		const preferredColorScheme = getPreference();

		for ( let i = 0; i < codeBlocks.length; i++ ) {
			if ( preferredColorScheme === 'dark' ) {
				codeBlocks[ i ].setAttribute( 'data-theme', 'dark' );
			} else {
				codeBlocks[ i ].setAttribute( 'data-theme', 'light' );
			}
		}
	}

	/**
	 * Update buttons content according to the current theme.
	 */
	function updateButtons() {
		const buttons = document.querySelectorAll( '.prism__btn' );
		const colorScheme = getPreference();
		const icon = getIcon( colorScheme );
		const txt = getButtonTxt( colorScheme );

		for ( let i = 0; i < buttons.length; i++ ) {
			buttons[ i ].innerHTML = '';
			buttons[ i ].appendChild( txt.cloneNode( true ) );
			buttons[ i ].appendChild( icon.cloneNode( true ) );
		}
	}

	/**
	 * Apply the theme to all tabs.
	 */
	function syncThemeBetweenTabs() {
		// eslint-disable-next-line @wordpress/no-global-event-listener -- It is not a React file.
		window.addEventListener( 'storage', ( e ) => {
			if ( e.key === 'apcom-code-theme' ) {
				updateTheme();
				updateButtons();
			}
		} );
	}

	/**
	 * Switch the theme based on the current color scheme and update stored
	 * preference.
	 */
	function switchTheme() {
		let preference = getPreference();
		preference = preference === 'light' ? 'dark' : 'light';

		setPreference( preference );
		updateTheme();
		updateButtons();
		syncThemeBetweenTabs();
	}

	/**
	 * Create the switch theme button.
	 *
	 * @return {HTMLElement} The button.
	 */
	function createButton() {
		const button = document.createElement( 'button' );
		const colorScheme = getPreference();
		const icon = getIcon( colorScheme );
		const txt = getButtonTxt( colorScheme );

		button.classList.add( 'prism__btn', 'btn', 'btn--round' );
		button.type = 'button';
		button.title = prism_vars.title;
		button.appendChild( txt );
		button.appendChild( icon );

		return button;
	}

	const switchButton = createButton();
	switchButton.addEventListener( 'click', () => {
		switchTheme();
	} );

	return switchButton;
} );
