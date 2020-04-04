<?php
namespace SiteGround_Wizard\Importer;

use SiteGround_Wizard\Helper\Helper;

$themes      = get_theme_updates();
$plugins     = get_plugin_updates();
$core        = get_core_updates();
$status      = get_option( 'siteground_wizard_installation_status', array( 'status' => '' ) );
$hide_banner = get_option( 'siteground_wizard_hide_main_banner', 'no' );
?>
<div class="page dashboard-page">
	<div class="section section--content-size-default">
		<div class="section__content">
			<h1 class="title title--density-comfortable title--level-1 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-x-small">
				<?php esc_html_e( 'Dashboard', 'siteground-wizard' ); ?>
			</h1>

			<?php
			// Do not show the banner if the installation was successful.
			if (
				'completed' !== $status['status'] &&
				'no' === $hide_banner
			) {
				include( 'partials/installation-status.php' );
			}

			// Display the notifications section only if there are updates available.
			if ( true === Helper::updates_available() ) {
				include( 'partials/notifications.php' );
			}

			include( 'partials/manage-design.php' );
			include( 'partials/manage-functionality.php' );
			include( 'partials/useful-links.php' );
			include( 'partials/news-and-events.php' );
			?>
			<p class="switch-do-default-dashboard">
				<?php
				echo sprintf(
					__( 'If you wish you can always <a href="%1$s" class="switch-dashboard" data-admin-url="%2$s">switch to default</a> dashboard.', 'siteground-wizard' ),
					wp_nonce_url( admin_url( 'admin-ajax.php?action=switch_dashboard&value=yes' ), 'switch_dashboard_nonce', 'switch_dashboard' ),
					admin_url( '/' )
				);
				?>
	
		</p>
		</div>
	</div>
</div>