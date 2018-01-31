(function( $ ) {

	$( document ).ready( function () {
		jQuery('#bustedcubicle_logo_image_button').click(function() {
			formfield = jQuery('#upload_image').attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});

		jQuery('.image_btn').click(function() {
			formfield = jQuery(this).prev('.image_text').attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});



		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#'+formfield).val(imgurl);
			tb_remove();
		}

	});

})( jQuery );