/**
 * swiperOneArrowDots ES Module
 * Swiper for sliders like Testimonials
 */
import Swiper from 'swiper';
import { Navigation, Pagination, Scrollbar } from 'swiper/modules';

export default function swiperOneArrowDots() {
	const sliders = document.querySelectorAll('.swiper-1-arrow-dots');

	sliders.forEach((slider) => {
		const nextEl = slider.querySelector('.swiper-button-next');
		const prevEl = slider.querySelector('.swiper-button-prev');
		const paginationEl = slider.querySelector('.swiper-pagination');
		const scrollbarEl = slider.querySelector('.swiper-scrollbar');

		new Swiper(slider, {
			modules: [Navigation, Pagination, Scrollbar],
			slidesPerView: 1,
			spaceBetween: 20,
			loop: true,
			speed: 1000,
			grabCursor: true,
			
			scrollbar: {
				el: scrollbarEl,
				draggable: true,
			},
			
			navigation: {
				nextEl: nextEl,
				prevEl: prevEl,
			},
			
			pagination: {
				el: paginationEl,
				clickable: true,
			},

			breakpoints: {
				0: {
					navigation: { enabled: false },
					pagination: { enabled: false },
					scrollbar: { enabled: true }
				},
				1000: {
					navigation: { enabled: true },
					pagination: { enabled: true },
					scrollbar: { enabled: false }
				}
			}
		});
	});
}

