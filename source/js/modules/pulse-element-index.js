/**
 * pulseElementIndex ES Module
 * Finds all .pulse elements and applies positioning styles to their parent <section>
 */
export default function pulseElementIndex() {

	const pulseElements = document.querySelectorAll('.pulse');

	pulseElements.forEach(element => {
		const parentSection = element.closest('section');

		if (parentSection) {
			parentSection.style.position = 'relative';
			parentSection.style.zIndex = '1';
		}
	});

}