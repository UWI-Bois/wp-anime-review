<?php
namespace SiteGround_Wizard\Importer;

use SiteGround_Wizard\Helper\Helper;
/**
 * Ocean WP theme functions and main initialization class.
 */
class Theme_Importer_Astra extends Importer {

	/**
	 * Import sample data to WordPress.
	 *
	 * @since  1.0.0
	 *
	 * @param  object $json Json data.
	 *
	 * @return bool True on error, false on success.
	 */
	public function import_json( $json ) {
		global $wpdb;
		$maybe_json = Helper::maybe_json_decode( $json );

		// Bail if provided json is invalid.
		if (
			false === $maybe_json ||
			! class_exists( 'Astra_Site_Options_Import' ) ||
			! class_exists( 'Astra_Customizer_Import' )
		) {
			return true;
		}

		if ( ! empty( $maybe_json['astra-site-customizer-data'] ) ) {
			\Astra_Customizer_Import::instance()->import( $maybe_json['astra-site-customizer-data'] );
		}

		if ( ! empty( $maybe_json['astra-site-options-data'] ) ) {
			\Astra_Site_Options_Import::instance()->import_options( $maybe_json['astra-site-options-data'] );
		}

		return false;
	}

	/**
	 * XML importer.
	 *
	 * @since  1.0.0
	 *
	 * @param string $url The xml url.
	 */
	public function import_xml( $url ) {
		exec( 'wp plugin deactivate astra-sites' );

		exec(
			sprintf(
				'wp import %s --authors=skip',
				escapeshellarg( $url )
			),
			$output,
			$status
		);

		exec( 'wp plugin activate astra-sites' );

		// Check for errors during the import.
		if ( ! empty( $status ) ) {
			return true;
		}

		return false;
	}

}
