/**
 * headerHeight ES Module
 * Sets --header-height CSS variable on :root
 */
export default function headerHeight() {
	const root = document.documentElement;
	const header = document.querySelector('.site-header');
	let resizeTimer;

	if (!header) return;

	const setHeight = () => {
		const height = header.offsetHeight;
		root.style.setProperty('--header-height', `${height}px`);
	};

	const debouncedResize = () => {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(setHeight, 200);
	};

	// Listeners
	window.addEventListener('resize', debouncedResize);
	
	// Initial execution
	setHeight();
}
