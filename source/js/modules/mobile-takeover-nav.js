import $ from 'jquery';

export default function mobileTakeoverNav() {
	$(document).on('click', 'a#menu-toggle', function() {
		const $this = $(this);
		if ($this.hasClass('clicked')) {
		$this.removeClass('clicked');
		$('#off-canvas').fadeOut(200);
		} else {
		$this.addClass('clicked');
		$('#off-canvas').fadeIn(200);
		}
	});
}