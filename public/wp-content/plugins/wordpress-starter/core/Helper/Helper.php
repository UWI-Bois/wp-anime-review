<?php
namespace SiteGround_Wizard\Helper;

use SiteGround_Wizard\Dashboard\Dashboard;
use SiteGround_Wizard\Wizard\Wizard;
use SiteGround_Wizard\Updater\Updater;
use SiteGround_Wizard\Installer\Installer;
use SiteGround_Wizard\Importer\Importer;
use SiteGround_Wizard\Hooks\Hooks;

/**
 * Helper functions and main initialization class.
 */
class Helper {

	/**
	 * List of pages where we will hide all notices.
	 *
	 * @var array List of pages.
	 *
	 * @since 1.0.0
	 */
	private $pages_without_notices = array(
		'edit.php',
		'post-new.php',
		'edit-tags.php',
		'themes.php',
		'nav-menus.php',
		'widgets.php',
		'edit-comments.php',
		'tools.php',
		'import.php',
		'export.php',
		'options-general.php',
		'options-writing.php',
		'options-reading.php',
		'options-discussion.php',
		'options-media.php',
		'options-permalink.php',
		'privacy.php',
		'update-core.php',
		'upload.php',
		'media-new.php',
		'theme-editor.php',
		'plugin-editor.php',
		'users.php',
		'user-new.php',
		'profile.php',
	);

	/**
	 * List of custom pages where we will hide all notices.
	 *
	 * @var array List of pages.
	 *
	 * @since 1.0.0
	 */
	private $siteground_pages = array(
		'custom-dashboard.php',
		'sg-cachepress',
		'caching',
		'ssl',
		'php-check',
	);

	/**
	 * Create a new helper.
	 */
	public function __construct() {
		// Load the plugin textdomain.
		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ), 9999 );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ), 9999 );
		add_action( 'wp_ajax_switch_dashboard', array( $this, 'switch_dashboard' ) );
		add_action( 'wp_ajax_restart_wizard', array( $this, 'restart_wizard' ) );
		add_action( 'admin_init', array( $this, 'hide_errors_and_notices' ) );

		add_action( 'rest_api_init', array( $this, 'register_helper_routes' ) );

		// Initialize Wizard.
		new Wizard();

		// Initialize Dashboard.
		new Dashboard();

		// Initialize Updater.
		new Updater();

		// Initialize Installer.
		new Installer();

		// Initialize Importer.
		new Importer();

		// Add additional hooks to change plugins and themes behaviour.
		new Hooks();
	}

	public function register_helper_routes() {
		register_rest_route(
			Wizard::REST_NAMESPACE, '/update-visibility/', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'update_visibility' ),
			)
		);
	}

	public function update_visibility() {
		update_option( 'siteground_wizard_activation_redirect', 'no' );
		wp_send_json_success();
	}

	/**
	 * Hide all errors and notices on our custom dashboard.
	 *
	 * @since  1.0.0
	 */
	public function hide_errors_and_notices() {
		global $pagenow;

		if (
			( isset( $_GET['page'] ) && in_array( wp_unslash( $_GET['page'] ), $this->siteground_pages ) ) ||
			in_array( $pagenow, $this->pages_without_notices )
		) {
			remove_all_actions( 'network_admin_notices' );
			remove_all_actions( 'user_admin_notices' );
			remove_all_actions( 'admin_notices' );
			remove_all_actions( 'all_admin_notices' );

			// Hide all error on our dashboard.
			if (
				isset( $_GET['page'] ) &&
				'custom-dashboard.php' === $_GET['page']
			) {
				error_reporting( 0 );
			}
		}
	}

	/**
	 * Load the plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'siteground-wizard',
			false,
			'wordpress-starter/languages'
		);
	}

	/**
	 * Try to decode json string.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $maybe_json Maybe json string.
	 *
	 * @return json|false         Decoded json on success, false on failure.
	 */
	public static function maybe_json_decode( $maybe_json ) {
		$decoded_string = json_decode( $maybe_json, true );

		// Return decoded json.
		if ( json_last_error() === 0 ) {
			return $decoded_string;
		}

		// Json is invalid.
		return false;
	}

	/**
	 * Retrieve the server ip address.
	 *
	 * @since  1.0.0
	 *
	 * @return string $ip_address The server IP address.
	 */
	public static function get_ip_address() {
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip_address = $_SERVER['HTTP_CLIENT_IP']; // WPCS: sanitization ok.
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR']; // WPCS: sanitization ok.
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED'] ) ) {
			$ip_address = $_SERVER['HTTP_X_FORWARDED']; // WPCS: sanitization ok.
		} elseif ( ! empty( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
			$ip_address = $_SERVER['HTTP_FORWARDED_FOR']; // WPCS: sanitization ok.
		} elseif ( ! empty( $_SERVER['HTTP_FORWARDED'] ) ) {
			$ip_address = $_SERVER['HTTP_FORWARDED']; // WPCS: sanitization ok.
		} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip_address = $_SERVER['REMOTE_ADDR']; // WPCS: sanitization ok.
		} else {
			$ip_address = 'UNKNOWN';
		}

		return sanitize_text_field( wp_unslash( $ip_address ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'siteground-wizard-admin',
			\SiteGround_Wizard\URL . '/assets/css/admin.css',
			array(),
			\SiteGround_Wizard\VERSION,
			'all'
		);

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'siteground-wizard-dashboard',
			\SiteGround_Wizard\URL . '/assets/js/admin.js',
			array( 'jquery' ), // Dependencies.
			\SiteGround_Wizard\VERSION
		);

	}

	/**
	 * Add option that will be used to check if the dashboard banner should be shown.
	 *
	 * @since  1.0.0
	 */
	public function switch_dashboard() {
		if (
			isset( $_GET['switch_dashboard'] ) &&
			wp_verify_nonce( $_GET['switch_dashboard'], 'switch_dashboard_nonce' )
		) {
			$value = isset( $_GET['value'] ) ? wp_unslash( $_GET['value'] ) : 'yes';
			$event = 'yes' === $value ? 'revert_dashboard' : 'dashboard_used_person';

			$this->send_statistics( $event );

			update_option( 'siteground_wizard_hide_custom_dashboard', $value );

			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Restart the Wizard.
	 *
	 * @since  1.0.0
	 */
	public function restart_wizard() {
		if (
			isset( $_GET['restart_wizard'] ) &&
			wp_verify_nonce( $_GET['restart_wizard'], 'restart_wizard_nonce' )
		) {
			$this->send_statistics( 'clicked_banner' );

			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	public function add_dashboard_widget() {
		wp_add_dashboard_widget(
			'siteground_wizard_dashboard',
			__( 'Custom Dashboard (by the WordPress Starter Plugin)', 'siteground-wizard' ),
			array( $this, 'load_dashboard_widget' )
		);

		global $wp_meta_boxes;

		$wp_meta_boxes['dashboard']['side']['core'] = array_merge(
			array(
				'siteground_wizard_dashboard' => $wp_meta_boxes['dashboard']['normal']['core']['siteground_wizard_dashboard'],
			),
			$wp_meta_boxes['dashboard']['side']['core']
		);

		unset( $wp_meta_boxes['dashboard']['normal']['core']['siteground_wizard_dashboard'] );
	}

	/**
	 * Create the function to output the contents of our Dashboard Widget.
	 */
	public function load_dashboard_widget() {
		include \SiteGround_Wizard\DIR . '/templates/dashboard-widget.php';
	}

	/**
	 * Checks if there are any updates available.
	 *
	 * @since  1.0.0
	 *
	 * @return bool True is any, false otherwise.
	 */
	public static function updates_available() {
		$themes             = get_theme_updates();
		$plugins            = get_plugin_updates();
		$core               = get_core_updates();
		$translations       = wp_get_translation_updates();
		$hide_notifications = get_option( 'siteground_wizard_hide_notifications', 'no' );
		$old_hash           = get_option( 'updates_available' );
		$new_hash           = md5( serialize( $themes ) . serialize( $plugins ) . serialize( $core[0]->response ) . serialize( $translations ) );

		// Check for new updates if the notifications are hidden.
		if ( 'yes' === $hide_notifications ) {
			// Display the update notice if there is a new update.
			if ( $old_hash !== $new_hash ) {
				return true;
			}
			// Hide the notice if the updates are the same
			// like when the notice section has been hidden.
			return false;
		}

		if (
			empty( $themes ) &&
			empty( $plugins ) &&
			empty( $translations ) &&
			'latest' === $core[0]->response
		) {
			return false;
		}

		return true;
	}

	/**
	 * Send stats to siteground api.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $event The event that happend.
	 */
	public function send_statistics( $event ) {
		$response = wp_remote_post(
			'https://wpwizardapi.siteground.com/statistics',
			array(
				'method' => 'POST',
				'timeout' => 45,
				'blocking' => true,
				'headers' => array(
					'Accept'       => 'application/json',
					'Content-Type' => 'application/json',
				),
				'body' => json_encode(
					array( 'event' => $event )
				),
			)
		);
	}

	/**
	 * Checks if it's a shop website.
	 *
	 * @since  1.0.0
	 *
	 * @return boolean True/False
	 */
	public static function is_shop() {
		if (
			\is_plugin_active( 'woocommerce/woocommerce.php' ) &&
			'Storefront' === wp_get_theme()->Name
		) {
			return true;
		}

		return false;
	}
}
