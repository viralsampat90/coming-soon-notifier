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
		<form method="post" action="<?php echo get_admin_url();?>admin-post.php" enctype="multipart/form-data" novalidate="novalidate">
			<input type="hidden" name="action" value="coming_soon_setting_form_settings">
			<input type="hidden" name="action_type" value="add">
			<table class="form-table coming-soon-notifier-form-table">
				<tbody>
				<tr class="coming-soon-notifier-form-main-row">
					<th scope="row"><?php echo __('Enable/Disable','coming-soon-notifier'); ?></th>
					<td>
						<input type="checkbox" name="coming_soon_notifier_enable_disable" class="regular-text">
						<p class="description"><?php echo __('','coming-soon-notifier'); ?></p>
					</td>
				</tr>
				<tr class="coming-soon-notifier-form-row">
					<th scope="row"><?php echo __('Choose Post Types','coming-soon-notifier'); ?></th>
					<td>
						<?php
						// Get all post types array.
						$post_types_array = return_post_types_names();
						?>
						<select class="custom-post-types-selection" name="custom_post_types[]" multiple="multiple">
							<?php
							if( !empty( $post_types_array ) && sizeof( $post_types_array ) > 0 ) {
								foreach ( $post_types_array as $post_types_array_value ) { ?>
									<option value="<?php echo $post_types_array_value; ?>"><?php echo $post_types_array_value; ?></option>
								<?php }
							}
							?>
						</select>
						<p class="description"><?php echo __('Choose Which Post Types You Want To Display','idea-point'); ?></p>
					</td>
				</tr>
				<tr class="coming-soon-notifier-form-main-row">
					<th scope="row"><?php echo __('Coming Soon Title','coming-soon-notifier'); ?></th>
					<td>
						<input type="text" name="coming_soon_notifier_title" class="regular-text">
						<p class="description"><?php echo __('Enter the title you want to display','coming-soon-notifier'); ?></p>
					</td>
				</tr>
				<tr class="coming-soon-notifier-form-main-row">
					<th scope="row"><?php echo __('Coming Soon LOGO image','coming-soon-notifier'); ?></th>
					<td>
						<input name="bustedcubicle_logo_image" id="bustedcubicle_logo_image" type="text" value="" class="image_text">
						<input type="button" name="bustedcubicle_logo_image_button" id="bustedcubicle_logo_image_button" value="Upload Logo Image" class="image_btn button button-primary image_upload">
						<p class="description"><?php echo __('Select LOGO image','coming-soon-notifier'); ?></p>
					</td>
				</tr>
				<tr class="coming-soon-notifier-form-main-row">
					<th scope="row"><?php echo __('Coming Soon Background','coming-soon-notifier'); ?></th>
					<td>
						<input type="radio" id="background"
						       name="bg_option" value="bg_image" checked>
						<label for="background">Background Image</label>
						<input type="radio" id="background"
						       name="bg_option" value="bg_color">
						<label for="background">Background Color</label>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>