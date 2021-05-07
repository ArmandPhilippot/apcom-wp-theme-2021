const html = document;
const backToTop = document.getElementById('back-to-top');
backToTop.style.display = 'none';

/**
 * showBackToTopOnScroll
 *
 * Determine scroll position to display or not the back to top link.
 */
function showBackToTopOnScroll() {
	const scrollPosition = window.scrollY;
	if (scrollPosition < '300') {
		backToTop.style.display = 'none';
	} else {
		backToTop.style.display = 'block';
		backToTop.style.animation = 'fadeIn 1s';
	}
}

html.addEventListener('scroll', () => showBackToTopOnScroll());
