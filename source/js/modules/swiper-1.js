import Swiper from 'swiper';
import { Scrollbar } from 'swiper/modules';

export default function init1Sliders() {
	const sliderContainers = document.querySelectorAll('.swiper-1');
	const breakpoint = window.matchMedia('(max-width: 639px)');

	sliderContainers.forEach((container) => {
		let swiperInstance = null;
		const wrapper = container.querySelector('.wrapper');
		const slides = wrapper.querySelectorAll('.slide-1');

		const manageSwiper = () => {
			if (breakpoint.matches) {
				console.log(swiperInstance );
				if (swiperInstance === null) {
					// 1. Prepare HTML for Swiper
					wrapper.classList.add('swiper-wrapper');
					slides.forEach(slide => slide.classList.add('swiper-slide'));

					// 2. Init Swiper
					swiperInstance = new Swiper(container, {
						modules: [Scrollbar],
						slidesPerView: 1,
						spaceBetween: 32,
						scrollbar: {
							el: container.querySelector('.swiper-scrollbar'),
							draggable: true,
						},
					});
				}
			} else {
				if (swiperInstance !== null) {
					// 1. Destroy Swiper
					swiperInstance.destroy(true, true);
					swiperInstance = null;
					
					// 2. Restore Foundation Grid
					wrapper.classList.remove('swiper-wrapper');
					slides.forEach(slide => slide.classList.remove('swiper-slide'));
					
				}
			}
		};

		manageSwiper();
		breakpoint.addEventListener('change', manageSwiper);
	});
}

