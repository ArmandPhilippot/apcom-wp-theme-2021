/* global toc_args */
import { TableOfContent } from '../vendors/minimalist-toc';

const minimalistTOC = new TableOfContent();

const addClassToc = () => {
	const pageContent = document.getElementById( 'page__content' );

	if ( pageContent ) {
		pageContent.parentElement.classList.add( 'page--has-toc' );
	}
};

addClassToc();
minimalistTOC.init( 'page__content', 'table-of-content', {
	title: toc_args.tocTitle,
} );
