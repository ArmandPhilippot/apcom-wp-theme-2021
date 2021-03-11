let backToTop = document.getElementById('back-to-top');
backToTop.style.display = 'none';

/**
 * showBackToTopOnScroll
 *
 * Determine scroll position to display or not the back to top link.
 */
function showBackToTopOnScroll() {
	let scrollPosition = window.scrollY;
	if (scrollPosition < '300') {
		backToTop.style.display = 'none';
	} else {
		backToTop.style.display = 'block';
		backToTop.style.animation = 'fadeIn 1s';
	}
}

window.addEventListener('scroll', () => showBackToTopOnScroll());
