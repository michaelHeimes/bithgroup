import Swiper from 'swiper';
import { Scrollbar, Navigation } from 'swiper/modules';

/**
 * Initialize Swiper 3-2-1 Sliders
 * Mobile: 1 slide | >640px: 2 slides | >1024px: 3 slides
 */
export const init321Sliders = () => {
	const sliderContainers = document.querySelectorAll('.swiper-3-2-1');

	sliderContainers.forEach((container) => {
		new Swiper(container, {
			modules: [Scrollbar], // Ensure this is present
			slidesPerView: 1,
			spaceBetween: 12,
			scrollbar: {
				el: container.querySelector('.swiper-scrollbar'),
				draggable: false,
				hide: false, // Ensure it doesn't auto-hide
			},
			breakpoints: {
				640: { slidesPerView: 2, spaceBetween: 30 },
				1024: { slidesPerView: 3, spaceBetween: 30 },
			},
		});
	});
	
};

// Auto-init if preferred, or export to your main entry file
document.addEventListener('DOMContentLoaded', init321Sliders);
