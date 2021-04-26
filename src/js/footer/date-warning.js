/**
 * Check if the diff between two dates is longer than one year.
 *
 * @param {Int} firstDate A date in milliseconds.
 * @param {Int} secondDate A date in milliseconds.
 * @returns {Bool} True if the diff is greater than one year.
 */
const isMoreThanOneYear = (firstDate, secondDate) => {
	const diffInMilliseconds =
		firstDate > secondDate
			? firstDate - secondDate
			: secondDate - firstDate;
	const diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

	return diffInDays > 365;
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

const handleDateWarnings = () => {
	const body = document.getElementById('body');

	if (
		body.classList.contains('single-page') &&
		!body.classList.contains('cpt')
	) {
		const publicationDateWrapper = document.getElementById(
			'meta__publication-date'
		);
		const updateDateWrapper = document.getElementById('meta__update-date');

		const publicationDate = publicationDateWrapper
			? new Date(publicationDateWrapper.dateTime).getTime()
			: null;
		const updateDate = updateDateWrapper
			? new Date(updateDateWrapper.dateTime).getTime()
			: null;
		const currentDate = new Date().getTime();

		if (!isMoreThanOneYear(publicationDate, currentDate)) {
			return;
		}

		if (!isMoreThanOneYear(publicationDate, updateDate)) {
			return;
		}

		const div = document.createElement('div');
		div.classList.add('content-warning');
		div.innerHTML =
			date_warning.beAware +
			' ' +
			date_warning.oldContent +
			' ' +
			date_warning.noMoreValid +
			' ' +
			date_warning.contentEvolved;

		insertBeforeContent(div);
	}
};

handleDateWarnings();
