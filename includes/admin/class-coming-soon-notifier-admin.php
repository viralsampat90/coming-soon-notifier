<?php
/**
 * The admin-specific functionality of the plugin.
 *
 *  Defines the plugin name, version, and two examples hooks for how to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link  http://wpdevelopment.local
 * @since      1.0
 * @package    Coming_Soon_Notifier
 * @subpackage Coming_Soon_Notifier/admin
 * @author  Dhaval Parejia <http://wpdevelopment.local>
 */

class Coming_Soon_Notifier_Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function __construct() {
		// Enqueue Script and Style for Admin.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu',array( $this, 'coming_soon_notifier_admin_menu_callback' )  );
		add_action( 'admin_post_coming_soon_setting_form_settings',array( $this, 'coming_soon_setting_form_settings_callback' ));
		add_action( 'admin_post_nopriv_coming_soon_setting_form_settings',array( $this, 'coming_soon_setting_form_settings_callback' ));
		add_action( 'add_meta_boxes', 'coming_soon_notifier_register_meta_boxes' );
	}

	/**
	 * function for register styles.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function enqueue_styles() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_style('coming-soon-notifier-jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
		wp_register_style( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/css/coming-soon-notifier-admin' . $suffix . '.css', array('wp-color-picker'), COMING_SOON_NOTIFIER_VERSION, 'all' );
		wp_register_style( COMING_SOON_NOTIFIER_SLUG.'-select2', COMING_SOON_NOTIFIER_URL . 'assets/css/select2.min.css', array(), COMING_SOON_NOTIFIER_VERSION, 'all' );

		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'coming-soon-notifier-jquery-ui' );
		wp_enqueue_style( COMING_SOON_NOTIFIER_SLUG.'-select2' );
		wp_enqueue_style( COMING_SOON_NOTIFIER_SLUG );
	}

	/**
	 * function for register scripts.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function enqueue_scripts() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_script( 'coming-soon-notifier-common', COMING_SOON_NOTIFIER_URL . 'assets/js/coming-soon-notifier-common' . $suffix . '.js', array( 'jquery' ), COMING_SOON_NOTIFIER_VERSION, false );
		wp_register_script( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/js/coming-soon-notifier-admin' . $suffix . '.js', array( 'jquery','jquery-ui-core','wp-color-picker','jquery-ui-datepicker' ), COMING_SOON_NOTIFIER_VERSION, false );
		wp_register_script( COMING_SOON_NOTIFIER_SLUG."-select2", COMING_SOON_NOTIFIER_URL . 'assets/js/select2.min.js', array( 'jquery' ), COMING_SOON_NOTIFIER_VERSION, false );

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script( COMING_SOON_NOTIFIER_SLUG.'-select2' );
		wp_enqueue_script( 'coming-soon-notifier-common' );
		wp_enqueue_script( COMING_SOON_NOTIFIER_SLUG );

	}

	/**
	 * function register coming soon custom admin menu.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function coming_soon_notifier_admin_menu_callback() {
		add_menu_page( 'coming-soon-settings',__('CS Settings','coming-soon-notifier'), 'manage_options','coming_soon_settings', 'coming_soon_settings_callback','dashicons-clock');

		function coming_soon_settings_callback() {
			include_once (COMING_SOON_NOTIFIER_DIR_PATH.'includes/admin/class-coming-soon-notifier-admin-content.php');
		}
	}

	/**
	 * function for save coming soon notifier store date.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function coming_soon_setting_form_settings_callback() {

		$csn_action = !empty( $_POST['action'] ) ? $_POST['action'] :'';
		$csn_action_type = !empty( $_POST['action_type'] ) ? $_POST['action_type'] :'';
		$csn_csn_submite = !empty( $_POST['csn_submit'] ) ? $_POST['csn_submit'] :'';

		if( "coming_soon_setting_form_settings" === $csn_action && "add" === $csn_action_type && "Save Changes" === $csn_csn_submite  ) {
			$csn_enable_disable = !empty( $_POST['coming_soon_notifier_enable_disable'] ) ? $_POST['coming_soon_notifier_enable_disable'] :'';
			$csn_custom_post_types = !empty( $_POST['custom_post_types'] ) ? $_POST['custom_post_types'] :'';
			$csn_title = !empty( $_POST['coming_soon_notifier_title'] ) ? $_POST['coming_soon_notifier_title'] :'';
			$csn_discription = !empty( $_POST['coming_soon_notifier_discription'] ) ? $_POST['coming_soon_notifier_discription'] :'';
			$csn_logo_image = !empty( $_POST['coming_soon_logo_image'] ) ? $_POST['coming_soon_logo_image'] :'';
			$csn_bg_option = !empty( $_POST['coming_soon_notifier_bg_option'] ) ? $_POST['coming_soon_notifier_bg_option'] :'';
			$csn_bg_color = !empty( $_POST['coming_soon_notifier_bg_color'] ) ? $_POST['coming_soon_notifier_bg_color'] :'';
			$csn_bg_image = !empty( $_POST['coming_soon_notifier_bg_image'] ) ? $_POST['coming_soon_notifier_bg_image'] :'';
			$csn_clock_enable_disable = !empty( $_POST['coming_soon_notifier_clock_enable_disable'] ) ? $_POST['coming_soon_notifier_clock_enable_disable'] :'';
			$csn_clock_date = !empty( $_POST['coming_soon_notifier_clock_date'] ) ? $_POST['coming_soon_notifier_clock_date'] :'';
			$csn_clock_theme = !empty( $_POST['coming_soon_notifier_clock_theme'] ) ? $_POST['coming_soon_notifier_clock_theme'] :'';
			$csn_notification_enable_disable = !empty( $_POST['coming_soon_notifier_notification_enable_disable'] ) ? $_POST['coming_soon_notifier_notification_enable_disable'] :'';
			$csn_notification_btn_title = !empty( $_POST['coming_soon_notifier_notification_btn_title'] ) ? $_POST['coming_soon_notifier_notification_btn_title'] :'';
			$csn_notification_btn_bg_color = !empty( $_POST['coming_soon_notifier_notification_bg_color'] ) ? $_POST['coming_soon_notifier_notification_bg_color'] :'';
			$csn_notification_btn_text_color = !empty( $_POST['coming_soon_notifier_notification_text_color'] ) ? $_POST['coming_soon_notifier_notification_text_color'] :'';

			$csn_option_array = array(
				'csn_enable_disable' => $csn_enable_disable,
				'csn_custom_post_type' => $csn_custom_post_types,
				'csn_title' => $csn_title,
				'csn_discription' => $csn_discription,
				'csn_logo_image' => $csn_logo_image,
				'csn_bg_option' => $csn_bg_option,
				'csn_bg_color' => $csn_bg_color,
				'csn_bg_image' => $csn_bg_image,
				'csn_clock_enable_disable' => $csn_clock_enable_disable,
				'csn_clock_date' => $csn_clock_date,
				'csn_clock_theme' => $csn_clock_theme,
				'csn_notification_enable_disable' => $csn_notification_enable_disable,
				'csn_notification_title' => $csn_notification_btn_title,
				'csn_notification_bg_color' => $csn_notification_btn_bg_color,
				'csn_notification_text_color' => $csn_notification_btn_text_color,
			);

			$csn_option_array = maybe_serialize( $csn_option_array);

			delete_option( 'csn_global_settings');
			update_option( 'csn_global_settings', $csn_option_array);
		}

		$redirect_URL = admin_url('admin.php?page=coming_soon_settings');
		wp_safe_redirect( $redirect_URL );

		exit();

	}
}

/**
 * function for register custom metaboxs.
 *
 * @since    1.0
 * @access   public
 */
function coming_soon_notifier_register_meta_boxes() {
	add_meta_box( 'csn_meta_box_id', __( 'Coming Soon Notifier Settings', 'coming-soon-notifier' ), 'csn_custom_metabox_callback_fn', '' );
}

/**
 * function for custom metabox callback.
 *
 * @since    1.0
 * @access   public
 */
function csn_custom_metabox_callback_fn() {

}

function get_csn_option() {
	$get_options = get_option( 'csn_global_settings');
	$get_options = maybe_unserialize( $get_options);
	return $get_options;
}

function get_csn_options( $get_option ) {
	$get_options = get_csn_option();

	$selected_options ='';

	switch ($get_option) {
		case "enable_disable":
			$selected_options = !empty( $get_options['csn_enable_disable']  ) ? $get_options['csn_enable_disable'] :'';
			break;
		case "post_type":
			$selected_options = !empty( $get_options['csn_custom_post_type']  ) ? $get_options['csn_custom_post_type'] :'';
			break;
		case "title":
			$selected_options = !empty( $get_options['csn_title']  ) ? $get_options['csn_title'] :'';
			break;
		case "discription":
			$selected_options = !empty( $get_options['csn_discription']  ) ? $get_options['csn_discription'] :'';
			break;
		case "logo_image":
			$selected_options = !empty( $get_options['csn_logo_image']  ) ? $get_options['csn_logo_image'] :'';
			break;
		case "bg_option":
			$selected_options = !empty( $get_options['csn_bg_option']  ) ? $get_options['csn_bg_option'] :'';
			break;
		case "bg_color":
			$selected_options = !empty( $get_options['csn_bg_color']  ) ? $get_options['csn_bg_color'] :'#FFFFFF';
			break;
		case "bg_image":
			$selected_options = !empty( $get_options['csn_bg_image']  ) ? $get_options['csn_bg_image'] :'';
			break;
		case "clock_enable_option":
			$selected_options = !empty( $get_options['csn_clock_enable_disable']  ) ? $get_options['csn_clock_enable_disable'] :'';
			break;
		case "clock_date":
			$selected_options = !empty( $get_options['csn_clock_date']  ) ? $get_options['csn_clock_date'] :'';
			break;
		case "clock_theme":
			$selected_options = !empty( $get_options['csn_clock_theme']  ) ? $get_options['csn_clock_theme'] :'';
			break;
		case "notification_enable_option":
			$selected_options = !empty( $get_options['csn_notification_enable_disable']  ) ? $get_options['csn_notification_enable_disable'] :'';
			break;
		case "notification_title":
			$selected_options = !empty( $get_options['csn_notification_title']  ) ? $get_options['csn_notification_title'] :'';
			break;
		case "notification_bg_color":
			$selected_options = !empty( $get_options['csn_notification_bg_color']  ) ? $get_options['csn_notification_bg_color'] :'#000000';
			break;
		case "notification_text_color":
			$selected_options = !empty( $get_options['csn_notification_text_color']  ) ? $get_options['csn_notification_text_color'] :'#FFFFFF';
			break;
		default:
			echo "no option founds";
	}
	return $selected_options;
}