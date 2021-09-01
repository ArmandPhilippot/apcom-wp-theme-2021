/* global date_warning */

/**
 * Check if the diff between two dates is longer than two years.
 *
 * @param {number} firstDate  A date in milliseconds.
 * @param {number} secondDate A date in milliseconds.
 * @return {boolean} True if the diff is greater than two years.
 */
const isMoreThanTwoYears = ( firstDate, secondDate ) => {
	const diffInMilliseconds =
		firstDate > secondDate
			? firstDate - secondDate
			: secondDate - firstDate;
	const diffInDays = diffInMilliseconds / ( 1000 * 60 * 60 * 24 );
	const twoYears = 365 * 2;

	return diffInDays > twoYears;
};

/**
 * Insert a new HTML element above the page content.
 *
 * @param {HTMLElement} node An HTML element to insert.
 */
const insertBeforeContent = ( node ) => {
	const pageContent = document.getElementById( 'page__content' );
	const firstChild = pageContent.firstChild;
	pageContent.insertBefore( node, firstChild );
};

/**
 * Check if the current page is an article.
 *
 * @return {boolean} True if it is an article.
 */
const isArticle = () => {
	const page = document.querySelector( '.page' );

	return ! page.classList.contains( 'page--is-listing' );
};

/**
 * Get warning message.
 *
 * @return {string} The translated warning message.
 */
const getWarning = () => {
	return (
		date_warning.beAware +
		' ' +
		date_warning.oldContent +
		' ' +
		date_warning.contentEvolved
	);
};

/**
 * Get the publication date of an article.
 *
 * @return {Date} Date element or null.
 */
const getPublicationDate = () => {
	const publicationDateWrapper = document.getElementById(
		'meta__item--publication-date'
	);

	return publicationDateWrapper
		? new Date( publicationDateWrapper.dateTime ).getTime()
		: null;
};

/**
 * Get the update date of an article.
 *
 * @return {Date} Date element or null
 */
const getUpdateDate = () => {
	const updateDateWrapper = document.getElementById( 'meta__item--update-date' );

	return updateDateWrapper
		? new Date( updateDateWrapper.dateTime ).getTime()
		: null;
};

/**
 * Display a warning if an article is not updated since more than two years.
 */
const displayWarningIfNeeded = () => {
	if ( isArticle() ) {
		const publicationDate = getPublicationDate();
		const updateDate = getUpdateDate();
		const currentDate = new Date().getTime();

		if (
			! publicationDate ||
			! isMoreThanTwoYears( publicationDate, currentDate )
		) {
			return;
		}

		if ( updateDate && ! isMoreThanTwoYears( publicationDate, updateDate ) ) {
			return;
		}

		const div = document.createElement( 'div' );
		div.classList.add( 'modal', 'modal--warning' );
		div.innerHTML = getWarning();

		insertBeforeContent( div );
	}
};

displayWarningIfNeeded();
