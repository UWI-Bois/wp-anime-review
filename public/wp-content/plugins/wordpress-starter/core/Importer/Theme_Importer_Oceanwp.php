<?php
namespace SiteGround_Wizard\Importer;

use SiteGround_Wizard\Helper\Helper;
/**
 * Ocean WP theme functions and main initialization class.
 */
class Theme_Importer_Oceanwp extends Importer {

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
		$maybe_json = Helper::maybe_json_decode( $json );

		// Bail if provided json is invalid.
		if ( false === $maybe_json ) {
			return true;
		}

		// Loop through mods and add them.
		foreach ( $maybe_json as $mod => $value ) {
			set_theme_mod( $mod, $value );
		}
		return false;
	}

}
