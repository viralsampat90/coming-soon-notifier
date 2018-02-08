(function( $ ) {

	$( document ).ready( function () {
		/* jquery for upload coming soon logo using wp upoader*/
		$('#coming_soon_logo_image_button').click(function() {get_upload_fileds = $('#coming_soon_logo_image').attr('id');tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');return false;});
		/* jquery for upload coming soon bg image using wp upoader*/
		$('#coming_soon_notifier_bg_image_btn').click(function() {get_upload_fileds = $('#coming_soon_notifier_bg_image').attr('id');tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');return false;});
		window.send_to_editor = function(html) {imgurl = $('img',html).attr('src');$('#'+get_upload_fileds).val(imgurl);tb_remove();}

		var csn_enable_disable = $("#coming_soon_notifier_enable_disable");
		var csn_tr_block = $('tr.csn-form-row');
		var csn_bg_option = $("input[name=coming_soon_notifier_bg_option]");
		var csn_bg_color_option = $('tr.csn-block-bg-color');
		var csn_bg_image_option = $('tr.csn-block-bg-image');
		var csn_clock_enable_disable = $('#coming_soon_notifier_clock_enable_disable');
		var csn_clock_option = $('tr.csn-clock-block');
		var csn_notification_enable_disable = $('#coming_soon_notifier_notification_enable_disable');
		var csn_notification_option = $('tr.csn-notification-block');

		csn_enable_disable.on( 'change', function() {
			// Get the value of checked radio button.
			var value = $( 'input#coming_soon_notifier_enable_disable:checked' ).val();
			if( 'on' === value ) {
				csn_tr_block.show();
				csn_bg_option.trigger("change");
				csn_clock_enable_disable.trigger("change");
				csn_notification_enable_disable.trigger("change");
			} else{
				csn_tr_block.hide();
			}
		} ).change();

		csn_bg_option.on( 'change', function() {
			var global_value = $( 'input#coming_soon_notifier_enable_disable:checked' ).val();
			// Get the value of checked radio button.
			var value = $( 'input[name=coming_soon_notifier_bg_option]:checked' ).val();
			if( 'on' === global_value && 'bg_color' === value ) {
				csn_bg_color_option.show();
				csn_bg_image_option.hide();
			} else if( 'on' === global_value && 'bg_image' === value  ) {
				csn_bg_image_option.show();
				csn_bg_color_option.hide();
			} else{
				csn_bg_image_option.hide();
				csn_bg_color_option.hide();
			}
		} ).change();

		csn_clock_enable_disable.on( 'change', function() {
			var global_value = $( 'input#coming_soon_notifier_enable_disable:checked' ).val();
			// Get the value of checked radio button.
			var value = $( '#coming_soon_notifier_clock_enable_disable:checked' ).val();
			if( 'on' === global_value && 'on' === value ) {
				csn_clock_option.show();
			} else{
				csn_clock_option.hide();
			}
		} ).change();

		csn_notification_enable_disable.on( 'change', function() {
			var global_value = $( 'input#coming_soon_notifier_enable_disable:checked' ).val();
			// Get the value of checked radio button.
			var value = $( '#coming_soon_notifier_notification_enable_disable:checked' ).val();
			if( 'on' === global_value && 'on' === value ) {
				csn_notification_option.show();
			} else{
				csn_notification_option.hide();
			}
		} ).change();

		$('body').on('click','#csn_preview',function(){
			var get_csn_title = $('input[name=coming_soon_notifier_title]').val();
			var get_csn_discription = $('textarea[name=coming_soon_notifier_discription]').val();
			var get_csn_logo_image = $('input[name=coming_soon_logo_image]').val();
			var get_csn_bg_option = $('input[name=coming_soon_notifier_bg_option]:checked').val();
			var get_csn_bg_color = $('input[name=coming_soon_notifier_bg_color]').val();
			var get_csn_bg_image = $('input[name=coming_soon_notifier_bg_image]').val();
			var get_csn_clock_option = $('input[name=coming_soon_notifier_clock_enable_disable]:checked').val();
			var get_csn_clock_date = $('input[name=coming_soon_notifier_clock_date]').val();
			var get_csn_clock_theme = $('input[name=coming_soon_notifier_clock_theme]:checked').val();
			var get_csn_notification_option = $('input[name=coming_soon_notifier_notification_enable_disable]:checked').val();
			var get_csn_notification_btn_title = $('input[name=coming_soon_notifier_notification_btn_title]').val();
			var get_csn_notification_bg_color = $('input[name=coming_soon_notifier_notification_bg_color]').val();
			var get_csn_notification_text_color = $('input[name=coming_soon_notifier_notification_text_color]').val();

			var data = {
				'action': 'csn_preview_action',
				'get_csn_title': get_csn_title,
				'get_csn_discription': get_csn_discription,
				'get_csn_logo_image': get_csn_logo_image,
				'get_csn_bg_option': get_csn_bg_option,
				'get_csn_bg_color': get_csn_bg_color,
				'get_csn_bg_image': get_csn_bg_image,
				'get_csn_clock_option': get_csn_clock_option,
				'get_csn_clock_date': get_csn_clock_date,
				'get_csn_clock_theme': get_csn_clock_theme,
				'get_csn_notification_option': get_csn_notification_option,
				'get_csn_notification_btn_title': get_csn_notification_btn_title,
				'get_csn_notification_bg_color': get_csn_notification_bg_color,
				'get_csn_notification_text_color': get_csn_notification_text_color,
			};

			// We can also pass the url value separately from ajaxurl for front end AJAX implementations
			jQuery.post(ajaxurl, data, function(response) {
				$(".cs-notifier-preview_section").html(response);
			});

		});

	});
})( jQuery );