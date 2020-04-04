<?php
$plugins            = array();
$functionality_data = file_get_contents( SiteGround_Wizard\DIR . '/misc/functionality.json' );
$functionality      = json_decode( $functionality_data, true );

foreach ( $functionality['special_offers'] as $offer ) {
	$show = get_option( $offer['option_name'] );

	if ( ! empty( $show ) ) {
		continue;
	}

	if (
		'orders' === $offer['condition'] &&
		function_exists( 'wc_get_orders' )
	) {
		$orders = wc_get_orders( array( 'post_status' => 'wc-completed' ) );

		if ( $offer['condition_value'] > count( $orders ) ) {
			continue;
		}
	}

	if ( 'time' === $offer['condition'] ) {
		$time = get_option( 'siteground_wizard_install_timestamp' );

		if (
			! empty( $time ) &&
			( time() - $time ) < $offer['condition_value']
		) {
			continue;
		}
	}

	if (
		is_plugin_active( $offer['active_plugin'] ) &&
		! is_plugin_active( $offer['inactive_plugin'] )
	) {
		$offer['special'] = 1;
		$offer['link'] = add_query_arg( 'nonce', wp_create_nonce( $offer['nonce'] ), $offer['link'] );

		$plugins[] = $offer;
	}
}

foreach ( $functionality['active_plugins'] as $plugin_data ) {
	if ( ! is_plugin_active( $plugin_data['plugin_name'] ) ) {
		continue;
	}

	$plugins[] = $plugin_data;
}


if ( empty( $plugins ) ) {
	return;
}
?>
<h4 class="title title--density-cozy title--level-4 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-large"><?php esc_html_e( 'Manage Functionality', 'siteground-wizard' ); ?></h4>
<div style="width: 100%;">
	<div class="container container--padding-medium container--elevation-1 with-padding with-padding--padding-top-medium with-padding--padding-right-x-small with-padding--padding-bottom-none with-padding--padding-left-x-small">
		<div class="flex flex--gutter-medium flex--margin-none with-padding with-padding--padding-top-none with-padding--padding-right-none with-padding--padding-bottom-none with-padding--padding-left-none">
			<?php foreach ( $plugins as $plugin_data ) : ?>
				<div class="box box--direction-row box--sm-3 with-padding with-padding--padding-top-none with-padding--padding-right-x-small with-padding--padding-bottom-medium with-padding--padding-left-x-small mobile-space-reset <?php echo ! empty( $plugin_data['special'] ) ? 'special-offer' : '' ?>">
					<div class="container container--padding-none container--elevation-none with-border">
						<?php if ( ! empty( $plugin_data['special'] ) ) : ?>
							<div class="sg-card-label">
								<span class="sg-label sg-label--type-active-outlined sg-label--size-small">
									special offer
								</span>
							</div>
						<?php endif ?>

						<?php if ( ! empty( $plugin_data['special'] ) ) : ?>
							<a href="<?php echo admin_url( 'admin-ajax.php?action=hide_box&box=' . $plugin_data['option_name'] ) ?>" class="sg-close-button sg-icon-button sg-icon-button--neutral sg-icon-button--small sg-icon-button--circle sg-icon--topright">
								<span class="sg-icon sg-icon--fill-lighter sg-icon--use-css-colors sg-with-color sg-with-color--color-light sg-icon-button__icon" size="16" style="width: 12px; height: 12px;">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18"><path d="M16.35 2.35l-.7-.7L9 8.29 2.35 1.65l-.7.7L8.29 9l-6.64 6.65.7.7L9 9.71l6.65 6.64.7-.7L9.71 9l6.64-6.65z"></path></svg>
								</span>
							</a>
						<?php endif ?>
						<div class="flex flex--align-center flex--gutter-medium flex--direction-column flex--margin-none with-padding with-padding--padding-top-medium with-padding--padding-right-none with-padding--padding-bottom-medium with-padding--padding-left-none">
							<span class="icon" style="width: <?php echo $plugin_data['icon']['width']; ?>px; height: <?php echo $plugin_data['icon']['height']; ?>px;">
								<img src="<?php echo SiteGround_Wizard\URL . $plugin_data['icon']['file']; ?>" width="<?php echo $plugin_data['icon']['width']; ?>" height="<?php echo $plugin_data['icon']['height']; ?>">
							</span>
							<h5 class="title title--density-cozy title--level-5 typography typography--weight-bold typography--align-center with-color with-color--color-darkest"><?php esc_html_e( $plugin_data['title'], 'siteground-wizard' ); ?></h5>
							<a href="<?php echo admin_url( $plugin_data['link'] ); ?>" data-alt-link="<?php echo admin_url( $plugin_data['link_alt'] ) ?>" class="sg--button button--primary button--small <?php echo $plugin_data['button_style']; ?>" type="submit" style="max-width: 200px;">
								<span class="button__content">
									<span class="button__text" data-alt-text="<?php echo $plugin_data['button_text_alt'] ?>">
										<?php esc_html_e( $plugin_data['button_text'], 'siteground-wizard' ); ?>
									</span>
								</span>
							</a>
						</div>
					</div>
						<?php
						if ( !empty( $plugin_data['popup'] ) ) {
							echo '<div class="sg-modals">';
								include 'popup.php';
							echo '</div>';
						}
						?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>