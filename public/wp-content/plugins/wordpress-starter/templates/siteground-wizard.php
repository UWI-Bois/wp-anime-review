<?php
namespace SiteGround_Wizard;

use SiteGround_Wizard\Helper\Helper;
use SiteGround_Wizard\Wizard\Wizard;

include_once(ABSPATH.'wp-admin/includes/plugin.php');
?>
<!doctype html>
<html>
<head>
	<!-- Defining responsive ambient. -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php esc_html_e( 'WordPress Starter', 'wordlift' ); ?></title>
</head>
<body>
	<div id="app"></div>
</body>
	<?php
		wp_enqueue_script(
			'siteground-wizard-bundle',
			\SiteGround_Wizard\URL . '/assets/js/wizard.bundle.js',
			array( 'jquery' ), // Dependencies.
			\SiteGround_Wizard\VERSION
		);

		$current_user = wp_get_current_user();
		$locale       = get_user_locale( $current_user );
		preg_match( '~([a-zA-Z]+)_?~', $locale, $matches );
		$data = array(
			'ip'                    => Helper::get_ip_address(),
			'installation_endpoint' => get_rest_url( null, Wizard::REST_NAMESPACE . '/installer/' ),
			'visibility_endpoint'   => get_rest_url( null, Wizard::REST_NAMESPACE . '/update-visibility/' ),
			'status_endpoint'       => add_query_arg( 'nocache', '', get_rest_url( null, Wizard::REST_NAMESPACE . '/installer-progress/' ) ),
			'dashboard_url'         => get_admin_url( null, 'admin.php?page=custom-dashboard.php&hard-redirect' ),
			'site_url'              => get_site_url( '/' ),
			'update_visibility'     => get_option( 'siteground_wizard_activation_redirect', 'yes' ),
			'queue'                 => get_option( 'siteground_wizard_installation_queue', array() ),
			'locale'                => $matches[1],
			'wp_nonce'              => wp_create_nonce( 'wp_rest' ),
			'persist_key'           => md5( get_home_url( '/' ) . get_option( 'siteground_wizard_install_timestamp', false ) ),
			'config'                => array(
				'assetsPath' => \SiteGround_Wizard\URL . '/assets/img',
			),
			'strings'               => array(
				'start_wizard'          => __( 'Start Now', 'siteground-wizard' ),
				'exit_wizard'           => __( 'Exit', 'siteground-wizard' ),
				'free'                  => __( 'Free', 'siteground-wizard' ),
				'days'                  => __( 'Days', 'siteground-wizard' ),
				'default'               => __( 'Default', 'siteground-wizard' ),
				'continue'              => __( 'Continue', 'siteground-wizard' ),
				'view_site'             => __( 'View Site', 'siteground-wizard' ),
				'plugin_by'             => __( 'plugin by', 'siteground-wizard' ),
				'previous'              => __( 'previous', 'siteground-wizard' ),
				'select'                => __( 'Select', 'siteground-wizard' ),
				'close'                 => __( 'Close', 'siteground-wizard' ),
				'confirm'               => __( 'Confirm', 'siteground-wizard' ),
				'selected'              => __( 'Selected', 'siteground-wizard' ),
				'search_placeholder'    => __( 'Type a keyword...', 'siteground-wizard' ),
				'currently_selected'    => __( 'Currently selected', 'siteground-wizard' ),
				'categories_title'      => __( 'Categories', 'siteground-wizard' ),
				'plugin_by'             => __( 'plugin by', 'siteground-wizard' ),
				'recommended'           => __( 'recommended', 'siteground-wizard' ),
				'required'              => __( 'required', 'siteground-wizard' ),
				'builders_title'        => __( 'Great design choice!', 'siteground-wizard' ),
				'builders_subtitle'     => __( 'The design you have chosen comes with sample data that is enabled by { pluginNames }. In order to keep the sample data, including all the pages and overall look and structure of the selected design, we will install { pluginNames } on your site.', 'siteground-wizard' ),
				'installation_title'    => __( 'Installing, please don\'t close or refresh this page.', 'siteground-wizard' ),
				'installation_subtitle' => __( 'Please, don’t close this window, we will finish shortly!', 'siteground-wizard' ),
				'success_title'         => __( 'Congrats! Your site is ready!', 'siteground-wizard' ),
				'success_subtitle'      => __( 'We have successfully completed the installation of the items you selected. You may now proceed to your WordPress dashboard and start managing your site.', 'siteground-wizard' ),
				'fail_title'            => __( 'Oops! Something went wrong!', 'siteground-wizard' ),
				'fail_subtitle'         => __( 'We have not managed to completed the installation of the items you selected. Please restart the process or activate the wizard later.', 'siteground-wizard' ),
				'dashboard_button_text' => __( 'Go to Dashboard', 'siteground-wizard' ),
				'restart_button_text'   => __( 'Restart Installation', 'siteground-wizard' ),
				'select_theme'          => __( 'Select theme', 'siteground-wizard' ),
				'load_more'             => __( 'Load More', 'siteground-wizard' ),
				'init_message'          => __( 'Preparing your WordPress installation...', 'siteground-wizard' ),
			),
			'plugins'                => array(
				'wpforms-lite'        => __( 'Contact Form', 'siteground-wizard' ),
				'the-events-calendar' => __( 'Calendar', 'siteground-wizard' ),
				'wp-google-maps'      => __( 'Maps', 'siteground-wizard' ),
				'foogallery'          => __( 'Gallery', 'siteground-wizard' ),
				'woocommerce'         => __( 'Shop', 'siteground-wizard' ),
				'wordpress-seo'       => __( 'Optimize for SEO', 'siteground-wizard' ),
				'optinmonster'        => __( 'Grow Subscribers List', 'siteground-wizard' ),
			),
			'tags'                   => array(
				'all'              => __( 'All', 'siteground-wizard' ),
				'Business'         => __( 'Business', 'siteground-wizard' ),
				'Travel'           => __( 'Travel', 'siteground-wizard' ),
				'Online-store'     => __( 'Online-store', 'siteground-wizard' ),
				'Portfolio'        => __( 'Portfolio', 'siteground-wizard' ),
				'Wedding'          => __( 'Wedding', 'siteground-wizard' ),
				'Magazine'         => __( 'Magazine', 'siteground-wizard' ),
				'Fashion & Beauty' => __( 'Fashion & Beauty', 'siteground-wizard' ),
				'Blog'             => __( 'Blog', 'siteground-wizard' ),
				'Art & Design'     => __( 'Art & Design', 'siteground-wizard' ),
				'Health & Fitness' => __( 'Health & Fitness', 'siteground-wizard' ),
				'Photography'      => __( 'Photography', 'siteground-wizard' ),
				'Restaurant'       => __( 'Restaurant', 'siteground-wizard' ),
			),
		);


		if ( 'yes' === get_option( 'siteground_wizard_reseller' ) ) {
			$data['is_reseller'] = 'yes';
		}

		if ( Helper::is_shop() ) {
			$data['is_woo_setup'] = 1;
		}

		wp_localize_script( 'siteground-wizard-bundle', 'wizardData', $data );

		// Finally print the scripts.
		wp_print_scripts();
	?>
</html>
