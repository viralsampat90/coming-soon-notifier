<?php
/**
 * The admin-specific functionality of the plugin.
 *
 *  Define coming soon custom admin menu html content.
 *
 * @link  http://wpdevelopment.local
 * @since      1.0
 * @package    Coming_Soon_Notifier
 * @subpackage Coming_Soon_Notifier/admin
 * @author  Dhaval Parejia <http://wpdevelopment.local>
 */

?>
<div class="wrap coming-soon-wrap">
	<div class="coming-soon-header">
		<h1><?php echo __('Coming Soon Settings','coming-soon-notifier'); ?></h1>
	</div>
	<div class="coming-soon-contents">
		<div class="cs-notifier-setting-section">
			<form method="post" action="<?php echo get_admin_url();?>admin-post.php" enctype="multipart/form-data" novalidate="novalidate">
				<input type="hidden" name="action" value="coming_soon_setting_form_settings">
				<input type="hidden" name="action_type" value="add">
				<table class="form-table coming-soon-notifier-form-table">
					<tbody>
					<tr class="csn-form-main-row">
						<th scope="row"><?php echo __('Enable/Disable','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_enable_options = get_csn_options( 'enable_disable' ); ?>
							<input <?php echo ( 'on' === $get_enable_options ) ? 'checked':''; ?>  type="checkbox" name="coming_soon_notifier_enable_disable" id="coming_soon_notifier_enable_disable" class="regular-text input-rows">
							<p class="description"><?php echo __('','coming-soon-notifier'); ?></p>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Choose Post Types','coming-soon-notifier'); ?></th>
						<td>
							<?php
							$get_post_type = get_csn_options( 'post_type' );
							// Get all post types array.
							$post_types_array = return_post_types_names();
							?>
							<select class="custom-post-types-selection" name="custom_post_types[]" multiple="multiple">
								<?php
								if( !empty( $post_types_array ) && sizeof( $post_types_array ) > 0 ) {
									foreach ( $post_types_array as $post_types_array_value ) {
										if( in_array( $post_types_array_value, $get_post_type)) { ?>
											<option selected value="<?php echo $post_types_array_value; ?>"><?php echo $post_types_array_value; ?></option>
										<?php } else{	?>
											<option value="<?php echo $post_types_array_value; ?>"><?php echo $post_types_array_value; ?></option>
									<?php }
									}
								}
								?>
							</select>
							<p class="description"><?php echo __('Choose Which Post Types You Want To Display','idea-point'); ?></p>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Coming Soon Title','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_title = get_csn_options( 'title' ); ?>
							<input type="text" name="coming_soon_notifier_title" class="regular-text input-rows" value="<?php echo $get_csn_title; ?>">
							<p class="description"><?php echo __('Enter the title you want to display','coming-soon-notifier'); ?></p>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Coming Soon Description','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_discription = get_csn_options( 'discription' ); ?>
							<textarea name="coming_soon_notifier_discription" class="regular-text" rows="5"><?php echo $get_csn_discription; ?></textarea>
							<p class="description"><?php echo __('Enter the discription you want to display','coming-soon-notifier'); ?></p>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Coming Soon LOGO image','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_logo_image = get_csn_options( 'logo_image' ); ?>
							<input name="coming_soon_logo_image" id="coming_soon_logo_image" type="text" value="<?php echo $get_csn_logo_image; ?>" class="image_text regular-text input-rows disabled-default">
							<input type="button" name="coming_soon_logo_image_button" id="coming_soon_logo_image_button" value="Upload Logo" class="image_btn csn_btn_default image_upload">
							<p class="description"><?php echo __('Select LOGO image','coming-soon-notifier'); ?></p>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Coming Soon Background','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_logo_image = get_csn_options( 'bg_option' ); ?>
							<input type="radio" <?php echo ( 'bg_color' === $get_csn_logo_image ) ? 'checked' :''; ?> name="coming_soon_notifier_bg_option" value="bg_color" checked><label for="background">Background Color</label>
							<input type="radio" <?php echo ( 'bg_image' === $get_csn_logo_image ) ? 'checked' :''; ?> name="coming_soon_notifier_bg_option" value="bg_image" ><label for="background">Background Image</label>
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-block-bg-color">
						<th scope="row"><?php echo __('Coming Soon Background Color','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_bg_color = get_csn_options( 'bg_color' ); ?>
							<input type="text" class="input-color-fields input-rows" name="coming_soon_notifier_bg_color" value="<?php echo $get_csn_bg_color; ?>">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-block-bg-image">
						<th scope="row"><?php echo __('Coming Soon Background image','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_csn_bg_image = get_csn_options( 'bg_image' ); ?>
							<input type="text" class="disabled-default input-rows" id="coming_soon_notifier_bg_image" name="coming_soon_notifier_bg_image" value="<?php echo $get_csn_bg_image; ?>">
							<input type="button" name="coming_soon_notifier_bg_image_btn" id="coming_soon_notifier_bg_image_btn" class="csn_btn_default" value="Upload Background Image">
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Clock Enable/Disable','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_clock_enable_option = get_csn_options( 'clock_enable_option' ); ?>
							<input type="checkbox" <?php echo ( 'on' === $get_clock_enable_option ) ? 'checked':''; ?> class="" id="coming_soon_notifier_clock_enable_disable" name="coming_soon_notifier_clock_enable_disable">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-clock-block">
						<th scope="row"><?php echo __('Set Coming Date','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_clock_date = get_csn_options( 'clock_date' ); ?>
							<input type="text" value="<?php echo $get_clock_date; ?>" class="input-date-fields" id="coming_soon_notifier_clock_date" name="coming_soon_notifier_clock_date">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-clock-block">
						<th scope="row"><?php echo __('Select your clock Theme','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_clock_theme = get_csn_options( 'clock_theme' ); ?>
							<input type="radio" <?php echo ( "clock_theme_1" === $get_clock_theme ) ? 'checked': ''; ?> name="coming_soon_notifier_clock_theme" value="clock_theme_1" checked><label for="clock_theme">Theme 1</label>
							<input type="radio" <?php echo ( "clock_theme_2" === $get_clock_theme ) ? 'checked': ''; ?> name="coming_soon_notifier_clock_theme" value="clock_theme_2" ><label for="clock_theme">Theme 2</label>
							<input type="radio" <?php echo ( "clock_theme_3" === $get_clock_theme ) ? 'checked': ''; ?> name="coming_soon_notifier_clock_theme" value="clock_theme_3" ><label for="clock_theme">Theme 3</label>
							<input type="radio" <?php echo ( "clock_theme_4" === $get_clock_theme ) ? 'checked': ''; ?> name="coming_soon_notifier_clock_theme" value="clock_theme_4" ><label for="clock_theme">Theme 4</label>
						</td>
					</tr>
					<tr class="csn-form-row csn-block">
						<th scope="row"><?php echo __('Notification Enable/Disable','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_notification_enable_option = get_csn_options( 'notification_enable_option' ); ?>
							<input <?php echo ( "on" === $get_notification_enable_option ) ? 'checked' :''; ?> type="checkbox" class="" id="coming_soon_notifier_notification_enable_disable" name="coming_soon_notifier_notification_enable_disable">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-notification-block">
						<th scope="row"><?php echo __('Notification Button Title','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_notification_title = get_csn_options( 'notification_title' ); ?>
							<input type="text" class="input-rows" id="coming_soon_notifier_notification_btn_title" name="coming_soon_notifier_notification_btn_title" value="<?php echo $get_notification_title; ?>">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-notification-block">
						<th scope="row"><?php echo __('Notification Button bg color','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_notification_bg_color = get_csn_options( 'notification_bg_color' ); ?>
							<input type="text" class="input-rows input-color-fields" id="coming_soon_notifier_notification_bg_color" name="coming_soon_notifier_notification_bg_color" value="<?php echo $get_notification_bg_color; ?>">
						</td>
					</tr>
					<tr class="csn-form-row csn-block csn-notification-block">
						<th scope="row"><?php echo __('Notification Button Text color','coming-soon-notifier'); ?></th>
						<td>
							<?php $get_notification_text_color = get_csn_options( 'notification_text_color' ); ?>
							<input type="text" class="input-rows input-color-fields" id="coming_soon_notifier_notification_text_color" name="coming_soon_notifier_notification_text_color" value="<?php echo $get_notification_text_color; ?>">
						</td>
					</tr>
					</tbody>
				</table>
				<p class="submit">
					<input type="submit" name="csn_submit" id="csn_submit" class="csn_btn_default" value="Save Changes">
					<input type="button" name="csn_preview" id="csn_preview" class="csn_btn_default" value="Preview">
				</p>
			</form>
		</div>
		<div class="cs-notifier-preview_section"></div>
	</div>
</div>