let toolSearch = document.getElementById('tools__search');
let searchForm = toolSearch.getElementsByClassName('search-form')[0];
let viewportWidth;

/**
 * Get the viewport width based on the window width.
 *
 * @returns {number} The window inner width.
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
	let searchCheckbox = document.getElementById('search__checkbox');

	if (!toolSearch.contains(target) && target !== null) {
		searchCheckbox.checked = false;
	}
}

/**
 * Disable body scroll
 */
function preventScrolling() {
	let body = document.body;
	let bodyWith = body.offsetWidth;
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
	let options = {};

	let intersectionCallback = entries => {
		entries.forEach(entry => {
			callback(entry.intersectionRatio > 0);
		});
	};

	let observer = new IntersectionObserver(intersectionCallback, options);

	observer.observe(element);
}

/**
 * Call the Intersection Observer to prevent or allow scrolling.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 */
function observeDisplayChange(element) {
	viewportWidth = getViewportWidth();

	createVisibilityObserver(element, visible => {
		if (visible && viewportWidth < 1280) {
			preventScrolling();
		} else {
			allowScrolling();
		}
	});
}

window.addEventListener(
	'load',
	() => {
		observeDisplayChange(searchForm);
	},
	false
);

window.addEventListener('resize', () => {
	viewportWidth = getViewportWidth();
	observeDisplayChange(searchForm);
});

document.addEventListener('click', event => {
	hideSearch(event.target);
});

document.addEventListener('focusout', event => {
	hideSearch(event.relatedTarget);
});
