<?php
/**
 * Plugin Name: Coming Soon Notifier
 * Plugin URI: http://wpdevelopment.local
 * Description: Create your page or product and display just comming soon...
 * Version: 1.0
 * Author: Dhaval Parejia
 * Author URI: http://wpdevelopment.local
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: coming-soon-notifier
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-idea-point-activator.php
 */
function activate_coming_soon_notifier() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/coming-soon-notifier-activator.php';
	Coming_Soon_Notifier_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-idea-point-deactivator.php
 */
function deactivate_coming_soon_notifier() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/coming-soon-notifier-deactivator.php';
	Coming_Soon_Notifier_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_coming_soon_notifier' );
register_deactivation_hook( __FILE__, 'deactivate_coming_soon_notifier' );

/**
 * check Coming_Soon_Notifier class exists or not.
 */ 
if( ! class_exists( 'Coming_Soon_Notifier' ) ) {

	final class Coming_Soon_Notifier {

		/**
		 * Holds the instance
		 *
		 * Ensures that only one instance of Coming_Soon_Notifier exists in memory at any one
		 * time and it also prevents needing to define globals all over the place.
		 *
		 * TL;DR This is a static property property that holds the singleton instance.
		 *
		 * @var object
		 * @static
		 */
		private static $instance;

		/**
		 * Coming Soon Notifier Admin Object.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @var Coming_Soon_Notifier object.
		 */
		public $plugin_admin;

		/**
		 * Coming Soon Notifier Public Object.
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @var Coming_Soon_Notifier object.
		 */
		public $plugin_public;


		/**
		 * Get the instance and store the class inside it. This plugin utilises
		 *
		 * @since     1.0
		 * @static
		 * @staticvar array $instance
		 * @access    public
		 * @return object self::$instance Instance
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Coming_Soon_Notifier ) ) {
				self::$instance = new Coming_Soon_Notifier();
				self::$instance->setup_constants();
				self::$instance->hooks();
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 * set plugin constants.
		 *
		 * @since   1.0
		 * @access  private
		 */
		private function setup_constants() {

			if( !defined( 'COMING_SOON_NOTIFIER_VERSION')) {
				define( 'COMING_SOON_NOTIFIER_VERSION', '1.0' );
			}

			if( !defined( 'COMING_SOON_NOTIFIER_SLUG')) {
				define( 'COMING_SOON_NOTIFIER_SLUG', 'coming-soon-notifier');
			}

			if( !defined( 'COMING_SOON_NOTIFIER_FILE')) {
				define( 'COMING_SOON_NOTIFIER_FILE',  __FILE__ );
			}

			if ( ! defined( 'COMING_SOON_NOTIFIER_DIR' ) ) {
				define( 'COMING_SOON_NOTIFIER_DIR', dirname( COMING_SOON_NOTIFIER_FILE ) );
			}

			if ( ! defined( 'COMING_SOON_NOTIFIER_URL' ) ) {
				define( 'COMING_SOON_NOTIFIER_URL', plugin_dir_url( COMING_SOON_NOTIFIER_FILE ) );
			}

			if ( ! defined( 'COMING_SOON_NOTIFIER_DIR_PATH' ) ) {
				define( 'COMING_SOON_NOTIFIER_DIR_PATH', plugin_dir_path( COMING_SOON_NOTIFIER_FILE ) );
			}

			if ( ! defined( 'COMING_SOON_NOTIFIER_BASENAME' ) ) {
				define( 'COMING_SOON_NOTIFIER_BASENAME', plugin_basename( COMING_SOON_NOTIFIER_FILE ) );
			}
		}

		/**
		 * define Hooks.
		 *
		 * @since 1.0
		 * @acess public
		 */
		public function hooks() {
			add_action( 'init', array( $this, 'coming_soon_notifier_load_textdomain' ) );
			add_filter( 'plugin_row_meta', array( $this, 'coming_soon_notifier_plugin_row_meta' ), 10, 2 );
		}

		/**
		 * Includes.
		 *
		 * @since 1.0
		 * @access private
		 */
		private function includes() {

			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */

			require_once( COMING_SOON_NOTIFIER_DIR . '/includes/admin/class-coming-soon-notifier-admin.php' );

			/**
			 * The class responsible for defining all actions that occur in the public area.
			 */
			require_once( COMING_SOON_NOTIFIER_DIR . '/includes/public/class-coming-soon-notifier-public.php' );

			/**
			 * Idea point helper functions.
			 */
			require_once( COMING_SOON_NOTIFIER_DIR . '/includes/coming-soon-notifier-helper.php' );

			self::$instance->plugin_admin  = new Coming_Soon_Notifier_Admin();
			self::$instance->plugin_public = new Coming_Soon_Notifier_Public();

		}

		/**
		 * Load Plugin Text Domain
		 *
		 * Looks for the plugin translation files in certain directories and loads
		 * them to allow the plugin to be localised
		 *
		 * @since  1.0
		 * @access public
		 *
		 * @return bool True on success, false on failure.
		 */
		public function coming_soon_notifier_load_textdomain() {
			// Traditional WordPress plugin locale filter.
			$locale = apply_filters( 'plugin_locale', get_locale(), COMING_SOON_NOTIFIER_SLUG );
			$mofile = sprintf( '%1$s-%2$s.mo', COMING_SOON_NOTIFIER_SLUG, $locale );

			// Setup paths to current locale file.
			$mofile_local = trailingslashit( plugin_dir_path( COMING_SOON_NOTIFIER_FILE ) . 'languages' ) . $mofile;

			if ( file_exists( $mofile_local ) ) {
				// Look in the /wp-content/plugins/give-fee-recovery/languages/ folder.
				load_textdomain( COMING_SOON_NOTIFIER_FILE, $mofile_local );
			} else {
				// Load the default language files.
				load_plugin_textdomain( COMING_SOON_NOTIFIER_FILE, false, trailingslashit( plugin_dir_path( COMING_SOON_NOTIFIER_FILE ) . 'languages' ) );
			}

			return false;
		}

		/**
		 * Function for add new menu row on plugin listing page.
		 *
		 * @since  1.0
		 * @access public
		 * @param $plugin_meta
		 * @param $plugin_file
		 *
		 * @return array
		 */
		public function coming_soon_notifier_plugin_row_meta( $plugin_meta, $plugin_file ) {

			$plugin_meta_links = array('coming_soon_notifier_demo' => '<a href="http://wpdevelopment.local/wp-admin/" target="_blank">Plugin Demo</a>');

			return array_merge( $plugin_meta, $plugin_meta_links );
		}
	}
}

/**
 * Loads a single instance of Coming soon notifier.
 *
 * This follows the PHP singleton design pattern.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @example <?php $Coming_Soon_Notifier = Coming_Soon_Notifier(); ?>
 *
 * @since   1.0.0
 *
 * @see     Coming_Soon_Notifier::get_instance()
 *
 * @return object Coming_Soon_Notifier Returns an instance of the class
 */
function Coming_Soon_Notifier() {
	return Coming_Soon_Notifier::get_instance();
}

Coming_Soon_Notifier();