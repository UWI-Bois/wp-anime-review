<?php
namespace SiteGround_Wizard\Importer;

use SiteGround_Wizard\Helper\Helper;
/**
 * Ocean WP theme functions and main initialization class.
 */
class Plugin_Importer_Wpforms extends Importer {

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
			! function_exists( 'wpforms' )
		) {
			return true;
		}

		add_filter( 'wpforms_current_user_can', '__return_true' );

		// Get the form data.
		$form = array_shift( $maybe_json );

		// Create empty form so we have an ID to work with.
		$new_post = wp_insert_post(
			array(
				'post_status' => 'publish',
				'post_type'   => 'wpforms',
			)
		);

		// Bail if post creation has failed.
		if (
			empty( $new_post ) ||
			is_wp_error( $new_post )
		) {
			return true;
		}

		// very ugly way to change the form id, but since we are using the form
		// in sample data xml, we have to change it that way.
		$wpdb->query(
			$wpdb->prepare(
				"UPDATE $wpdb->posts SET ID=%s WHERE ID = %d",
				$form['id'],
				$new_post
			)
		);

		$form['field_id'] = count( $form['fields'] ) + 1;

		// Update the form with all our compiled data.
		wpforms()->form->update( $form['id'], $form );

		remove_filter( 'wpforms_current_user_can', '__return_true' );

		return false;
	}

}
