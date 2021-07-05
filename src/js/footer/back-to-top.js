/**
 * showBackToTopOnScroll
 *
 * Determine scroll position to display or not the back to top link.
 */
function showBackToTopOnScroll() {
	const backToTop = document.getElementById('back-to-top');
	const scrollPosition = window.scrollY;
	if (scrollPosition < '300') {
		backToTop.style.display = 'none';
	} else {
		backToTop.style.display = 'block';
		backToTop.style.animation = 'fadeIn 1s';
	}
}

/**
 * Init the back to top button
 *
 * Hide the button by default then listen for scroll.
 */
function initBackToTopButton() {
	const html = document;
	const backToTop = document.getElementById('back-to-top');
	backToTop.style.display = 'none';
	html.addEventListener('scroll', () => showBackToTopOnScroll());
}

initBackToTopButton();
