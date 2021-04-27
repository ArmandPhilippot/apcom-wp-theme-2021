/**
 * Check if the diff between two dates is longer than two years.
 *
 * @param {Int} firstDate A date in milliseconds.
 * @param {Int} secondDate A date in milliseconds.
 * @returns {Bool} True if the diff is greater than two years.
 */
const isMoreThanTwoYears = (firstDate, secondDate) => {
	const diffInMilliseconds =
		firstDate > secondDate
			? firstDate - secondDate
			: secondDate - firstDate;
	const diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);
	const twoYears = 365 * 2;

	return diffInDays > twoYears;
};

/**
 * Insert a new HTML element above the page content.
 *
 * @param {HTMLElement} node An HTML element to insert.
 */
const insertBeforeContent = node => {
	const pageContent = document.getElementById('page__content');
	const firstChild = pageContent.firstChild;
	pageContent.insertBefore(node, firstChild);
};

/**
 * Check if the current page is an article.
 * @returns {Bool} True if it is an article.
 */
const isArticle = () => {
	const body = document.getElementById('body');
	return (
		body.classList.contains('single-page') &&
		!body.classList.contains('cpt') &&
		!body.classList.contains('no-comments')
	);
};

/**
 * Get warning message.
 * @returns {String} The translated warning message.
 */
const getWarning = () => {
	return (
		date_warning.beAware +
		' ' +
		date_warning.oldContent +
		' ' +
		date_warning.noMoreValid +
		' ' +
		date_warning.contentEvolved
	);
};

/**
 * Get the publication date of an article.
 * @returns {Mixed} Date element or null.
 */
const getPublicationDate = () => {
	const publicationDateWrapper = document.getElementById(
		'meta__publication-date'
	);

	return publicationDateWrapper
		? new Date(publicationDateWrapper.dateTime).getTime()
		: null;
};

/**
 * Get the update date of an article.
 * @returns {Mixed} Date element or null
 */
const getUpdateDate = () => {
	const updateDateWrapper = document.getElementById('meta__update-date');

	return updateDateWrapper
		? new Date(updateDateWrapper.dateTime).getTime()
		: null;
};

/**
 * Display a warning if an article is not updated since more than two years.
 */
const displayWarningIfNeeded = () => {
	if (isArticle()) {
		const publicationDate = getPublicationDate();
		const updateDate = getUpdateDate();
		const currentDate = new Date().getTime();

		if (
			!publicationDate ||
			!isMoreThanTwoYears(publicationDate, currentDate)
		)
			return;

		if (updateDate && !isMoreThanTwoYears(publicationDate, updateDate))
			return;

		const div = document.createElement('div');
		div.classList.add('content-warning');
		div.innerHTML = getWarning();

		insertBeforeContent(div);
	}
};

displayWarningIfNeeded();
