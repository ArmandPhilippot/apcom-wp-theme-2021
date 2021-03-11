/**
 * hideSearch
 *
 * Hide search input when user click outside or focus move outside search form.
 *
 * @param {*} target Event target
 */
function hideSearch(target) {
	let menuItemSearch = document.getElementById('tools__search');
	let searchCheckbox = document.getElementById('search__checkbox');

	if (!menuItemSearch.contains(target) && target !== null) {
		searchCheckbox.checked = false;
	}
}

document.addEventListener('click', event => {
	hideSearch(event.target);
});

document.addEventListener('focusout', event => {
	hideSearch(event.relatedTarget);
});
