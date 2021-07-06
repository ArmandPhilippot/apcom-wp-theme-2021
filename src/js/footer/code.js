/**
 * Add automatically some classes and attributes.
 *
 * These classes and attributes are needed by Prism or to customize comments.
 */
function setCodeBlocksClasses() {
	const preTags = document.getElementsByTagName('pre');

	for (let i = 0; i < preTags.length; i++) {
		const preClasses = preTags[ i ].classList.length;

		preTags[ i ].tabIndex = '0';

		for (let j = 0; j < preClasses; j++) {
			if (preTags[ i ].classList[ j ].startsWith('language')) {
				if (
					! preTags[ i ].classList.contains('command-line') &&
					! preTags[ i ].classList.contains('language-diff')
				) {
					preTags[ i ].classList.add('line-numbers');
				} else if (
					preTags[ i ].classList.contains('command-line') &&
					preTags[ i ].classList.contains('filter-output')
				) {
					preTags[ i ].setAttribute('data-filter-output', '#output#');
				}
			} else if (preTags[ i ].classList.contains('instructions')) {
				const codeTag = preTags[ i ].firstChild;
				const codeLines = codeTag.innerHTML.split(/[\n\r]/g);
				const codeLinesLength = codeLines.length;

				for (let k = 0; k < codeLinesLength; k++) {
					if (/^\/\//.test(codeLines[ k ])) {
						const colorizeComment =
							'<span class="token comment">' +
							codeLines[ k ] +
							'</span>';
						codeTag.innerHTML = codeTag.innerHTML.replace(
							codeLines[ k ],
							colorizeComment
						);
					}
				}
			}
		}
	}
}

/**
 * Translate the PrismJS Copy to clipboard button.
 */
function translateCopyButton() {
	const pageContent = document.getElementById('page__content');
	pageContent.setAttribute('data-prismjs-copy', 'Copier');
	pageContent.setAttribute('data-prismjs-copy-success', 'Copié !');
	pageContent.setAttribute('data-prismjs-copy-error', 'Utilisez Ctrl+c pour copier');
}

document.body.addEventListener('DOMContentLoaded', setCodeBlocksClasses());

translateCopyButton();
