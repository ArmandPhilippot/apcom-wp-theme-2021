/**
 * Init Code Blocks by adding automatically some classes and attributes.
 *
 * These classes and attributes are needed by Prism or to customize comments.
 */
const body = document.getElementById('body');

function initCodeBlocks() {
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

body.addEventListener('DOMContentLoaded', initCodeBlocks());
