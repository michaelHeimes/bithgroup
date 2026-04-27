import Swiper from 'swiper';
import { Scrollbar } from 'swiper/modules';

/**
 * Initialize Swiper 3-2-1 Sliders
 * Mobile: 1 slide | >640px: 2 slides | >1024px: 3 slides
 */
export default function init321Sliders() {
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
				1024: { slidesPerView: 3, spaceBetween: 48 },
			},
		});
	});
	
	if (window.acf) {
		// This fires every time the block is added or updated in the editor
		window.acf.addAction('render_block_preview/type=home-hero-img-services', function($block) {
			
			// Find the swiper container INSIDE this specific block instance
			const swiperElement = $block.find('.swiper-3-2-1').get(0);
	
			if (swiperElement) {
				new Swiper(swiperElement, {
					modules: [Scrollbar],
					slidesPerView: 1,
					spaceBetween: 12,
					scrollbar: {
						el: swiperElement.querySelector('.swiper-scrollbar'),
						draggable: false,
						hide: false,
					},
					breakpoints: {
						640: { slidesPerView: 2, spaceBetween: 30 },
						1024: { slidesPerView: 3, spaceBetween: 48 },
					},
				});
			}
		});
	}
	
};