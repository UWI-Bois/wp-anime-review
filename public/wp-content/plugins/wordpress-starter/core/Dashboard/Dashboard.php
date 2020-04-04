<?php
namespace SiteGround_Wizard\Dashboard;

/**
 * Dashboard functions and main initialization class.
 */
class Dashboard {
	/**
	 * The constructor. It does the following:
	 *      1. Create the new page.
	 *      2. Remove the old page.
	 *      3. Change the order of submenu page.
	 *      3. Highlight the menu item when "Dashboard" is selected.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$hide_dashboard = get_option( 'siteground_wizard_hide_custom_dashboard', 'no' );

		// Bail if the usser has switched to default dashboard.
		if ( 'yes' === $hide_dashboard ) {
			return;
		}

		$this->run();
	}

	/**
	 * Run the dashboard functionalities.
	 *
	 * @since  1.0.0
	 */
	private function run() {
		// Add the new submenu page.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 1 );
		// Remove the original page, since we are going to use our custom page.
		add_action( 'admin_menu', array( $this, 'remove_original_page' ), 999 );
		// Reorder submenu pages to replicate the initial order.
		add_filter( 'custom_menu_order', array( $this, 'reorder_submenu_pages' ) );
		// Change the parent_file in order to highlight the new menu item
		// when "Dashboard" is the currently selected item.
		add_action( 'submenu_file', array( $this, 'highlight_menu_item' ) );

		// Redirect to our custom dashboard.
		add_action( 'admin_init', array( $this, 'redirect_to_dashboard' ), 1 );

		// Load the assets.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_ajax_hide_banner', array( $this, 'hide_banner' ) );
		add_action( 'wp_ajax_hide_notifications', array( $this, 'hide_notifications' ) );

		add_action( 'wp_before_admin_bar_render', array( $this, 'add_dashboard_admin_bar_menu_item' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'reorder_admin_bar' ) );
		add_action( 'wp_head', array( $this, 'additional_admin_bar_css' ) );
	}

	/**
	 * Add additional styles to WordPress admin bar.
	 *
	 * @since  1.0.0
	 */
	public function additional_admin_bar_css() {
		if ( is_user_logged_in() && is_admin_bar_showing() ) :
		?>
			<style type="text/css">
				#wpadminbar ul li#wp-admin-bar-siteground-wizard-dashboard { padding-top: 12px; }
			</style>
		<?php
		endif;
	}

	/**
	 * Remove initial dashboard item from admin bar menu
	 * and add our custom dashboard menu item.
	 *
	 * @since 1.0.0
	 */
	public function add_dashboard_admin_bar_menu_item() {

		global $wp_admin_bar;

		// Remove the initial dashboard menu item.
		$wp_admin_bar->remove_node( 'dashboard' );

		// Add our custom dashboard item.
		$wp_admin_bar->add_menu(
			array(
				'id'     => 'siteground-wizard-dashboard',
				'title'  => 'Dashboard',
				'href'   => get_admin_url( null, 'admin.php?page=custom-dashboard.php' ),
				'parent' => 'appearance',
			)
		);
	}

	/**
	 * Reorder admin bar menu to match the inital order.
	 *
	 * @since  1.0.0
	 */
	public function reorder_admin_bar() {
		global $wp_admin_bar;

		// The desired order of identifiers (items).
		$ids = array(
			'siteground-wizard-dashboard',
			'themes',
			'widgets',
			'menus',
		);

		// Get an array of all the toolbar items on the current page.
		$nodes = $wp_admin_bar->get_nodes();

		// Perform recognized identifiers.
		foreach ( $ids as $id ) {
			if ( ! isset( $nodes[ $id ] ) ) {
				continue;
			}

			// This will cause the identifier to act as the last menu item.
			$wp_admin_bar->remove_menu( $id );
			$wp_admin_bar->add_node( $nodes[ $id ] );

			// Remove the identifier from the list of nodes.
			unset( $nodes[ $id ] );
		}

		// Unknown identifiers will be moved to appear after known identifiers.
		foreach ( $nodes as $id => &$obj ) {
			// There is no need to organize unknown children identifiers (sub items).
			if ( ! empty( $obj->parent ) ) {
				continue;
			}

			// This will cause the identifier to act as the last menu item.
			$wp_admin_bar->remove_menu( $id );
			$wp_admin_bar->add_node( $obj );
		}

	}


	/**
	 * Add option that will be used to check if the dashboard banner should be shown.
	 *
	 * @since  1.0.0
	 */
	public function hide_banner() {
		update_option( 'siteground_wizard_hide_main_banner', 'yes' );
	}

	/**
	 * Add option that will be used to check if the dashboard banner should be shown.
	 *
	 * @since  1.0.0
	 */
	public function hide_notifications() {
		$themes       = get_theme_updates();
		$plugins      = get_plugin_updates();
		$core         = get_core_updates();
		$translations = wp_get_translation_updates();
		$new_hash     = md5( serialize( $themes ) . serialize( $plugins ) . serialize( $core[0]->response ) . serialize( $translations ) );

		update_option( 'siteground_wizard_hide_notifications', 'yes' );
		update_option( 'updates_available', $new_hash );
	}

	/**
	 * Redirect to custom dashboard after successful installation.
	 *
	 * @since  1.0.0
	 */
	public function redirect_to_dashboard() {
		global $pagenow;

		// Bail if the current user is not admin.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$status = get_option( 'siteground_wizard_installation_status' );

		// Delete plugin transients on inital dashboard rendering.
		if ( isset( $_GET['hard-redirect'] ) ) {
			$this->delete_plugins_redirect_transients();
		}

		if (
			( isset( $_GET['page'] ) && 'siteground-wizard' === $_GET['page'] && ! empty( $status ) && 'completed' === $status['status'] ) ||
			'index.php' === $pagenow && empty( $_GET )
		) {
			wp_safe_redirect( admin_url( 'admin.php?page=custom-dashboard.php' ) );
			exit;
		}
	}

	/**
	 * Delete all plugin redirect transients,
	 * to prevent redirects to their pages.
	 *
	 * @since  1.0.0
	 */
	private function delete_plugins_redirect_transients() {
		$transients = array(
			'wpforms_activation_redirect',
			'_tribe_events_activation_redirect',
		);

		foreach ( $transients as $transient ) {
			$response = delete_transient( $transient );
		}
	}

	/**
	 * Return custom dashboard menu slug.
	 *
	 * @since  1.0.0
	 *
	 * @return string The menu sluf od our custom dashboard page.
	 */
	public function get_menu_slug() {
		return 'custom-dashboard.php';
	}

	/**
	 * Remove the original "Home" page.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function remove_original_page() {
		remove_submenu_page( 'index.php', 'index.php' );
	}

	/**
	 * Change the order of index.php submenu pages.
	 * Since our custom page has been added late, we need to reorder
	 * the submenu page, so that we can match the initial order.
	 *
	 * Example:
	 *          "SiteGround Wizard"
	 *          "Update core"
	 *
	 * @since  1.0.0
	 *
	 * @param  bool $menu_order Flag if the menu order is enabled.
	 *
	 * @return bool $menu_order Flag if the menu order is enabled.
	 */
	public function reorder_submenu_pages( $menu_order ) {
		// Load the global submenu.
		global $submenu;

		// Bail if for some reason the submenu is empty.
		if ( empty( $submenu ) ) {
			return;
		}

		// Try to get our custom page index.
		foreach ( $submenu['index.php'] as $key => $value ) {
			if ( 'custom-dashboard.php' === $value[2] ) {
				$page_index = $key;
			}
		}

		// Bail if our custom page is missing in `$submenu` for some reason.
		if ( empty( $page_index ) ) {
			return $menu_order;
		}

		// Store the custom dashboard in variable.
		$dashboard_menu_item = $submenu['index.php'][ $page_index ];

		// Remove the original custom dashboard page.
		unset( $submenu['index.php'][ $page_index ] );

		// Add the custom dashboard page in the beginning.
		array_unshift( $submenu['index.php'], $dashboard_menu_item );

		// Finally return the menu order.
		return $menu_order;
	}

	/**
	 * Set the parent file to index.php in order to hightlight
	 * the menu item when "Dashboard" menu item is selected.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $parent_file The parent file name.
	 *
	 * @return string $parent_file The modified parent file name.
	 */
	public function highlight_menu_item( $parent_file ) {
		// Get the current screen.
		$current_screen = get_current_screen();

		// Check whether is the custom dashboard page
		// and change the `parent_file` to custom-dashboard.php.
		if ( 'dashboard_page_custom-dashboard' == $current_screen->base ) {
			$parent_file = $this->get_menu_slug();
		}

		// Return the `parent_file`.
		return $parent_file;
	}

	/**
	 * Render the submenu page.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function render() {
		require_once( ABSPATH . 'wp-admin/includes/dashboard.php' );

		wp_localize_community_events();

		// Include the partial.
		include \SiteGround_Wizard\DIR . '/templates/custom-dashboard.php';
	}

	/**
	 * Retrieve the page option from database.
	 *
	 * @since  1.0.0
	 *
	 * @return string Yes/No Whether to display or not the custom page.
	 */
	public function get_option_value() {
		return get_option( 'siteground-wizard-display-dashboard-page' );
	}

	/**
	 * The `admin_menu` callback. Will call {@link add_submenu_page} to add the
	 * page to the admin menu.
	 *
	 * @since 1.0.0
	 *
	 * @return false|string The resulting page's hook_suffix, or false if the user does not have the capability required.
	 */
	public function admin_menu() {
		// Add the sub-menu page.
		$page = add_submenu_page(
			'index.php',
			__( 'Home', 'siteground-wizard' ),
			__( 'Home', 'siteground-wizard' ),
			'manage_options',
			$this->get_menu_slug(),
			array( $this, 'render' )
		);

		// Finally return the page hook_suffix.
		return $page;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		// Bail if we are on different page.
		if ( false === $this->is_dashboard_page() ) {
			return;
		}

		wp_enqueue_style(
			'siteground-wizard-dashboard',
			\SiteGround_Wizard\URL . '/assets/css/dashboard.css',
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
		// Bail if we are on different page.
		if ( false === $this->is_dashboard_page() ) {
			return;
		}

		wp_enqueue_script( 'dashboard' );
	}

	/**
	 * Check if this is the Dashboard page.
	 *
	 * @since  1.0.0
	 *
	 * @return bool True/False
	 */
	private function is_dashboard_page() {
		$current_screen = \get_current_screen();

		if (
			'dashboard_page_custom-dashboard' !== $current_screen->id &&
			'dashboard_page_custom-dashboard-network' !== $current_screen->id
		) {
			return false;
		}

		return true;
	}

}
