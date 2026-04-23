export default function scrollToAnchor() {
	const offset = 0;
	
	// Scroll on page load
	const hash = window.location.hash;
	if (hash) {
		const target = document.querySelector(hash);
		if (target) {
		const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
		window.scrollTo({ top: targetPosition, behavior: 'smooth' });
		}
	}
	
	// Smooth scroll on click
	document.querySelectorAll('a[href*="#"]:not([href="#"])').forEach(link => {
		link.addEventListener('click', e => {
		const targetId = link.hash.slice(1);
		const target = document.getElementById(targetId);
	
		if (target) {
			e.preventDefault();
			const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
			window.scrollTo({ top: targetPosition, behavior: 'smooth' });
			history.pushState(null, null, `#${targetId}`);
		}
		});
	});
}