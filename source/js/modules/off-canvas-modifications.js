import $ from 'jquery';

export default function offCanvasModifications() {
  const target = document.getElementById('off-canvas');
  if (!target) return;

  // 1. Existing MutationObserver Logic
  const observer = new MutationObserver((mutations) => {
	mutations.forEach((mutation) => {
	  if (mutation.attributeName === 'class') {
		const isOpen = target.classList.contains('is-open');
		document.body.classList.toggle('is-off-canvas-open', isOpen);
	  }
	});
  });

  observer.observe(target, { attributes: true });

  let resizeTimer;
	window.addEventListener('resize', () => {
	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(() => {
		if (window.innerWidth > 900 && target.classList.contains('is-open')) {
		  
		  $(target).foundation('close');
  
		}
	  }, 100);
	});
}
