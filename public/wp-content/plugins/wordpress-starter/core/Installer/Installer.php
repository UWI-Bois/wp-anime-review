<?php
namespace SiteGround_Wizard\Installer;

use SiteGround_Wizard\Wizard\Wizard;

/**
 * Installer functions and main initialization class.
 */
class Installer {

	/**
	 * Background Processes handler.
	 *
	 * @var SiteGround_Wizard\Importer
	 *
	 * @since 1.0.0
	 */
	private $background_process;

	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_installer_routes' ) );

		add_action( 'wp_ajax_siteground_wizard_install_plugin', array( $this, 'install_from_dashboard' ) );
		add_action( 'wp_ajax_hide_box', array( $this, 'hide_dashboard_box' ) );
	}

	/**
	 * Register installer rest routes.
	 *
	 * @since  1.0.0
	 */
	public function register_installer_routes() {
		register_rest_route(
			Wizard::REST_NAMESPACE, '/prepare/', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'prepare' ),
			)
		);

		register_rest_route(
			Wizard::REST_NAMESPACE, '/install/', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'install' ),
			)
		);

		register_rest_route(
			Wizard::REST_NAMESPACE, '/complete/', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'complete' ),
			)
		);
	}

	/**
	 * Install plugins/themes method
	 *
	 * @since  1.0.0
	 *
	 * @param  object $request Request data.
	 */
	public function install( $request ) {
		// Get the current errors if any.
		$errors = get_option( 'siteground_wizard_installation_errors', array() );

		// Remove the item from the queue.
		self::remove_from_queue( $request['id'] );

		// Execute the installation command.
		exec(
			sprintf(
				'wp %s install %s --activate --skip-packages',
				escapeshellarg( $request['type'] ),
				! empty( $request['download_url'] ) ? escapeshellarg( $request['download_url'] ) : escapeshellarg( $request['slug'] )
			),
			$output,
			$status
		);


		// Check for errors.
		if ( ! empty( $status ) ) {
			$errors[] = sprintf( 'Cannot install %1$s: %2$s', $request['type'], $request['slug'] );
			// Add the error.
			update_option( 'siteground_wizard_installation_errors', $errors );
			wp_send_json_error();
		}

		wp_send_json_success();
	}

	public static function remove_from_queue( $id ) {
		$queue = get_option( 'siteground_wizard_installation_queue', array() );

		if ( empty( $queue ) ) {
			return;
		}

		$key = array_search( $id, array_column( $queue, 'id' ) );

		if ( empty( $key ) ) {
			return;
		}

		unset( $queue[ $key ] );

		update_option( 'siteground_wizard_installation_queue', array_values( $queue ) );
	}

	/**
	 * Install plugin from the custom dashboard.
	 *
	 * @since  1.0.5
	 */
	public function install_from_dashboard() {
		if ( ! wp_verify_nonce( $_GET['nonce'], $_GET['plugin'] ) ) {
			die( __( 'Security check', 'siteground-wizard' ) );
		}

		// Execute the installation command.
		exec(
			sprintf(
				'wp plugin install %s --activate',
				escapeshellarg( $_GET['plugin'] )
			),
			$output,
			$status
		);

		// Check for errors.
		if ( ! empty( $status ) ) {
			wp_send_json_error();
		}

		wp_send_json_success();
	}

	public function hide_dashboard_box() {
		if ( ! isset( $_GET['box'] ) ) {
			wp_send_json_error();
		}

		update_option( $_GET['box'], 1 );

		wp_send_json_success();
	}


	/**
	 * Handle plugin install request.
	 *
	 * @since  1.0.0
	 *
	 * @param  object $request Request data.
	 */
	public function prepare( $request ) {
		// Get the data.
		$data = json_decode( $request->get_body(), true );

		if ( empty( $data ) ) {
			wp_send_json_error();
		}

		update_option( 'siteground_wizard_installation_queue', $data );

		// Reset the site.
		exec( 'wp site empty --yes' );
		// Notify the api, that everything is ok with provided data.
		wp_send_json_success();
	}

	/**
	 * Complete the installation
	 *
	 * @since  5.1.0
	 *
	 * @param  object $request Request data.
	 */
	public function complete( $request ) {
		// Get the errors.
		$errors = get_option( 'siteground_wizard_installation_errors', array() );

		// Update the status.
		update_option(
			'siteground_wizard_installation_status',
			array(
				'status' => 'completed',
				'errors' => $errors,
			)
		);

		// Reset the errors.
		delete_option( 'siteground_wizard_installation_errors' );

		$this->configure_other_plugins();

		// Skip Oceanwp theme redirect.
		$nonce = wp_create_nonce( 'oceanwp-theme_skip_activation' );
		$admin_url = admin_url( 'admin.php?fs_action=oceanwp-theme_skip_activation&page=oceanwp-panel&_wpnonce=' . $nonce );
		$response = wp_remote_get( $admin_url );

		wp_send_json_success();
	}

	private function configure_other_plugins() {
		$options = array(
			'enable_cache',
			'autoflush_cache',
			'ssl_enabled',
			'enable_gzip_compression',
			'enable_browser_caching',
			'optimize_html',
			'optimize_javascript',
			'optimize_javascript_async',
			'optimize_css',
			'combine_css',
			'combine_google_fonts',
			'disable_emojis',
			'optimize_images',
			'webp_support',
			'lazyload_images',
			'lazyload_iframes',
			'lazyload_videos',
			'lazyload_textwidgets',
			'lazyload_thumbnails',
			'lazyload_responsive',
			'lazyload_gravatars',
			'lazyload_woocommerce',
		);

		foreach ( $options as $option ) {
			update_option( 'siteground_optimizer_' . $option, 1 );
		}

		$transients = array(
			'fs_plugin_foogallery_activated',
			'fs_theme_oceanwp_activated',
			'fs_plugin_ocean-posts-slider_activated',
			'fs_plugin_the-events-calendar_activated',
		);

		foreach ( $transients as $transients ) {
			delete_transient( $transient );
		}
	}
}
