import $ from 'jquery';

export default function emptyParentLinks() {
	$('.menu li a[href="#"]').on('click', function(e) {
		e.preventDefault();
	});
}