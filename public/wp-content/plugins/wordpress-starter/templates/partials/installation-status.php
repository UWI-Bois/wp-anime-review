<?php
use SiteGround_Wizard\Helper\Helper;

$suffix = Helper::is_shop() ? 'woo' : 'wp';
?>

<h4 class="title banner-title"></h4>
<div class="container container--padding-large container--elevation-1 banner--wizard-<?php echo $suffix ?> <?php echo ( 'failed' === $status['status'] ) ? 'banner--wizard-' . $suffix . '--warning' : '' ?>">
	<div class="flex flex--gutter-none flex--margin-none flex--align-center">
		<div class="box box--direction-row box--sm-12 typography typography--align-center">
			<h3 class="title title--density-compact title--level-3 typography--weight-regular with-color with-color--color-white">
				<?php
				if ( 'failed' === $status['status'] ) {
					esc_html_e( 'SiteBuilder Installation Was Not Complete', 'siteground-wizard' );
				} else {
					if ( Helper::is_shop() ) {
						esc_html_e( 'WooCommerce Starter Available!', 'siteground-wizard' );
					} else {
						esc_html_e( 'WordPress Starter Available!', 'siteground-wizard' );
					}
				}
				?>
			</h3>
			<p class="text text--size-medium typography--weight-light with-color with-color--color-white">
				<?php
				if ( Helper::is_shop() ) {
					esc_html_e( 'Select design, functionality and marketing plugins and start working on your online store right away!', 'siteground-wizard' );
				} else {
					esc_html_e( 'Select design, functionality and marketing plugins and start working on your site right away!', 'siteground-wizard' );
				}
				?>
			</p>

			<?php if ( 'failed' === $status['status'] ) : ?>
				<a href="<?php echo admin_url( 'index.php?page=siteground-wizard&purge-store' ); ?>" class="sg--button button--light button--medium sg-margin-top-medium" type="submit">
					<span class="button__content">
						<span class="button__text">
							<?php esc_html_e( 'Start Over', 'siteground-wizard' ); ?>
						</span>
					</span>
				</a>
				<a href="<?php echo  wp_nonce_url(admin_url( 'admin-ajax.php?action=restart_wizard' ), 'restart_wizard_nonce', 'restart_wizard' ); ?>" data-admin-url="<?php echo admin_url( 'index.php?page=siteground-wizard&purge-store=1' ); ?>" class="sg--button sg-restart-wizard button--light button--medium sg-margin-top-medium" type="submit">
					<span class="button__content">
						<span class="button__text">
							<?php esc_html_e( 'Restart', 'siteground-wizard' ); ?>
						</span>
					</span>
				</a>
			<?php else : ?>
				<a href="<?php echo  wp_nonce_url(admin_url( 'admin-ajax.php?action=restart_wizard' ), 'restart_wizard_nonce', 'restart_wizard' ); ?>" data-admin-url="<?php echo admin_url( 'index.php?page=siteground-wizard' ); ?>" class="sg--button sg-restart-wizard button--light button--medium sg-margin-top-medium" type="submit">
					<span class="button__content">
						<span class="button__text">
							<?php esc_html_e( 'Start Now', 'siteground-wizard' ); ?>
						</span>
					</span>
				</a>
			<?php endif ?>
		</div>
	</div>

	<a href="<?php echo admin_url( 'admin-ajax.php?action=hide_banner' ) ?>" class="sg--button button--small button--link button--white sg--position-top-right sg--hide-mobile sg-button-hide-banner" type="submit">
		<span class="button__content">
			<span class="button__text">
				<?php esc_html_e( 'Don\'t show this again', 'siteground-wizard' ); ?>
			</span>
		</span>
	</a>
</div>
