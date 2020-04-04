<?php
$theme = wp_get_theme();
$pages = wp_count_posts( 'page' );
?>
<h4 class="title title--density-cozy title-manage-design title--level-4 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-large">
	<?php esc_html_e( 'Manage Design', 'siteground-wizard' ); ?>
</h4>
<div class="flex flex--gutter-none flex--margin-none">
	<div class="box box--sm-4 with-padding with-padding--padding-right-medium mobile-side-reset">
		<div class="container container--padding-large container--elevation-1">
			<div class="flex flex--align-center flex--gutter-none flex--direction-column flex--margin-none">

				<span class="icon" style="width: 46px; height: 46px">
				   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 44"><path d="M43,0H3A3,3,0,0,0,0,3V41a3,3,0,0,0,3,3H43a3,3,0,0,0,3-3V3A3,3,0,0,0,43,0Zm1,41a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V11H44ZM2,9V3A1,1,0,0,1,3,2H43a1,1,0,0,1,1,1V9Z" fill="#c1aa95"/><path d="M23,14H5V39H23ZM21,37H7V16H21Z" fill="#c1aa95"/><path d="M41,14H26V25H41Zm-2,9H28V16H39Z" fill="#c1aa95"/><path d="M41,28H26V39H41Zm-2,9H28V30H39Z" fill="#c1aa95"/><circle cx="5.5" cy="5.5" r="1.5" fill="#c1aa95"/><circle cx="10.5" cy="5.5" r="1.5" fill="#c1aa95"/><circle cx="15.5" cy="5.5" r="1.5" fill="#c1aa95"/></svg>
				</span>

				<h4 class="title title--density-none title--level-4 typography typography--weight-bold with-color with-color--color-darkest sg-margin-top-medium"><?php esc_html_e( 'View Site', 'siteground-wizard' ) ?></h4>

				<p class="text text--size-medium typography typography--weight-regular typography--align-center with-color with-color--color-dark sg-margin-bottom-medium">
					<?php esc_html_e( 'Check out how your website looks!', 'siteground-wizard' ) ?>
				</p>

				<a href="<?php echo get_home_url( '/' ) ?>" target="_blank" class="sg--button button--primary button--medium">
					<span class="button__content">
						<span class="button__text">
							<?php esc_html_e( 'View Site', 'siteground-wizard' ) ?>
						</span>
					</span>
				</a>
			</div>
		</div>
	</div>

	<?php if ( $pages->publish > 0 ): ?>
		<div class="box box--sm-4 with-padding with-padding--padding-left-x-small with-padding--padding-right-x-small mobile-side-reset">
			<div class="container container--padding-large container--elevation-1">
				<div class="flex flex--align-center flex--gutter-none flex--direction-column flex--margin-none">
					<span class="icon" style="width: 46px; height: 46px">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 44"><path d="M15.23,13.21a3.91,3.91,0,0,0,.76.07,4,4,0,0,0,.78-7.93,4,4,0,0,0-4.7,4.7A4,4,0,0,0,15.23,13.21Zm-.64-5.34A1.94,1.94,0,0,1,16,7.28a1.81,1.81,0,0,1,.4,0,2,2,0,0,1,1,3.38,2,2,0,1,1-2.82-2.83Z" transform="translate(0 -0.28)" fill="#c1aa95"/><path d="M43,3.28H37v-1a2,2,0,0,0-2-2H8a2,2,0,0,0-2,2v1H3a3,3,0,0,0-3,3v35a3,3,0,0,0,3,3H43a3,3,0,0,0,3-3v-35A3,3,0,0,0,43,3.28ZM36.59,26.5,35.43,27a1,1,0,0,0-.33,1.64l3.55,3.55-.71.72-3.56-3.55a1,1,0,0,0-.7-.3l-.2,0a1,1,0,0,0-.73.61l-.46,1.15-2.58-6.88ZM8,2.78a.5.5,0,0,1,.5-.5h26a.5.5,0,0,1,.5.5v16.5l-9.09-7.66a1,1,0,0,0-.75-.34,1,1,0,0,0-.74.33l-7.86,8.64-2.73-3.41a1,1,0,0,0-1.49-.08L8,21.11ZM8,23.93l5-5,2.76,3.45a1,1,0,0,0,.75.37.93.93,0,0,0,.77-.33l7.89-8.68L35,21.87v1.9l-6.65-2.49a1,1,0,0,0-1.06.23,1,1,0,0,0-.23,1.06l2.52,6.71H8.5a.5.5,0,0,1-.5-.5ZM44,41.28a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1v-35a1,1,0,0,1,1-1H6v24a2,2,0,0,0,2,2H30.33l1,2.64a1,1,0,0,0,.93.65,1,1,0,0,0,.94-.63L34,31.8,37.23,35a1,1,0,0,0,.71.29,1,1,0,0,0,.7-.29l2.13-2.13a1,1,0,0,0,.3-.71,1,1,0,0,0-.3-.71l-3.18-3.18,2.14-.86a1,1,0,0,0,0-1.86l-2.71-1V5.28h6a1,1,0,0,1,1,1Z" transform="translate(0 -0.28)" fill="#c1aa95"/></svg>
					</span>
					<h4 class="title title--density-none title--level-4 typography typography--weight-bold with-color with-color--color-darkest sg-margin-top-medium">
						<?php esc_html_e( 'Manage Pages', 'siteground-wizard' ) ?>
					</h4>
					<p class="text text--size-medium typography typography--weight-regular typography--align-center with-color with-color--color-dark sg-margin-bottom-medium">
						<?php esc_html_e( 'Edit and create new Pages', 'siteground-wizard' ) ?>
					</p>
					<a href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>" class="sg--button button--primary button--medium">
						<span class="button__content">
							<span class="button__text">
								<?php esc_html_e( 'Manage Pages', 'siteground-wizard' ) ?>
							</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	<?php endif ?>

	<?php if ( ! empty( $theme ) ) : ?>
		<div class="box box--sm-4 with-padding with-padding--padding-left-medium mobile-side-reset">
			<div class="container container--padding-large container--elevation-1">
				<div class="flex flex--align-center flex--gutter-none flex--direction-column flex--margin-none">
					<span class="icon" style="width: 48px; height: 46px">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46"><path d="M23,46A23,23,0,0,1,20.8.11a22.48,22.48,0,0,1,8.48.76,5.35,5.35,0,0,1,3.37,2.8,6,6,0,0,1,.19,4.83,7.39,7.39,0,0,0-.28,4.29,7.18,7.18,0,0,0,5.12,5.29h0a7.89,7.89,0,0,0,2.47.23,5.32,5.32,0,0,1,4.14,1.54A5.59,5.59,0,0,1,46,24.12,14.9,14.9,0,0,1,45.87,26,23.19,23.19,0,0,1,26,45.83,24.15,24.15,0,0,1,23,46ZM23,2a13.6,13.6,0,0,0-2,.1A21,21,0,1,0,43.87,25.76C44,25.18,44,24.61,44,24a3.63,3.63,0,0,0-1.11-2.73,3.35,3.35,0,0,0-2.59-1A9.92,9.92,0,0,1,37.26,20h0a9.19,9.19,0,0,1-6.6-6.79A9.32,9.32,0,0,1,31,7.78a4,4,0,0,0-.11-3.22,3.41,3.41,0,0,0-2.14-1.77A20.72,20.72,0,0,0,23,2Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M23,12a4,4,0,1,1,4-4A4,4,0,0,1,23,12Zm0-5.87A1.87,1.87,0,1,0,24.87,8,1.87,1.87,0,0,0,23,6.13Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M13,17a4,4,0,1,1,4-4A4,4,0,0,1,13,17Zm0-5.87A1.87,1.87,0,1,0,14.87,13h0A1.87,1.87,0,0,0,13,11.14Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M9,28a4,4,0,1,1,4-4A4,4,0,0,1,9,28Zm0-5.87A1.87,1.87,0,1,0,10.87,24h0A1.87,1.87,0,0,0,9,22.14Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M15,39a4,4,0,1,1,4-4A4,4,0,0,1,15,39Zm0-5.87A1.87,1.87,0,1,0,16.87,35h0A1.87,1.87,0,0,0,15,33.14Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M28,41a4,4,0,1,1,4-4A4,4,0,0,1,28,41Zm0-5.87A1.87,1.87,0,1,0,29.87,37h0A1.87,1.87,0,0,0,28,35.14Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M37,33a4,4,0,1,1,4-4A4,4,0,0,1,37,33Zm0-5.87A1.87,1.87,0,1,0,38.87,29h0A1.87,1.87,0,0,0,37,27.14Z" transform="translate(-0.04 0)" fill="#c1aa95"/><path d="M24,29a6,6,0,1,1,6-6A6,6,0,0,1,24,29Zm0-9.85A3.85,3.85,0,1,0,27.85,23,3.85,3.85,0,0,0,24,19.15Z" transform="translate(-0.04 0)" fill="#c1aa95"/></svg>
					</span>
					<h4 class="title title--density-none title--level-4 typography typography--weight-bold with-color with-color--color-darkest sg-margin-top-medium">
						<?php esc_html_e( 'Change Design', 'siteground-wizard' ) ?>
					</h4>
					<p class="text text--size-medium typography typography--weight-regular typography--align-center with-color with-color--color-dark sg-margin-bottom-medium">
						<?php printf( __("Your current theme is %s", 'siteground-wizard' ), $theme->name ); ?>
					</p>
					<a href="<?php echo admin_url( 'themes.php' ); ?>" class="sg--button button--primary button--medium">
						<span class="button__content">
							<span class="button__text">
								<?php esc_html_e( 'Change Theme', 'siteground-wizard' ) ?>
							</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>