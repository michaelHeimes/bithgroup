/**
 * hasScrolled ES Module
 * @param {number} threshold - Pixels to scroll before adding class
 */
export default function hasScrolled(threshold = 50) {
	const body = document.body;
	let ticking = false;

	const updateClass = () => {
		const scrollPos = window.scrollY || window.pageYOffset;

		if (scrollPos > threshold) {
			if (!body.classList.contains('has-scrolled')) {
				body.classList.add('has-scrolled');
			}
		} else {
			if (body.classList.contains('has-scrolled')) {
				body.classList.remove('has-scrolled');
			}
		}
		ticking = false;
	};

	const onEvent = () => {
		if (!ticking) {
			window.requestAnimationFrame(updateClass);
			ticking = true;
		}
	};

	// Listen for both scroll and resize
	window.addEventListener('scroll', onEvent, { passive: true });
	window.addEventListener('resize', onEvent, { passive: true });

	// Initial check
	updateClass();
}
