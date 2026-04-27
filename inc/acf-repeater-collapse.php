<?php
add_action('acf/input/admin_head', 'my_acf_repeater_collapse');
function my_acf_repeater_collapse() {
	?>
	<style id="acf-repeater-collapse">
		.acf-repeater .acf-table { display: none; }
	</style>
	<script type="text/javascript">
		jQuery(function($) {
			$('.acf-repeater .acf-row').addClass('-collapsed');
			$('#acf-repeater-collapse').detach();
		});
	</script>
	<?php
}
