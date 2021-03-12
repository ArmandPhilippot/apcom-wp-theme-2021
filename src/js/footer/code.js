/**
 * Init Prism line numbers plugin by adding automatically the class.
 */
function addPrismClassesToCodeBlock() {
	let preTags = document.getElementsByTagName('pre');

	for (let i = 0; i < preTags.length; i++) {
		let preClasses = preTags[i].classList.length;

		for (let j = 0; j < preClasses; j++) {
			if (preTags[i].classList[j].startsWith('language')) {
				if (
					!preTags[i].classList.contains('command-line') &&
					!preTags[i].classList.contains('language-diff')
				) {
					preTags[i].classList.add('line-numbers');
				}
			}
		}
	}
}

document.addEventListener('DOMContentLoaded', () =>
	addPrismClassesToCodeBlock()
);
