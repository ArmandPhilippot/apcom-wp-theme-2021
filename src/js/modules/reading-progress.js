import { readingProgress } from '../vendors/reading-progress';

/**
 * Init the reading progress bar depending on the current page.
 */
function initReadingProgress() {
	const html = document;
	const article = document.querySelector( '.page--is-article' );

	if ( article ) {
		const APComScrollBar = new readingProgress( 'page__content' );

		html.addEventListener( 'scroll', () => {
			APComScrollBar.init();
		} );
	}
}

initReadingProgress();
