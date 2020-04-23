(function($) { // Avoid conflicts with other libraries

'use strict';

$(function() {

	$('#contact_field_icon').on('keyup blur', function() {
		var input = $(this).val();
		var $icon = $(this).next('i');
		$icon.attr('class', 'icon fa-fw fa-' + input);
	});

});

$(function () {

	$('#field_is_contact').change(function () {
		$('#contact_field_icon').parent().toggle(this.checked);
		$('#contact_field_icon').parent().prev().toggle(this.checked);
		$('#contact_field_icon_bgcolor').toggle(this.checked);
	}).change(); //ensure visibility state matches the checkbox state initially

});

})(jQuery); // Avoid conflicts with other libraries
