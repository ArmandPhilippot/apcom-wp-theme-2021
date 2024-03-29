/* eslint-disable @wordpress/no-global-event-listener */
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
function hideSearch( target ) {
	const toolSearch = document.getElementById( 'toolbar__search' );
	const searchCheckbox = document.getElementById( 'search__checkbox' );

	if ( ! toolSearch.contains( target ) && target !== null ) {
		searchCheckbox.checked = false;
	}
}

/**
 * Create an Intersection Observer to observe visibility of element objects.
 *
 * @param {*} element  An array of elements or a single HTMLElement.
 * @param {*} callback A function which is called when the targeted element is visible.
 */
function createVisibilityObserver( element, callback ) {
	const options = {};

	const intersectionCallback = ( entries ) => {
		entries.forEach( ( entry ) => {
			callback( entry.intersectionRatio > 0 );
		} );
	};

	const observer = new IntersectionObserver( intersectionCallback, options );

	observer.observe( element );
}

/**
 * Call the Intersection Observer to prevent or allow scrolling.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 */
function observeDisplayChange( element ) {
	createVisibilityObserver( element, ( visible ) => {
		const viewportWidth = getViewportWidth();
		if ( visible && viewportWidth < 1280 ) {
			document.body.style.overflow = 'hidden';
		} else {
			document.body.style.removeProperty( 'overflow' );
		}
	} );
}

function giveFieldFocus( checkbox, field ) {
	if ( ! checkbox.checked ) {
		return;
	}

	field.focus();
}

/**
 * Handle visibility and overflow with event listeners.
 */
function initSearch() {
	const toolSearch = document.getElementById( 'toolbar__search' );
	const label = toolSearch.querySelector( '.toolbar__btn' );
	const checkbox = document.getElementById( 'search__checkbox' );
	const field = toolSearch.querySelector( '.form__field' );
	const searchForm = toolSearch.getElementsByClassName( 'form--search' )[ 0 ];

	window.addEventListener( 'load', () => {
		observeDisplayChange( searchForm );
	} );

	window.addEventListener( 'resize', () => {
		observeDisplayChange( searchForm );
	} );

	document.body.addEventListener( 'click', ( event ) => {
		hideSearch( event.target );
	} );

	document.body.addEventListener( 'focusout', ( event ) => {
		hideSearch( event.relatedTarget );
	} );

	label.addEventListener( 'click', () => giveFieldFocus( checkbox, field ) );

	checkbox.addEventListener( 'click', () => giveFieldFocus( checkbox, field ) );
}

initSearch();
