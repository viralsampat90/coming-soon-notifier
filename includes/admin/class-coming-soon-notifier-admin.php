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
	}

	/**
	 * function for register styles.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function enqueue_styles() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_style( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/css/coming-soon-notifier-admin' . $suffix . '.css', array('wp-color-picker'), COMING_SOON_NOTIFIER_VERSION, 'all' );
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
		wp_enqueue_script( 'coming-soon-notifier-common' );

		wp_register_script( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/js/coming-soon-notifier-admin' . $suffix . '.js', array( 'jquery','wp-color-picker' ), COMING_SOON_NOTIFIER_VERSION, false );
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
}