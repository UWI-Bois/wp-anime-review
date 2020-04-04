<?php
namespace SiteGround_Wizard\Activator;

/**
 * Activator functions.
 */
class Activator {

	/**
	 * Option name whether to show the wizard on login.
	 *
	 * @since 1.0.0
	 */
	const SHOW_WIZARD = 'siteground_wizard_activation_redirect';

	/**
	 * Fires on plugin activation.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {

		// Check current wordpress version.
		if ( version_compare( get_bloginfo( 'version' ), '4.4', '<' ) ) {
			die( esc_html__( 'The WordPress Starter plugin requires WordPress version 4.4 or above.', 'siteground-wizard' ) );
		}

		// Bail if php version doesn't support namespaces.
		if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
			die( esc_html__( 'The WordPress Starter plugin requires PHP version 5.6 or above.', 'siteground-wizard' ) );
		}

		if ( 'yes' === get_option( self::SHOW_WIZARD, 'yes' ) ) {
			// Update elementor options only on first activation.
			update_option( 'elementor_disable_color_schemes', 'yes', 'yes' );
			update_option( 'elementor_disable_typography_schemes', 'yes', 'yes' );
			// Update option whether to show the popup.
			update_option( self::SHOW_WIZARD, 'yes' );
			// Keep the timestamp, when the plugin is installed.
			update_option( 'siteground_wizard_install_timestamp', time() );
		}

	}
}