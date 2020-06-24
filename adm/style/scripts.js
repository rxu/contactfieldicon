(function($) { // Avoid conflicts with other libraries

'use strict';

$(function() {

	$('#contact_field_icon').on('keyup blur', function() {
		var input = $(this).val();
		var $icon = $(this).next('i');
		$icon.attr('class', 'icon fa-fw fa-' + input);
	});

});

$(function() {

	$('#field_is_contact').change(function () {
		$('#contact_field_icon_settings').toggle(this.checked);
	}).change(); //ensure visibility state matches the checkbox state initially

});

$(function() {
	var bgcolor = $('#contact_field_icon_bgcolor').val();
	$('#contact_field_icon_bgcolor').loads({
		appendToBody: true, // Required to work on jQuery event firing
		compactLayout: true,
		enableAlpha: false,
		enableSubmit: false,
		flat: false, // Required to work on jQuery event firing
		layout: 'hex',
		readonlyFields: true,
		variant: 'small',
		onBeforeShow: function(ev) {
			if (bgcolor !== '') {
				$(this).setColor(bgcolor);
				bgcolor = '';
			}
		},
		onChange: function(ev) {
			$('#contact_field_icon_demo').css({
				'color': '#' + ev.hex,
			});
			if (!ev.bySetColor) {
				$(ev.el).val(ev.hex);
			}
		},
	}).keyup(function() {
		$(this).setColor(this.value || '');
	});
});

})(jQuery); // Avoid conflicts with other libraries
