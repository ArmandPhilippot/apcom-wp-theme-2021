const body = document.getElementById('body');
const toolSearch = document.getElementById('tools__search');
const searchForm = toolSearch.getElementsByClassName('search-form')[ 0 ];
let viewportWidth;

/**
 * Get the viewport width based on the window width.
 *
 * @return {number} The window inner width.
 */
function getViewportWidth() {
	return window.innerWidth;
}

/**
 * Hide search input when user click outside or focus move outside search form.
 *
 * @param {*} target Event target
 */
function hideSearch(target) {
	const searchCheckbox = document.getElementById('search__checkbox');

	if (! toolSearch.contains(target) && target !== null) {
		searchCheckbox.checked = false;
	}
}

/**
 * Disable body scroll
 */
function preventScrolling() {
	body.style.overflow = 'hidden';
}

/**
 * Allow body scroll
 */
function allowScrolling() {
	document.body.style.removeProperty('overflow');
}

/**
 * Create an Intersection Observer to observe visibility of element objects.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 * @param {*} callback A function which is called when the targeted element is visible.
 */
function createVisibilityObserver(element, callback) {
	const options = {};

	const intersectionCallback = (entries) => {
		entries.forEach((entry) => {
			callback(entry.intersectionRatio > 0);
		});
	};

	const observer = new IntersectionObserver(intersectionCallback, options);

	observer.observe(element);
}

/**
 * Call the Intersection Observer to prevent or allow scrolling.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 */
function observeDisplayChange(element) {
	viewportWidth = getViewportWidth();

	createVisibilityObserver(element, (visible) => {
		if (visible && viewportWidth < 1280) {
			preventScrolling();
		} else {
			allowScrolling();
		}
	});
}

body.addEventListener(
	'load',
	() => {
		observeDisplayChange(searchForm);
	},
	false
);

body.addEventListener('resize', () => {
	viewportWidth = getViewportWidth();
	observeDisplayChange(searchForm);
});

body.addEventListener('click', (event) => {
	hideSearch(event.target);
});

body.addEventListener('focusout', (event) => {
	hideSearch(event.relatedTarget);
});
