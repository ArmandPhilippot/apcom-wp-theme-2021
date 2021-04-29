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
	let moonIcon =
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M51.283 0A45.12 45.12 0 0173.95 39.135a45.12 45.12 0 01-45.12 45.12 45.12 45.12 0 01-25.09-7.618A50.133 50.133 0 0046.126 100 50.133 50.133 0 0096.26 49.867 50.133 50.133 0 0051.283 0z"/></svg>';
	let sunIcon =
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M70 50a20 20 0 01-20 20 20 20 0 01-20-20 20 20 0 0120-20 20 20 0 0120 20zm28.557 1.16c2.74.07 1.192 12.435-1.48 11.819l-16.03-3.7c-2.67-.616-1.676-8.604 1.064-8.535zM79.931 89.565c1.695 2.156-9.31 8.877-10.44 6.38l-6.776-14.991c-1.13-2.499 5.358-6.48 7.051-4.324zM38.26 99.068c-.603 2.675-12.753-1.73-11.521-4.18l7.39-14.698c1.231-2.45 8.353.156 7.75 2.83zM4.81 72.51C2.362 73.741-1.81 61.508.864 60.905l16.049-3.619c2.674-.603 5.046 6.602 2.597 7.834zm-.02-43.073C2.34 28.205 9.394 17.36 11.47 19.15l12.465 10.737c2.077 1.79-1.997 8.172-4.448 6.94zm33.425-26.59C37.612.171 50.497-1.118 50.43 1.623l-.408 16.446c-.068 2.74-7.585 3.5-8.189.825zm41.655 9.446c1.686-2.163 10.761 7.085 8.598 8.77L75.49 31.172c-2.164 1.685-7.415-3.739-5.73-5.902zm18.686 38.419c2.74-.068 1.201 12.848-1.47 12.231l-16.029-3.7c-2.671-.616-1.687-8.056 1.053-8.124z"/></svg>';

	button.classList.add('prism-theme__btn');
	button.type = 'button';
	button.title = prism_vars.title;

	lightSpanTxt.innerHTML = lightThemeTxt;
	lightSpanIcon.innerHTML = moonIcon;
	darkSpanTxt.innerHTML = darkThemeTxt;
	darkSpanIcon.innerHTML = sunIcon;

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
