(function( $ ) {
	$( document ).ready( function () {
		$('.input-color-fields').wpColorPicker();
		$('.custom-post-types-selection').select2();
		$('.input-date-fields').datepicker({dateFormat: 'dd-mm-yy'});
	} );
})( jQuery );