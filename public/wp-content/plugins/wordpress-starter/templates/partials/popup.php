<?php

use SiteGround_Wizard\Hooks\Hooks;
?>
<div id="<?php echo $plugin_data['nonce']; ?>" class="sg-dialog-wrapper sg-dialog-wrapper--animation-open sg-popup sg-popup-hidden">
    <div class="sg-dialog sg-dialog--align-center sg-dialog--size-large sg-dialog--density-medium sg-dialog--state-active" tabindex="0">
		<div class="sg-dialog__content-wrapper">
			<div class="sg-dialog__title-wrapper">
				<h3 class="sg-title sg-title--density-compact sg-title--level-3 sg-with-color sg-with-color--color-darkest sg-typography sg-typography--align-center sg-typography--weight-regular sg-dialog__title"><?php echo $plugin_data['popup']['title']; ?></h3>
			</div>
			<div class="sg-dialog__content">
				<?php if ( ! empty( $plugin_data['popup']['logo'] ) ) : ?>
					<div class="flex flex--align-center flex--gutter-medium flex--direction-column flex--margin-none with-padding with-padding--padding-top-medium with-padding--padding-right-none with-padding--padding-bottom-medium with-padding--padding-left-none">
						<div class="container container--padding-large container--elevation-none with-border select-box select-box--align-none select-box--with-border">
							<?php
							$link = $plugin_data['popup']['button']['link'];

							if ( 'install-button' === $plugin_data['popup']['button']['style'] ) {
								$link = add_query_arg( 'nonce', wp_create_nonce( $plugin_data['nonce'] ), $link );
							}

							if ( ! empty( $plugin_data['popup']['logo'] ) ) :
							?>
								<span class="icon sg-icon-steps" style="width: <?php echo $plugin_data['icon']['width']; ?>px; height: <?php echo $plugin_data['icon']['height']; ?>px;">
									<img src="<?php echo SiteGround_Wizard\URL . $plugin_data['popup']['logo']; ?>" width="<?php echo $plugin_data['icon']['width']; ?>" height="<?php echo $plugin_data['icon']['height']; ?>">
								</span>
							<?php
							endif;

							if ( ! empty( $plugin_data['popup']['logo_title'] ) ) :
							?>
								<h5 class="title title--density-cozy title--level-5 typography typography--weight-bold typography--align-center with-color with-color--color-darkest"><?php esc_html_e( $plugin_data['popup']['logo_title'], 'siteground-wizard' ); ?></h5>
							<?php endif; ?>
							<p><?php echo $plugin_data['popup']['description']; ?></p>
						</div>
					</div>
				<?php else: ?>
					<p><?php echo $plugin_data['popup']['description']; ?></p>
				<?php endif ?>
				<div class="sg-grid sg-grid--gap-large sg-grid--autoflow-row sg-grid--sm-2 sg-grid--m-2">
					<?php if ( ! empty( $plugin_data['popup']['steps'] ) ): ?>
						<?php foreach ( $plugin_data['popup']['steps'] as $step ) : ?>
							<div class="container container--padding-large container--elevation-none with-border select-box select-box--align-none select-box--with-border">
								<span class="icon sg-icon-steps" style="">
									<?php
									include( dirname( __FILE__ ) . '/../..' . $step['icon'] );
									?>
								</span>
								<?php
								$link = $step['button']['link'];

								if ( 'sg-affiliate-link' === $link ) {
									$link = Hooks::get_affiliate_link( $plugin_data['nonce'] );
								}


								if ( 'install-button' === $step['button']['style'] ) {
									$link = add_query_arg( 'nonce', wp_create_nonce( $offer['nonce'] ), $link );
								}
								?>
								<h4 class="title title--density-cozy title--level-4 typography typography--weight-bold with-color with-color--color-darkest"><?php echo $step['title']; ?></h4>
								<div class="box box--direction-row ua-border-top ua-padding-medium">
									<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark ua-margin-bottom-medium"><?php echo $step['description']; ?></p>
									<a href="<?php echo $link; ?>" data-alt-link="<?php echo admin_url( $plugin_data['link_alt'] ); ?>" target="<?php echo $step['button']['target']; ?>" class="sg--button button--primary button--small <?php echo $step['button']['style']; ?>" type="submit">
										<span class="button__content" >
											<span class="button__text" data-alt-text="<?php echo $plugin_data['button_text_alt']; ?>">
												<?php echo $step['button']['text']; ?>
											</span>
										</span>
									</a>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>

			</div>
		</div>
		<div class="sg-toolbar sg-toolbar--background-light sg-toolbar--density-comfortable sg-toolbar--align-baseline sg-dialog__toolbar">
			<div>
				<button type="submit" class="sg-ripple-container sg-button sg-button--neutral sg-button--medium sg-popup-close-button">
					<span class="sg-button__content">Close</span>
				</button>
				<?php if ( ! empty( $plugin_data['popup']['button'] ) ) : ?>
					<a href="<?php echo $link; ?>" data-alt-link="<?php echo admin_url( $plugin_data['link_alt'] ); ?>" target="<?php echo $plugin_data['popup']['button']['target']; ?>" class="sg--button button--primary button--small <?php echo $plugin_data['popup']['button']['style']; ?>" type="submit">
						<span class="button__content" >
							<span class="button__text" data-alt-text="<?php echo $plugin_data['button_text_alt']; ?>">
								<?php echo $plugin_data['popup']['button']['text']; ?>
							</span>
						</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
