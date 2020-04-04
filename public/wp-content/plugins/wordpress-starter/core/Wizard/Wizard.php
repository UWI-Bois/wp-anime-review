<?php
namespace SiteGround_Wizard\Wizard;

use SiteGround_Wizard\Activator\Activator;

/**
 * Dashboard functions and main initialization class.
 */
class Wizard {
	/**
	 * Plugin rest route.
	 *
	 * @since 1.0.0
	 */
	const REST_NAMESPACE = 'siteground-wizard/v1';

	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Hook to `admin_menu` in order to add our own setup wizard page.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 10, 2 );

		// Display the wizard page.
		add_action( 'wp_loaded', array( $this, 'display_wizard_page' ), 10 );

		// Try to redirect to wizard page.
		add_action( 'admin_init', array( $this, 'admin_init' ), 1 );

		register_shutdown_function( array( &$this, 'siteground_wizard_shutdown_handler' ) );
	}

	/**
	 * Handle all functions shutdown and check for fatal errors in plugin.
	 *
	 * @since  1.0.5
	 */
	public function siteground_wizard_shutdown_handler() {
		// Get the last error.
		$error = error_get_last();

		// Bail if there is no error.
		if ( empty( $error ) ) {
			return;
		}

		// Update the status of transfer if the fatal error occured.
		if (
			strpos(
				$error['file'],
				\SiteGround_Wizard\DIR . '/includes/background-processing/siteground-wizard-background-processes'
			) !== false &&
			E_ERROR === $error['type']
		) {
			update_option(
				'siteground_wizard_installation_status',
				array(
					'status' => 'failed',
					'errors' => array( esc_html__( 'Critical Environment Error', 'siteground-wizard' ) ),
				)
			);
		}

	}

	/**
	 * Hook to `admin_init` and redirect to Siteground Wizard if the `_sg_activation_redirect` transient flag is set.
	 *
	 * @since 1.0.0
	 */
	public function admin_init() {
		// If the `_sg_activation_redirect` is set, then redirect to the setup page.
		if ( 'no' === get_option( Activator::SHOW_WIZARD ) ) {
			return;
		}

		// If we're already on the page or the user doesn't have permissions, return.
		if (
			( ! empty( $_GET['page'] ) && 'siteground-wizard' === $_GET['page'] ) ||
			is_network_admin() ||
			isset( $_GET['activate-multi'] ) ||
			! current_user_can( 'manage_options' )
		) {
			return;
		}

		// Finally redirect to the setup page.
		wp_safe_redirect( admin_url( 'index.php?page=siteground-wizard' ) );

		exit;

	}

	/**
	 * Display wizard page.
	 *
	 * @since  1.0.0
	 */
	public function display_wizard_page() {
		if ( ! is_user_logged_in() && ! current_user_can( 'administrator' ) ) {
			return;
		}

		$status = get_option( 'siteground_wizard_installation_status' );

		// First check if we are in the wizard page at all, if not do nothing.
		if ( ! empty( $_GET['page'] ) && 'siteground-wizard' === $_GET['page'] ) {
			// Bail if we have successful installation already.
			if (
				! empty( $status ) &&
				'completed' === $status['status']
			) {

				wp_safe_redirect( 'admin.php?page=custom-dashboard.php' );
				exit;
			}
			include \SiteGround_Wizard\DIR . '/templates/siteground-wizard.php';
			exit;
		}

	}

	/**
	 * Register the wizard page to be able to access it
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		// @todo: find another way to do this, since this is adding an empty space in WP's dashboard menu.
		add_dashboard_page( '', '', 'manage_options', 'siteground-wizard', '' );
	}

}
