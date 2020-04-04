<?php

namespace SiteGround_Wizard\Importer;

class Wie_Importer {
	/**
	 * Import widgets
	 *
	 * @since  1.0.0
	 *
	 * @param  array $data Data's sidebars.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function import( $data ) {
		// Get registered sidebars.
		global $wp_registered_sidebars;

		// Loop import data's sidebars.
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets (should not be in export file).
			if ( 'wp_inactive_widgets' === $sidebar_id ) {
				continue;
			}

			// Import the widgets.
			$this->import_sidebar_widgets(
				isset( $wp_registered_sidebars[ $sidebar_id ] ) ? $sidebar_id : 'wp_inactive_widgets',
				$widgets
			);
		}

		// @todo refactor the code above and return the result.
		return false;
	}

	/**
	 * Import widgets for sidebar.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $sidebar_id The sidebar id.
	 * @param  array  $widgets    Array of widgets to import.
	 */
	private function import_sidebar_widgets( $sidebar_id, $widgets ) {
		// Loop widgets.
		foreach ( $widgets as $widget_instance_id => $widget ) {
			// Get id_base (remove -# from end) and instance ID number.
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			// Convert multidimensional objects to multidimensional arrays.
			$widget  = json_decode( wp_json_encode( $widget ), true );

			// Check if the widget already exists in the sidebar.
			$is_exists = $this->check_if_widget_already_exists_in_sidebar( $widget, $sidebar_id, $id_base );

			if ( false === $is_exists ) {
				$this->import_widget( $id_base, $widget, $sidebar_id );
			}
		}
	}

	/**
	 * Import widget.
	 *
	 * @since  1.0.0
	 *
	 * @param  string     $id_base    Base widget id.
	 * @param  array      $widget     Widget settings.
	 * @param  int|string $sidebar_id The sidebar id.
	 *
	 * @return bool            True on success, false on failure.
	 */
	private function import_widget( $id_base, $widget, $sidebar_id ) {
		$new_instance_id_number = 1;
		// Get widget instance.
		$single_widget_instances = get_option(
			'widget_' . $id_base,
			array(
				'_multiwidget' => 1,
			)
		);

		$single_widget_instances[] = $widget;
		$new_instance_id_number = key( array_slice( $single_widget_instances, -1, 1, true ) );

		if ( 0 === $new_instance_id_number ) {
			$new_instance_id_number = 1;
			$single_widget_instances[] = $widget;
			unset( $single_widget_instances[0] );
		}

		// Update option with new widget.
		update_option( 'widget_' . $id_base, $single_widget_instances );

		// Assign widget instance to sidebar.
		// Which sidebars have which widgets, get fresh every time.
		$sidebars_widgets = get_option( 'sidebars_widgets', array() );

		// Add new instance to sidebar.
		$sidebars_widgets[ $sidebar_id ][] = $id_base . '-' . $new_instance_id_number;

		// Save the amended data.
		update_option( 'sidebars_widgets', $sidebars_widgets );

		return true;
	}

	/**
	 * Get widget instances.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $available_widgets Array of available widgets.
	 *
	 * @return array                    All widget instances based on available widgets.
	 */
	private function get_widget_instances( $available_widgets ) {
		// Loop throught all available widgets and generate widget instances.
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[ $widget_data['id_base'] ] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Return the widget instances.
		return $widget_instances;
	}

	/**
	 * Get available widgets.
	 *
	 * @since  1.0.0
	 *
	 * @return array $available_widgets Available widgets.
	 */
	private function get_available_widgets() {
		// Get widget controls.
		global $wp_registered_widget_controls;

		// Init the available widgets.
		$available_widgets = array();

		// Loop throught all controls and get available widgets.
		foreach ( $wp_registered_widget_controls as $widget ) {

			// Bail if duplicate.
			if (
				empty( $widget['id_base'] ) ||
				isset( $available_widgets[ $widget['id_base'] ] )
			) {
				continue;
			}

			// Add the widget to available widgets.
			$available_widgets[ $widget['id_base'] ]['id_base'] = $widget['id_base'];
			$available_widgets[ $widget['id_base'] ]['name']    = $widget['name'];
		}

		// Finally return the available widgets.
		return $available_widgets;
	}

	/**
	 * Check if there is a widget with identical settings in the same sidebar.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $widget             Widget settgins.
	 * @param  int    $sidebar_id         The sidebar id..
	 * @param  string $id_base            Widget base id.
	 *
	 * @return bool                      True if exists, false otherwise.
	 */
	private function check_if_widget_already_exists_in_sidebar( $widget, $sidebar_id, $id_base ) {
		// Get all available widgets site supports.
		$available_widgets = $this->get_available_widgets();
		// Get all existing widget instances.
		$widget_instances  = $this->get_widget_instances( $available_widgets );
		// Get existing widgets in this sidebar.
		$sidebars_widgets  = get_option( 'sidebars_widgets' );

		// Does widget with identical settings already exist in same sidebar?
		if (
			isset( $available_widgets[ $id_base ] ) &&
			isset( $widget_instances[ $id_base ] )
		) {
			$sidebar_widgets = isset( $sidebars_widgets[ $sidebar_id ] ) ? $sidebars_widgets[ $sidebar_id ] : array(); // Check Inactive if that's where will go.
			// Loop widgets with ID base.
			$single_widget_instances = ! empty( $widget_instances[ $id_base ] ) ? $widget_instances[ $id_base ] : array();

			foreach ( $single_widget_instances as $check_id => $check_widget ) {
				// Is widget in same sidebar and has identical settings?
				if (
					in_array( "$id_base-$check_id", $sidebar_widgets, true ) &&
					(array) $widget === $check_widget
				) {
					return true;
				}
			}
		}

		return false;
	}
}
