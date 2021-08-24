/**
 * Reading progress
 *
 * Represents a progress bar to indicate reading progression based on scroll position.
 *
 * @license MIT <https://opensource.org/licenses/MIT>
 * @author Armand Philippot <https://www.armandphilippot.com>
 */
class readingProgress {
	/**
	 * Define the progress bar container.
	 *
	 * @param {string} containerId Id of the container.
	 */
	constructor( containerId ) {
		this.container = containerId
			? document.getElementById( containerId )
			: '';
		this.progressBarWrapper = document.createElement( 'div' );
		this.progressBar = document.createElement( 'div' );
	}

	/**
	 * Define the progress bar classes.
	 *
	 * @param {Array} barClasses - One or more classes for the progress bar.
	 */
	setProgressBarClasses( barClasses ) {
		if ( barClasses ) {
			barClasses.forEach( ( className ) => {
				this.progressBar.classList.add( className );
			} );
		} else {
			this.progressBar.classList.add( 'reading-progress__bar' );
		}
	}

	/**
	 * Define the progress bar wrapper classes.
	 *
	 * @param {Array} wrapperClasses - One or more classes for the progress bar wrapper.
	 */
	setProgressBarWrapperClasses( wrapperClasses ) {
		if ( wrapperClasses ) {
			wrapperClasses.forEach( ( className ) => {
				this.progressBarWrapper.classList.add( className );
			} );
		} else {
			this.progressBarWrapper.classList.add( 'reading-progress' );
		}
	}

	/**
	 * Insert the progress bar inside the container.
	 *
	 * @param {string} position - The progress bar position: `top` or `bottom` of its container.
	 */
	insertReadingProgressBar( position ) {
		this.progressBar.style.height = '100%';
		this.progressBar.style.maxWidth = '100%';

		this.progressBarWrapper.appendChild( this.progressBar );
		this.progressBarWrapper.style.position = 'sticky';

		if ( position === 'bottom' ) {
			this.container.appendChild( this.progressBarWrapper );
			this.progressBarWrapper.style.bottom = '0';
		} else {
			if ( ! this.container ) {
				return;
			}
			const containerFirstChild = this.container.firstChild;
			this.container.insertBefore(
				this.progressBarWrapper,
				containerFirstChild
			);
			this.progressBarWrapper.style.top = '0';
		}
	}

	/**
	 * Display or not the progress bar.
	 *
	 * @param {boolean} bool - True of false.
	 */
	showProgressBar( bool ) {
		if ( bool === true ) {
			this.progressBarWrapper.style.display = 'block';
		} else {
			this.progressBarWrapper.style.display = 'none';
		}
	}

	/**
	 * Calculate the distance traveled as a percentage without unit.
	 *
	 * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
	 * @return {number} A percentage without unit.
	 */
	getScrollPercent( recordFrom ) {
		let target = '';

		if ( recordFrom === 'body' ) {
			target = document.body;
		} else if (
			typeof recordFrom === 'string' &&
			recordFrom !== 'container'
		) {
			target = document.getElementById( recordFrom );
		} else {
			target = this.container;
		}

		if ( ! target ) {
			return;
		}

		const windowHeight = window.innerHeight;
		const windowTop = window.scrollY;
		const targetHeight = target.offsetHeight;
		const targetTop = target.offsetTop;
		const scrollPercent =
			( ( windowTop - targetTop ) / ( targetHeight - windowHeight ) ) * 100;

		return scrollPercent;
	}

	/**
	 * Use the distance traveled as progressBar width.
	 *
	 * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
	 */
	recordProgression( recordFrom ) {
		const scrollPercent = this.getScrollPercent( recordFrom );
		if ( scrollPercent > 1 && scrollPercent <= 100 ) {
			this.showProgressBar( true );
		} else {
			this.showProgressBar( false );
		}
		this.progressBar.style.width = scrollPercent + '%';
	}

	/**
	 * Initialize the reading progress bar.
	 *
	 * @param {Array}  wrapperClasses - One or more classes for the progress bar wrapper. Default: `['reading-progress']`.
	 * @param {Array}  barClasses     - One or more classes for the progress bar. Default `['reading-progress__bar']`.
	 * @param {string} position       - The progress bar position: `top` or `bottom` of its container. Default: `top`.
	 * @param {string} recordFrom     - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID. Default `container`.
	 */
	init(
		wrapperClasses = [ 'reading-progress' ],
		barClasses = [ 'reading-progress__bar' ],
		position = 'top',
		recordFrom = 'container'
	) {
		if ( this.container !== '' ) {
			this.setProgressBarWrapperClasses( wrapperClasses );
			this.setProgressBarClasses( barClasses );
			this.insertReadingProgressBar( position );
			this.recordProgression( recordFrom );
		}
	}
}

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
