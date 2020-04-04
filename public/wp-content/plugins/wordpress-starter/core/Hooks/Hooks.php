<?php
namespace SiteGround_Wizard\Hooks;

/**
 * Dashboard functions and main initialization class.
 */
class Hooks {
	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'wpforms_upgrade_link', array( $this, 'change_wpforms_upgrade_link' ) );
		add_filter( 'neve_upgrade_link_from_child_theme_filter', array( $this, 'change_neve_affiliate_link' ) );
		add_filter( 'neve_filter_onboarding_data', array( $this, 'change_neve_affiliate_link_config' ) );
		add_filter( 'ti_about_config', array( $this, 'remove_neve_useful_plugins' ) );

		// Temp solution, until the awesomemotive provide a way to change the entire link.
		add_filter( 'optin_monster_action_link', array( $this, 'change_optin_monster_action_link' ) );
		add_filter( 'monsterinsights_shareasale_id', array( $this, 'change_monsterinsights_shareasale_id' ) );

		add_filter( 'wc_jilt_app_connection_redirect_args', array( $this, 'add_siteground_connect_redirect_arg' ) );

		add_filter( 'connect_url', '__return_false' );
	}

	/**
	 * Get the affiliate link, based on company id.
	 *
	 * @since  1.0.6
	 *
	 * @param  string $slug The plugin/theme slug.
	 *
	 * @return bool|string  The affliate link if found. False otherwise.
	 */
	public static function get_affiliate_link( $slug ) {
		$sco_id  = get_option( 'sco_id', '1' );
		$content = file_get_contents( \SiteGround_Wizard\DIR . '/misc/affiliate-links.json' );
		$links   = json_decode( $content, true );

		if ( ! array_key_exists( $slug, $links ) ) {
			return false;
		}

		if ( ! empty( $links[ $slug ][ $sco_id ] ) ) {
			return $links[ $slug ][ $sco_id ];
		}

		if ( ! empty( $links[ $slug ]['1'] ) ) {
			return $links[ $slug ]['1'];
		}

		return false;
	}

	public function add_siteground_connect_redirect_arg( $args ) {
		$args['parner'] = $this->get_affiliate_link( 'jilt-for-woocommerce' );

		return $args;
	}

	/**
	 * Change WPForms upgrede link.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $url The upgrade url.
	 *
	 * @return string      Modified url.
	 */
	public function change_wpforms_upgrade_link( $url ) {
		$new_url = $this->get_affiliate_link( 'wpforms' );

		// Return the orignal url if the new is not found.
		if ( false === $new_url ) {
			return $url;
		}

		return $new_url;
	}

	/**
	 * Change Neve affiliate link.
	 *
	 * @since  1.0.4
	 *
	 * @return string The new upgrade link.
	 */
	public function change_neve_affiliate_link( $url ) {
		$new_url = $this->get_affiliate_link( 'neve' );

		// Return the orignal url if the new is not found.
		if ( false === $new_url ) {
			return $url;
		}

		return $new_url;
	}

	/**
	 * Change Neve affiliate link
	 *
	 * @since  1.0.4
	 *
	 * @param array $config The theme config.
	 *
	 * @return array The config with affiliate upgrade link.
	 */
	public function change_neve_affiliate_link_config( $config ) {
		$new_url = $this->get_affiliate_link( 'neve' );

		// Change the link.
		if ( false !== $new_url ) {
			$config['pro_link'] = $new_url;
		}
		return $config;
	}

	/**
	 * Remove Neve theme useful plugins tab
	 *
	 * @since  1.0.4
	 *
	 * @param  array $config The theme config.
	 *
	 * @return array         Modified config.
	 */
	public function remove_neve_useful_plugins( $config ) {
		unset( $config['useful_plugins'] );

		return $config;
	}

	/**
	 * Change Monsterinsights share a sale id.
	 *
	 * @since  1.0.7
	 *
	 * @return string      Modified url.
	 */
	public function change_monsterinsights_shareasale_id() {
		return $this->get_affiliate_link( 'google-analytics-for-wordpress' );
	}

	/**
	 * Change Optinmonster upgrade link.
	 *
	 * @since  1.0.7
	 *
	 * @return string      Modified url.
	 */
	public function change_optin_monster_action_link() {
		return $this->get_affiliate_link( 'optinmonster' );
	}
}
