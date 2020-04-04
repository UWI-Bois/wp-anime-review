<?php
namespace SiteGround_Wizard\Importer;

use SiteGround_Wizard\Wizard\Wizard;
use SiteGround_Wizard\Installer\Installer;
use SiteGround_Wizard\Importer\Wie_Importer;

/**
 * Importer functions and main initialization class.
 */
class Importer {
	/**
	 * The name of the plugin sub-directory/file.
	 *
	 * @since 1.0.0
	 */
	const IMPORTER_PLUGIN = 'wordpress-importer/wordpress-importer.php';

	/**
	 * WordPress filesystem.
	 *
	 * @var 1.0.0
	 */
	private $wp_filesystem;

	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->setup_wp_filesystem();

		add_action( 'rest_api_init', array( $this, 'register_importer_routes' ) );
	}

	/**
	 * Register importer rest routes.
	 *
	 * @since  1.0.0
	 */
	public function register_importer_routes() {
		register_rest_route(
			Wizard::REST_NAMESPACE, '/import-sample-data/', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'pre_import' ),
			)
		);
	}

	/**
	 * Import sample data to WordPress.
	 *
	 * @since  1.0.0
	 *
	 * @param  object $request Request data.
	 *
	 * @return bool True on error, false on success.
	 */
	public function pre_import( $request ) {
		// Remove item from queue.
		Installer::remove_from_queue( $request['id'] );

		// Install importer plugin if it's not installed.
		$this->install_importer_if_missing();

		return $this->import( $request );
	}

	/**
	 * Start the import
	 *
	 * @since  1.0.0
	 *
	 * @param  array $data Array containing information about the import.
	 */
	private function import( $data ) {
		// Build the importer class name.
		$class = sprintf(
			__NAMESPACE__ . '\%s_Importer_%s',
			! empty( $data['item_type'] ) ? ucwords( $data['item_type'] ) : '',
			! empty( $data['name'] ) ? ucwords( $data['name'] ) : ''
		);

		// Init the importer.
		$importer = ( class_exists( $class ) ) ? new $class() : $this;

		// Save the xml data into temp file.
		$filename = $this->create_and_get_temp_filename( $data['url'] );

		// Bail if the temp file doesn't exists.
		if ( empty( $filename ) ) {
			wp_send_json_error();
		}


		switch ( $data['data_type'] ) {
			case 'xml':
				$status = $importer->import_xml( $filename );
				break;

			case 'json':
				$status = $importer->import_json( $this->wp_filesystem->get_contents( $filename ) );
				break;

			case 'wie':
				$status = $importer->import_wie( $this->wp_filesystem->get_contents( $filename ) );
				break;

			case 'txt':
				$status = $importer->import_options( $this->wp_filesystem->get_contents( $filename ) );
				break;
		}

		// Delete the temp file.
		$this->wp_filesystem->delete( $filename );

		if ( false === $status ) {
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Import and update options
	 *
	 * @since  1.0.0
	 *
	 * @param  string $commands Commands to execute.
	 *
	 * @return bool True on error, false on success.
	 */
	public function import_options( $commands ) {
		exec(
			$commands,
			$output,
			$status
		);

		// Check for errors during the import.
		if ( ! empty( $status ) ) {
			return true;
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
		// Try to import the sample data.
		exec(
			sprintf(
				'wp import %s --authors=skip',
				escapeshellarg( $url )
			),
			$output,
			$status
		);

		// Check for errors during the import.
		if ( ! empty( $status ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Import sample data to WordPress.
	 *
	 * @since  1.0.0
	 *
	 * @param  object $wie wie data.
	 *
	 * @return bool True on error, false on success.
	 */
	public function import_wie( $wie ) {
		// Bail if provided wie empty.
		if ( empty( $wie ) ) {
			return true;
		}

		$wie_importer = new Wie_Importer();

		// Import the wie settings.
		return $wie_importer->import( json_decode( $wie ) );
	}

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
		return false;
	}

	/**
	 * Create a temp file using the content of external url.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $url The url to xml.
	 *
	 * @return string|false $temp_filename Path to temp file. False on failure.
	 */
	private function create_and_get_temp_filename( $url ) {
		// Get the WordPress uploads dir.
		$upload_dir = wp_upload_dir();

		// Get the file content.
		$contents = $this->wp_filesystem->get_contents( $url );

		// Build the temp filename.
		$temp_filename = $upload_dir['basedir'] . '/' . basename( $url );

		// Save the content to temp file.
		$status = $this->wp_filesystem->put_contents(
			$temp_filename, // Temp filename.
			$contents // File content.
		);

		// Bail if the file cannot be saved.
		if ( false === $status ) {
			return false;
		}

		// Finally return the temp filename.
		return $temp_filename;

	}

	/**
	 * Install WordPress Importer if it's not active.
	 *
	 * @since  1.0.0
	 */
	private function install_importer_if_missing() {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( ! \is_plugin_active( self::IMPORTER_PLUGIN ) ) {
			exec( 'wp plugin install wordpress-importer --activate --force --version=0.6.4' );
		}
	}

	/**
	 * Load the global wp_filesystem.
	 *
	 * @since  1.0.0
	 */
	private function setup_wp_filesystem() {
		global $wp_filesystem;

		// Initialize the WP filesystem, no more using 'file-put-contents' function.
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		$this->wp_filesystem = $wp_filesystem;
	}
}
