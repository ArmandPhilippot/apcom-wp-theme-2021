/**
 * Add to the Prism toolbar a button to switch between dark and light theme.
 */
Prism.plugins.toolbar.registerButton('switch-theme', function (env) {
	let button = document.createElement('button');
	let lightSpan = document.createElement('span');
	let darkSpan = document.createElement('span');
	let lightSpanTxt = document.createElement('span');
	let lightSpanIcon = document.createElement('span');
	let darkSpanTxt = document.createElement('span');
	let darkSpanIcon = document.createElement('span');
	let lightThemeTxt = prism_vars.lightThemeText;
	let darkThemeTxt = prism_vars.darkThemeText;

	button.classList.add('prism-theme__btn');

	lightSpanTxt.innerHTML = lightThemeTxt;
	lightSpanIcon.innerHTML =
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.269 26.458"><path d="M19.367 19.367C15.452 26.148 6.781 28.472 0 24.557 13.45 22.312 18.583 14.404 14.178 0c6.78 3.915 9.104 12.586 5.19 19.367z"/></svg>';
	darkSpanTxt.innerHTML = darkThemeTxt;
	darkSpanIcon.innerHTML =
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><g transform="translate(-65.398 -135.997)"><path d="M165.395 185.258c-.093-2.636-1.995-5.44-4.545-6.11a6.522 6.522 0 00-6.848 2.368c-1.595 2.102-2.027 3.578-1.178 6.076.85 2.497 3.03 4.097 5.65 4.4a6.522 6.522 0 004.8-1.37c1.355-1.073 2.184-3.636 2.121-5.364zm-14.366 35.823c1.876-1.855 2.642-5.44 1.306-7.715a6.52 6.52 0 00-6.523-3.159c-2.611.361-4.059 1.104-5.195 3.483-1.139 2.38-.635 4.929.93 7.051 1.027 1.393 2.69 2.216 4.411 2.393 1.72.176 3.842-.836 5.071-2.053zm-35.364 14.916c2.638.026 5.747-1.967 6.414-4.519a6.522 6.522 0 00-2.373-6.848c-2.103-1.592-3.612-2.088-6.105-1.227-2.493.861-3.952 3.026-4.366 5.63-.271 1.71.313 3.462 1.396 4.811 1.083 1.349 3.305 2.133 5.034 2.153zm-35.499-14.529c1.845 1.886 5.445 2.684 7.721 1.352 2.276-1.333 3.575-3.75 3.344-6.378-.232-2.628-1.244-4.186-3.616-5.34-2.373-1.153-4.928-.66-7.063.888-1.4 1.016-2.23 2.672-2.418 4.391-.188 1.72.822 3.85 2.032 5.087zM65.4 186.071c-.029 2.637 1.938 5.748 4.49 6.416 2.553.666 5.185-.125 6.88-2.145 1.694-2.022 2.094-3.839 1.232-6.333-.862-2.494-3.009-3.95-5.614-4.366-1.708-.27-3.471.312-4.82 1.394-1.348 1.083-2.15 3.304-2.168 5.034zm14.653-35.44c-1.886 1.845-2.705 5.426-1.371 7.703 1.333 2.277 3.758 3.581 6.385 3.35 2.628-.23 4.206-1.223 5.36-3.595 1.153-2.371.67-4.913-.879-7.049-1.016-1.4-2.677-2.237-4.397-2.426-1.72-.187-3.862.809-5.098 2.018zm35.474-14.633c-2.637-.04-5.772 1.919-6.44 4.47-.668 2.553.119 5.189 2.138 6.887 2.02 1.699 3.812 2.1 6.31 1.252 2.498-.849 3.962-2.996 4.393-5.598.283-1.706-.292-3.467-1.366-4.824-1.075-1.355-3.305-2.162-5.035-2.187zm35.335 14.771c-1.855-1.875-5.39-2.702-7.664-1.367-2.275 1.334-3.58 3.775-3.343 6.402.238 2.627 1.218 4.256 3.599 5.394 2.38 1.14 4.887.67 7.01-.895 1.392-1.026 2.236-2.706 2.411-4.427.175-1.72-.797-3.878-2.013-5.106zm14.533 35.553c.039-2.638-1.893-5.774-4.445-6.444-2.552-.669-5.196.12-6.894 2.138-1.699 2.019-2.127 3.812-1.277 6.31.85 2.497 2.978 3.96 5.58 4.393 1.706.282 3.476-.291 4.833-1.365 1.354-1.075 2.177-3.303 2.203-5.032z"/><circle cx="115.398" cy="185.997" r="27.602"/></g></svg>';

	lightSpan.classList.add('prism-theme__label');
	lightSpanTxt.classList.add('prism-theme__txt', 'screen-reader-text');
	lightSpanIcon.classList.add(
		'prism-theme__icon',
		'prism-theme__icon--light'
	);
	darkSpan.classList.add('prism-theme__label');
	darkSpanTxt.classList.add('prism-theme__txt', 'screen-reader-text');
	darkSpanIcon.classList.add('prism-theme__icon', 'prism-theme__icon--dark');

	lightSpan.appendChild(lightSpanTxt);
	lightSpan.appendChild(lightSpanIcon);
	darkSpan.appendChild(darkSpanTxt);
	darkSpan.appendChild(darkSpanIcon);

	/**
	 * Detect if user prefers dark color scheme.
	 */
	function prefersDarkScheme() {
		if (
			window.matchMedia &&
			window.matchMedia('(prefers-color-scheme: dark)').matches
		) {
			return true;
		}
	}

	/**
	 * Get preferred color scheme from local storage.
	 */
	function getPreference() {
		if (localStorage.getItem('apcom-code-theme')) {
			return localStorage.getItem('apcom-code-theme');
		}
	}

	/**
	 * Update the preferred color scheme in local storage.
	 * @param {string} preference A color scheme, either `light` or `dark`.
	 */
	function updatePreference(preference) {
		localStorage.setItem('apcom-code-theme', preference);
	}

	/**
	 * Define the preferred color scheme based on local storage or browser settings.
	 */
	function definePreference() {
		let colorScheme = '';

		if (getPreference()) {
			colorScheme = getPreference();
		} else if (prefersDarkScheme()) {
			colorScheme = 'dark';
		} else {
			colorScheme = 'light';
		}

		updatePreference(colorScheme);
	}

	/**
	 * Update the theme to use based on the preferred color scheme.
	 */
	function updateTheme() {
		let codeBlocks = document.getElementsByClassName('code-toolbar');
		let preferredColorScheme = getPreference();

		for (let i = 0; i < codeBlocks.length; i++) {
			if (preferredColorScheme === 'dark') {
				codeBlocks[i].setAttribute('data-theme', 'dark');
			} else {
				codeBlocks[i].setAttribute('data-theme', 'light');
			}
		}
	}

	/**
	 * Define the button content based on the preferred color scheme.
	 */
	function defineButtonContent() {
		let colorScheme = getPreference();

		if (colorScheme === 'dark') {
			if (button.hasChildNodes()) {
				button.replaceChild(darkSpan, lightSpan);
			} else {
				button.appendChild(darkSpan);
			}
		} else {
			if (button.hasChildNodes()) {
				button.replaceChild(lightSpan, darkSpan);
			} else {
				button.appendChild(lightSpan);
			}
		}
	}

	/**
	 * Update the button content according to the current theme.
	 */
	function updateButtonContent() {
		let codeBlocksButton = document.querySelectorAll('.prism-theme__btn');
		let colorScheme = getPreference();

		for (let i = 0; i < codeBlocksButton.length; i++) {
			let buttonClone = '';

			if (colorScheme === 'dark') {
				buttonClone = darkSpan.cloneNode(true);
				codeBlocksButton[i].innerHTML = '';
				codeBlocksButton[i].appendChild(buttonClone);
			} else {
				buttonClone = lightSpan.cloneNode(true);
				codeBlocksButton[i].innerHTML = '';
				codeBlocksButton[i].appendChild(buttonClone);
			}
		}
	}

	/**
	 * Initialize the theme to use based on user preferences.
	 */
	function initializeTheme() {
		definePreference();
		defineButtonContent();
		updateTheme();
	}

	/**
	 * Switch the theme based on the current color scheme and update stored
	 * preference.
	 */
	function switchTheme() {
		let codeToolbar = env.element.parentNode.parentNode;

		if (codeToolbar.getAttribute('data-theme') === 'light') {
			updatePreference('dark');
		} else if (codeToolbar.getAttribute('data-theme') === 'dark') {
			updatePreference('light');
		}

		updateTheme();
	}

	/**
	 * Apply the theme to all tabs.
	 */
	function syncThemeBetweenTabs() {
		window.addEventListener('storage', e => {
			if (e.key === 'apcom-code-theme') {
				updateTheme();
				updateButtonContent();
			}
		});
	}

	initializeTheme();
	syncThemeBetweenTabs();

	button.addEventListener('click', () => {
		switchTheme();
		updateButtonContent();
	});

	return button;
});
