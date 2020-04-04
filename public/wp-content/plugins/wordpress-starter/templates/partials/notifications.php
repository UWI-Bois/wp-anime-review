<h4 class="title title--density-cozy title-notifications title-maybe-hidden title--level-4 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-large">
	<?php esc_html_e( 'Important Notifications', 'siteground-wizard' ) ?>
</h4>
<div class="container container--padding-none container--elevation-1 with-padding with-padding--padding-right-large with-padding--padding-left-large important--notifications">
	<div class="flex flex--gutter-none flex--align-center flex--direction-row with-padding with-padding--padding-top-medium with-padding--padding-bottom-medium">
		<div class="box box--sm-9 box--xs-12">
			<div class="flex flex--gutter-none flex--align-center flex--direction-row flex--flex-wrap-nowrap mobile--remove-nowrap">
				<div class="box box--direction-row with-padding with-padding--padding-right-medium sg--hide-mobile">
					<span class="icon" style="width: 32px; height: 32px;">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 36"><path d="M28.92,23h-.5V15a10.77,10.77,0,0,0-7-10.38V4a5,5,0,0,0-5-5,4.88,4.88,0,0,0-5,5v.65A10.85,10.85,0,0,0,4.42,15v8h-.5a3.5,3.5,0,1,0,0,7h6.63a6,6,0,0,0,5.87,5c3.18,0,5.13-2.39,5.81-5h6.69a3.5,3.5,0,0,0,0-7ZM16.42,1a2.93,2.93,0,0,1,3,3h-6A2.89,2.89,0,0,1,16.42,1Zm0,32a3.93,3.93,0,0,1-3.79-3h7.5A4,4,0,0,1,16.42,33Zm12.5-5h-25a1.5,1.5,0,1,1,0-3h2.5V15c0-4.38,2.54-7.57,7.16-9h5.69c4.54,1.24,7.15,4.51,7.15,9V25h2.5a1.5,1.5,0,0,1,0,3Z" transform="translate(-0.42 1.02)" fill="#c1aa95"/><path d="M18.93,8.12a1,1,0,0,0-1.37.34,1,1,0,0,0,.34,1.38c4.51,2.7,4.48,6.24,4,9A1,1,0,0,0,22.64,20h.19a1,1,0,0,0,1-.81C24.42,16.08,24.57,11.5,18.93,8.12Z" transform="translate(-0.42 1.02)" fill="#c1aa95"/></svg>
					</span>
				</div>
				<div class="box box--direction-row">
					<h6 class="title title--density-compact title--level-6 typography typography--weight-bold with-color with-color--color-dark">
						<?php esc_html_e( 'Your WordPress Needs Attention!', 'siteground-wizard' ) ?>
					</h6>

					<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark">
						<?php esc_html_e( 'There are new updates for your website. Check them out and apply the new versions to keep your site updated and secure!', 'siteground-wizard' ) ?>
					</p>
				</div>
			</div>
		</div>
		<div class="box box--sm-3 box--xs-12">
			<div class="flex flex--gutter-none flex--align-center flex--direction-row flex--justify-flex-end mobile--remove-justify">
				<a href="<?php echo admin_url( 'update-core.php' ) ?>" class="sg--button button--primary button--small" type="submit">
					<span class="button__content">
						<span class="button__text">
							<?php esc_html_e( 'Update', 'siteground-wizard' ) ?>
						</span>
					</span>
				</a>
                <a href="<?php echo admin_url( 'admin-ajax.php?action=hide_notifications' ) ?>" class="sg--button button--neutral btn--hide-notifications button--small">
					<span class="button__content">
						<span class="icon icon--use-current-color with-color with-color--color-lighter">
                            <svg viewBox="0 0 32 32"><polygon points="20.7,16.2 32,27.5 27.5,32 16.2,20.7 4.5,32 0,27.5 11.3,16.2 0,4.5 4.5,0 16.2,11.3 27.5,0 32,4.5 "></polygon></svg>
                        </span>
					</span>
                </a>
			</div>
		</div>
	</div>
</div>