<?php
/**
 * The admin-specific functionality of the plugin.
 *
 *  Defines the plugin name, version, and two examples hooks for how to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link  http://wpdevelopment.local
 * @since      1.0
 * @package    Coming_Soon_Notifier
 * @subpackage Coming_Soon_Notifier/public
 * @author  Dhaval Parejia <http://wpdevelopment.local>
 */

class Coming_Soon_Notifier_Public {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function __construct() {
		// Enqueue Script and Style for Admin.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * function for register styles.
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function enqueue_styles() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_style( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/css/coming-soon-notifier-public' . $suffix . '.css', array(), COMING_SOON_NOTIFIER_VERSION, 'all' );
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

		wp_register_script( COMING_SOON_NOTIFIER_SLUG, COMING_SOON_NOTIFIER_URL . 'assets/js/coming-soon-notifier-public' . $suffix . '.js', array( 'jquery' ), COMING_SOON_NOTIFIER_VERSION, false );
		wp_enqueue_script( COMING_SOON_NOTIFIER_SLUG );
	}
}