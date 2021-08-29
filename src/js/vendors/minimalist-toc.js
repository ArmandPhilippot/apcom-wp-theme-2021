/**
 * Minimalist ToC
 *
 * A minimalist table of contents in Javascript.
 *
 * @author Armand Philippot <contact@armandphilippot.com>
 */

/**
 * Convert a text into a slug or id.
 * https://gist.github.com/codeguy/6684588#gistcomment-3332719
 *
 * @param {string} text Text to slugify.
 */
const slugify = ( text ) => {
	return text
		.toString()
		.normalize( 'NFD' )
		.replace( /[\u0300-\u036f]/g, '' )
		.toLowerCase()
		.trim()
		.replace( /\s+/g, '-' )
		.replace( /[^\w\-]+/g, '-' )
		.replace( /\-\-+/g, '-' )
		.replace( /^-|-$/g, '' );
};

export class TableOfContent {
	constructor() {
		this.source = '';
		this.target = '';
		this.options = {
			headings: [ 'h2', 'h3', 'h4', 'h5', 'h6' ],
			title: 'Table of contents',
			titleTag: 'h2',
			listType: 'ol',
		};
	}

	setSource( source ) {
		if ( source && typeof source === 'string' ) {
			this.source = document.getElementById( source );
		}
	}

	setTarget( target ) {
		if ( target && typeof target === 'string' ) {
			this.target = document.getElementById( target );
		}
	}

	setOptions( options ) {
		if ( options ) {
			if ( options.headings && options.headings instanceof Array ) {
				this.options.headings = options.headings;
			}
			if ( options.title && typeof options.title === 'string' ) {
				this.options.title = options.title;
			}
			if ( options.titleTag && typeof options.titleTag === 'string' ) {
				this.options.titleTag = options.titleTag;
			}
			if ( options.listType && typeof options.listType === 'string' ) {
				this.options.listType = options.listType;
			}
		}
	}

	getHeadingList() {
		const allTitles = this.source.querySelectorAll( this.options.headings );
		const titlesWithoutLinks = [ ...allTitles ].filter(
			( title ) =>
				! title.firstElementChild ||
				'A' !== title.firstElementChild.tagName
		);

		return titlesWithoutLinks;
	}

	createTitleMarkup() {
		return (
			'<' +
			this.options.titleTag +
			' id="toc-title">' +
			this.options.title +
			'</' +
			this.options.titleTag +
			'>'
		);
	}

	startListNode() {
		return '<' + this.options.listType + '>';
	}

	endListNode() {
		return '</' + this.options.listType + '>';
	}

	determineLevel( currentHeading ) {
		return this.options.headings.indexOf( currentHeading );
	}

	calculateLevelDiff( currentLevel, previousLevel ) {
		return currentLevel - previousLevel;
	}

	addSlug( heading ) {
		heading.id = heading.id ? heading.id : slugify( heading.innerText );
		return heading.id;
	}

	createTocMarkup() {
		let levelDiff;
		const headingList = this.getHeadingList();
		let i = 0;
		let markup = '';
		let currentLevel;
		let previousLevel = currentLevel;

		markup += '<nav class="widget toc" aria-labelledby="toc-title">';
		markup += this.createTitleMarkup();
		markup += this.startListNode();

		for ( i; i < headingList.length; i++ ) {
			currentLevel = this.determineLevel( headingList[ i ].localName );
			levelDiff = this.calculateLevelDiff( currentLevel, previousLevel );

			if ( levelDiff < 0 ) {
				while ( levelDiff < 0 ) {
					markup += this.endListNode();
					levelDiff++;
				}
			} else if ( levelDiff > 0 ) {
				while ( levelDiff > 0 ) {
					markup += this.startListNode();
					levelDiff--;
				}
			}

			if ( i !== 0 ) {
				markup += '</li>';
			}

			markup += '<li>';
			markup +=
					'<a href="#' +
					this.addSlug( headingList[ i ] ) +
					'">' +
					headingList[ i ].innerText +
					'</a>';

			previousLevel = currentLevel;
		}
		markup += '</li>';
		markup += this.endListNode();
		markup += '</nav>';

		return markup;
	}

	printToc() {
		const headingList = this.getHeadingList();
		if ( headingList.length > 0 ) {
			this.target.innerHTML = this.createTocMarkup();
		}
	}

	/**
	 * Initialize the table of content.
	 *
	 * Options list :
	 * - headings: an array of headings to retrieve. Default : `['h2', 'h3', 'h4', 'h5', 'h6']`
	 * - title: the title to print before the table of contents. Default: `Table of contents`.
	 * - titleTag: the title tag. Default: `h2`.
	 * - listType: the list type (`ul` or `ol`). Default: `ol`.
	 *
	 * @param {string} source  The container id to look for headings.
	 * @param {string} target  The container id to display the table of content.
	 * @param {Object} options Options.
	 */
	init( source, target, options ) {
		this.setSource( source );
		this.setTarget( target );
		this.setOptions( options );
		if ( this.source && this.target ) {
			this.printToc();
		}
	}
}
