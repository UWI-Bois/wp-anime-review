<?php
use SiteGround_Wizard\Helper\Helper;

$is_shop = Helper::is_shop() ? true : false;
?>
<h4 class="title title--density-cozy title--level-4 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-large"><?php esc_html_e( 'Useful Links', 'siteground-wizard' ) ?></h4>
<div style="width: 100%;" class="useful-links">
	<div class="flex flex--gutter-none flex--margin-none">
		
		<?php
		if (
			empty( $status ) ||
			! empty( $status ) && 'completed' !== $status['status']
		) :
		?>
			<div class="box box--sm-6 with-padding with-padding--padding-top-none  with-padding--padding-bottom-large mobile-side-reset mobile-space-reset">
				<div class="container container--padding-none container--elevation-1 with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-x-small with-padding--padding-bottom-large">
					<div class="flex flex--align-center flex--gutter-none flex--direction-row flex--margin-none">
						<div class="box box--direction-row box--sm-9">
							<h6 class="title title--density-cozy title--level-6 typography typography--weight-bold with-color with-color--color-dark">
								<?php
								if ( $is_shop ) {
									esc_html_e( 'USE OUR WOOCOMMERCE STARTER FOR AN EASIER START!', 'siteground-wizard' );
								} else {
									esc_html_e( 'USE OUR WORDPRESS STARTER FOR AN EASIER START!', 'siteground-wizard' );
								}
								?>
							</h6>
							<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark">
								<?php
								if ( $is_shop ) {
									esc_html_e( 'Our WooCommerce Starter allows you to choose a fancy design and add plugins with important functionality for your site. It installs and sets up all the items you chose.', 'siteground-wizard' );
								} else {
									esc_html_e( 'Our WordPress Starter allows you to choose a fancy design and add plugins with important functionality for your site. It installs and sets up all the items you chose.', 'siteground-wizard' );
								}
								?>
							</p>
							<a href="<?php echo admin_url( 'index.php?page=siteground-wizard' ); ?>" class="link sg-margin-top-x-small">
								<?php esc_html_e( 'Start Now', 'siteground-wizard' ); ?>
							</a>
						</div>
						<div class="box box--sm-3 typography--align-center">
							<span class="icon sg--hide-mobile" style="width: 80px">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 85"><path d="M83.59,44.76l-1.4-2.54c-.32,0-.65,0-1-.07l-1.74,2.36-6.19-3.09L74,38.49l0,0c-.22-.23-.46-.49-.69-.77l-2.86.37-2.23-6.54,2.54-1.4c0-.32,0-.65.07-1L68.49,27.4l3.09-6.19,2.93.76h0c.23-.22.49-.46.77-.69l-.37-2.86,6.54-2.24,1.41,2.57c.33,0,.64.05,1,.09l1.77-2.41,6.19,3.1L91,22.47l0,0,.63.73,2.89-.38,2.25,6.57L94.23,30.8c0,.33,0,.65-.06,1l2.41,1.77-3.1,6.19-3-.77,0,0c-.23.21-.47.43-.72.63l.38,2.9Zm-3.66-5.95,1,.24a8.37,8.37,0,0,0,2.17.18H84l1,1.88,1.84-.63-.29-2.25.78-.51a12.17,12.17,0,0,0,1.16-1l.69-.6.6-.5,2.1.55.88-1.75L91,33.14l.13-1a7.41,7.41,0,0,0,.09-2l-.12-1L93.16,28l-.62-1.81-2.24.29-.52-.78a12.17,12.17,0,0,0-1-1.16c-.2-.23-.41-.46-.6-.69l-.49-.6.55-2.1-1.76-.88L85.2,22l-1.14-.15A16.81,16.81,0,0,0,82,21.71h-.89l-1-1.88-1.84.63.3,2.32-.87.5a6,6,0,0,0-1.07.86c-.23.22-.46.44-.7.64l-.59.49-2.11-.55-.88,1.76,1.89,1.39-.24,1A8.76,8.76,0,0,0,73.77,31v.89l-1.88,1,.63,1.84,2.32-.3.5.87a5.68,5.68,0,0,0,.87,1.07c.21.23.43.46.63.7l.5.59-.55,2.11,1.75.88Z" transform="translate(-17 -15)" fill="#bfa893"/><circle cx="65.53" cy="15.47" r="4.16" fill="#ebdbc3"/><path d="M82.53,36.13a5.66,5.66,0,0,1-5.19-7.91,5.65,5.65,0,1,1,5.19,7.91Zm0-8.32a2.5,2.5,0,0,0-1,.19,2.66,2.66,0,1,0,2,4.94A2.62,2.62,0,0,0,85,31.53h0a2.67,2.67,0,0,0,0-2,2.65,2.65,0,0,0-2.47-1.68Z" transform="translate(-17 -15)" fill="#bfa893"/><path d="M28,37a1.12,1.12,0,0,1-1.12-1.12,8.77,8.77,0,0,0-8.76-8.76,1.12,1.12,0,0,1,0-2.24,8.77,8.77,0,0,0,8.76-8.76,1.12,1.12,0,0,1,2.24,0,8.77,8.77,0,0,0,8.76,8.76,1.12,1.12,0,0,1,0,2.24,8.77,8.77,0,0,0-8.76,8.76A1.12,1.12,0,0,1,28,37ZM22.94,26A11.07,11.07,0,0,1,28,31.06,11.07,11.07,0,0,1,33.06,26,11.07,11.07,0,0,1,28,20.94,11.07,11.07,0,0,1,22.94,26Z" transform="translate(-17 -15)" fill="#e4cdac"/><path d="M46,16a4,4,0,1,1-4,4,4,4,0,0,1,4-4" transform="translate(-17 -15)" fill="#e4cdac"/><path d="M60,21a3,3,0,1,1-3,3,3,3,0,0,1,3-3" transform="translate(-17 -15)" fill="#e4cdac"/><path d="M72.54,100H41.46A1.48,1.48,0,0,1,40,98.68,1.5,1.5,0,0,1,41.11,97c.07,0,6.66-1.79,6.66-5.54A1.48,1.48,0,0,1,49.23,90H64.77a1.48,1.48,0,0,1,1.46,1.5c0,3.75,6.59,5.53,6.66,5.54A1.5,1.5,0,0,1,74,98.68,1.48,1.48,0,0,1,72.54,100ZM47.8,97H66.2a7.63,7.63,0,0,1-2.71-4h-13A7.58,7.58,0,0,1,47.8,97Z" transform="translate(-17 -15)" fill="#bfa893"/><rect y="20" width="80" height="58" rx="6" ry="6" fill="#fff"/><path d="M91,38a3,3,0,0,1,3,3V87a3,3,0,0,1-3,3H23a3,3,0,0,1-3-3V41a3,3,0,0,1,3-3H91m0-3H23a6,6,0,0,0-6,6V87a6,6,0,0,0,6,6H91a6,6,0,0,0,6-6V41a6,6,0,0,0-6-6Z" transform="translate(-17 -15)" fill="#bfa893"/><rect x="45" y="59" width="25" height="3" fill="#bfa893"/><rect x="45" y="53" width="24" height="3" fill="#bfa893"/><rect x="45" y="47" width="22" height="3" fill="#bfa893"/><rect x="49" y="33" width="25" height="11" fill="#ebdbc3"/><path d="M86,47v7H65V47H86m3-3H62V57H89V44Z" transform="translate(-17 -15)" fill="#bfa893"/><path d="M27.27,61A13.72,13.72,0,0,0,35,73.35L28.46,55.41A13.73,13.73,0,0,0,27.27,61Zm23-.69a7.18,7.18,0,0,0-1.14-3.79,6.46,6.46,0,0,1-1.34-3.22,2.37,2.37,0,0,1,2.3-2.43h.18a13.72,13.72,0,0,0-20.74,2.58l.89,0c1.43,0,3.65-.18,3.65-.18a.57.57,0,0,1,.09,1.13s-.74.09-1.57.13l5,14.87,3-9-2.14-5.86c-.74,0-1.44-.13-1.44-.13a.57.57,0,0,1,.09-1.13s2.27.18,3.62.18,3.66-.18,3.66-.18a.57.57,0,0,1,.08,1.13s-.74.09-1.57.13l5,14.76,1.37-4.58A12.69,12.69,0,0,0,50.27,60.31Zm-9,1.89-4.12,12A13.72,13.72,0,0,0,45.56,74a1.14,1.14,0,0,1-.1-.19ZM53,54.41a10.43,10.43,0,0,1,.1,1.42,12.84,12.84,0,0,1-1,4.91L47.9,72.86A13.71,13.71,0,0,0,54.72,61,13.48,13.48,0,0,0,53,54.41Z" transform="translate(-17 -15)" fill="#bfa893"/><path d="M25,61A16,16,0,1,0,41,45,16,16,0,0,0,25,61Zm.73,0A15.27,15.27,0,1,1,41,76.27,15.29,15.29,0,0,1,25.73,61Z" transform="translate(-17 -15)" fill="#bfa893"/><rect x="3" y="68" width="74" height="3" fill="#bfa893"/></svg>
							</span>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>

		<div class="box box--sm-6 with-padding with-padding--padding-top-none  with-padding--padding-bottom-large mobile-side-reset mobile-space-reset">
			<div class="container container--padding-none container--elevation-1 with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-x-small with-padding--padding-bottom-large">
				<div class="flex flex--align-center flex--gutter-none flex--direction-row flex--margin-none">
					<div class="box box--sm-9">
						<h6 class="title title--density-cozy title--level-6 typography typography--weight-bold with-color with-color--color-dark">
							<?php esc_html_e( 'Take advantage of our WordPress Tutorial!', 'siteground-wizard' ); ?>
						</h6>
						<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark">
							<?php esc_html_e( 'We have prepared an easy to follow tutorial with everything you need to know about setting up your WordPress site, creating posts and pages, making backups and a lot more.', 'siteground-wizard' ) ?>
						</p>
						<a href="<?php _e( 'https://www.siteground.com/tutorials/wordpress/', 'siteground-wizard' ) ?>" target="_blank" class="link sg-margin-top-x-small">
							<?php esc_html_e( 'View WordPress Tutorial', 'siteground-wizard' ); ?>
						</a>
					</div>
					<div class="box box--sm-3 typography--align-center">
						<span class="icon sg--hide-mobile" style="width: 80px">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 74"><path d="M36,100a1.12,1.12,0,0,1-1.12-1.12,8.77,8.77,0,0,0-8.76-8.76,1.12,1.12,0,1,1,0-2.24,8.77,8.77,0,0,0,8.76-8.76,1.12,1.12,0,1,1,2.24,0,8.77,8.77,0,0,0,8.76,8.76,1.12,1.12,0,0,1,0,2.24,8.77,8.77,0,0,0-8.76,8.76A1.12,1.12,0,0,1,36,100ZM30.94,89A11.07,11.07,0,0,1,36,94.06,11.07,11.07,0,0,1,41.06,89,11.07,11.07,0,0,1,36,83.94,11.07,11.07,0,0,1,30.94,89Z" transform="translate(-25 -31)" fill="#e4cdac"/><path d="M105,86a4,4,0,1,1-4-4,4,4,0,0,1,4,4" transform="translate(-25 -31)" fill="#e4cdac"/><path d="M105,73a3,3,0,1,1-3-3,3,3,0,0,1,3,3" transform="translate(-25 -31)" fill="#e4cdac"/><path d="M95,96a6,6,0,1,1-6-6,6,6,0,0,1,6,6" transform="translate(-25 -31)" fill="#e4cdac"/><path d="M63,34V31H60v3H25v3h3V78H25v3H55L45,103v2h3v-2L58,81h2v24h3V81h2l10,22v2h3v-2L68,81H98V78H95V37h3V34ZM92,78H31V37H92Z" transform="translate(-25 -31)" fill="#c1aa95"/><rect x="38.08" y="13" width="20" height="3" fill="#c1aa95"/><rect x="38" y="20" width="14" height="3" fill="#c1aa95"/><rect x="38" y="27" width="17" height="3" fill="#c1aa95"/><rect x="38" y="34" width="20" height="3" fill="#c1aa95"/><rect x="12.78" y="39" width="20" height="3" fill="#c1aa95"/><path d="M37.56,55a9.44,9.44,0,0,0,5.32,8.49l-4.5-12.33A9.44,9.44,0,0,0,37.56,55Zm15.81-.48a5,5,0,0,0-.78-2.6,4.38,4.38,0,0,1-.92-2.21A1.63,1.63,0,0,1,53.25,48h.12a9.42,9.42,0,0,0-14.25,1.78h.6c1,0,2.52-.12,2.52-.12a.39.39,0,0,1,.06.78s-.51.06-1.08.08L44.65,60.8l2.07-6.2-1.47-4c-.51,0-1-.08-1-.08a.39.39,0,0,1,.06-.78s1.56.12,2.49.12,2.51-.12,2.51-.12a.39.39,0,0,1,.06.78s-.51.06-1.08.08l3.41,10.15.94-3.15A8.72,8.72,0,0,0,53.37,54.52Zm-6.2,1.3-2.84,8.23a9.42,9.42,0,0,0,2.67.39,9.27,9.27,0,0,0,3.13-.54l-.06-.13Zm8.11-5.35a7.43,7.43,0,0,1,.06,1,9,9,0,0,1-.71,3.38l-2.89,8.34a9.43,9.43,0,0,0,3.54-12.69Z" transform="translate(-25 -31)" fill="#c1aa95"/><path d="M36,55A11,11,0,1,0,47,44,11,11,0,0,0,36,55Zm.5,0A10.5,10.5,0,1,1,47,65.5,10.51,10.51,0,0,1,36.5,55Z" transform="translate(-25 -31)" fill="#c1aa95"/></svg>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="box box--sm-6 with-padding with-padding--padding-top-none mobile-side-reset mobile-space-reset ">
			<div class="container container--padding-none container--elevation-1 with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-x-small with-padding--padding-bottom-large">
				<div class="flex flex--gutter-none flex--direction-row flex--margin-none">
					<div class="box box--sm-9">
						<h6 class="title title--density-cozy title--level-6 typography typography--weight-bold with-color with-color--color-dark">
							<?php esc_html_e( 'Visit our WordPress Knowledge Base', 'siteground-wizard' ); ?>
						</h6>
						<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark">
							<?php esc_html_e( 'If you have a how to question about WordPress it’s quite likely that we already have the answer for you in our Knowledge Base. It contains more than 1000 helpful articles.', 'siteground-wizard' ) ?>
						</p>
						<a href="<?php _e( 'https://www.siteground.com/kb/', 'siteground-wizard' ) ?>" target="_blank" class="link sg-margin-top-x-small">
							<?php esc_html_e( 'Visit Knowledge Base', 'siteground-wizard' ); ?>
						</a>
					</div>
					<div class="box box--sm-3 typography--align-center">
						<span class="icon sg--hide-mobile" style="width: 80px">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 88"><path d="M94,38a1.12,1.12,0,0,1-1.12-1.12,8.77,8.77,0,0,0-8.76-8.76,1.12,1.12,0,0,1,0-2.24,8.77,8.77,0,0,0,8.76-8.76,1.12,1.12,0,0,1,2.24,0,8.77,8.77,0,0,0,8.76,8.76,1.12,1.12,0,1,1,0,2.24,8.77,8.77,0,0,0-8.76,8.76A1.12,1.12,0,0,1,94,38ZM88.94,27A11.07,11.07,0,0,1,94,32.06,11.07,11.07,0,0,1,99.06,27,11.07,11.07,0,0,1,94,21.94,11.07,11.07,0,0,1,88.94,27Z" transform="translate(-25 -16)" fill="#e4cdac"/><path d="M32,29a4,4,0,1,1-4,4,4,4,0,0,1,4-4" transform="translate(-25 -16)" fill="#e4cdac"/><path d="M36,16a3,3,0,1,1-3,3,3,3,0,0,1,3-3" transform="translate(-25 -16)" fill="#e4cdac"/><path d="M31,45a6,6,0,1,1-6,6,6,6,0,0,1,6-6" transform="translate(-25 -16)" fill="#e4cdac"/><rect x="4" y="81" width="76" height="7" fill="#edddc5"/><rect x="35" y="65" width="15" height="7" fill="#edddc5"/><path d="M105,68H85V37L72,23H43V68H25v35h80ZM46,26H71L82,38V68H46Zm56,45V93H28V71ZM28,100V96h74v4Z" transform="translate(-25 -16)" fill="#c1aa95"/><path d="M74,87H56V77H74ZM59,84H71V80H59Z" transform="translate(-25 -16)" fill="#c1aa95"/><rect x="24" y="19" width="16" height="3" fill="#c1aa95"/><rect x="24" y="25" width="25" height="3" fill="#c1aa95"/><rect x="24" y="31" width="20" height="3" fill="#c1aa95"/><rect x="24" y="37" width="25" height="3" fill="#c1aa95"/><rect x="24" y="43" width="16" height="3" fill="#c1aa95"/></svg>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="box box--sm-6 with-padding with-padding--padding-top-none mobile-side-reset mobile-space-reset">
			<div class="container container--padding-none container--elevation-1 with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-x-small with-padding--padding-bottom-large">
				<div class="flex flex--gutter-none flex--direction-row flex--margin-none">
					<div class="box box--sm-9">
						<h6 class="title title--density-cozy title--level-6 typography typography--weight-bold with-color with-color--color-dark">
								<?php
								if ( $is_shop ) {
									esc_html_e( 'Read our WooCommerce Ebooks', 'siteground-wizard' );
								} else {
									esc_html_e( 'Read our WordPress Ebooks', 'siteground-wizard' );
								}
								?>
						</h6>
						<p class="text text--size-medium typography typography--weight-regular with-color with-color--color-dark">
								<?php
								if ( $is_shop ) {
									esc_html_e( 'Our top experts have shared their know how on WooCommerce in а specialized ebook. Take advantage of their knowledge and make your site faster and safer.', 'siteground-wizard' );
								} else {
									esc_html_e( 'Our top experts have shared their know how on WordPress in specialized ebooks on different topics. Take advantage of their knowledge and make your site faster and safer.', 'siteground-wizard' );
								}
								?>
						</p>
						<?php if ( $is_shop ): ?>
							<a href="<?php _e( 'https://www.siteground.com/woocommerce-ebook?utm_source=wpdashboard', 'siteground-wizard' ) ?>" target="_blank" class="link sg-margin-top-x-small">
						<?php else: ?>
							<a href="<?php _e( 'https://www.siteground.com/wordpress-speed-optimization-ebook?utm_source=wpdashboard&utm_campaign=ebookwpspeed', 'siteground-wizard' ) ?>" target="_blank" class="link sg-margin-top-x-small">
						<?php endif ?>
							<?php esc_html_e( 'Get the Latest Ebook', 'siteground-wizard' ) ?>
						</a>
					</div>
					<div class="box box--sm-3 typography--align-center">
						<span class="icon sg--hide-mobile" style="width: 80px">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 96"><path d="M79.7,103.64,73,97.5l-6.7,6.14a1.39,1.39,0,0,1-2.3-1.13V83H82v19.51A1.39,1.39,0,0,1,79.7,103.64Z" transform="translate(-10 -8)" fill="#edddc5"/><path d="M69,39a1.12,1.12,0,0,1-1.12-1.12,8.77,8.77,0,0,0-8.76-8.76,1.12,1.12,0,1,1,0-2.24,8.77,8.77,0,0,0,8.76-8.76,1.12,1.12,0,0,1,2.24,0,8.77,8.77,0,0,0,8.76,8.76,1.12,1.12,0,1,1,0,2.24,8.77,8.77,0,0,0-8.76,8.76A1.12,1.12,0,0,1,69,39ZM63.94,28A11.07,11.07,0,0,1,69,33.06,11.07,11.07,0,0,1,74.06,28,11.07,11.07,0,0,1,69,22.94,11.07,11.07,0,0,1,63.94,28Z" transform="translate(-10 -8)" fill="#e4cdac"/><path d="M25,94a4,4,0,1,1-4,4,4,4,0,0,1,4-4" transform="translate(-10 -8)" fill="#e4cdac"/><path d="M13,87a3,3,0,1,1-3,3,3,3,0,0,1,3-3" transform="translate(-10 -8)" fill="#e4cdac"/><path d="M42,92a6,6,0,1,1-6,6,6,6,0,0,1,6-6" transform="translate(-10 -8)" fill="#e4cdac"/><path d="M30,8A9.76,9.76,0,0,0,20,18V78a8,8,0,0,0,8,8H54.5A1.5,1.5,0,0,0,56,84.5h0A1.5,1.5,0,0,0,54.5,83H28c-3,0-5-3-5-5,0-3.2,1.83-6,5-6H87V83H85.5A1.5,1.5,0,0,0,84,84.5h0A1.5,1.5,0,0,0,85.5,86H90V8ZM28,69a7.76,7.76,0,0,0-5,2V18c0-4.47,2.57-7,7-7H87V69Z" transform="translate(-10 -8)" fill="#c1aa95"/><rect x="20" y="7" width="3" height="49" rx="1.5" ry="1.5" fill="#c1aa95"/><path d="M60,78V99.94A2.06,2.06,0,0,0,62.06,102a2.11,2.11,0,0,0,1.56-.7L70,96l6.38,5.3a2.11,2.11,0,0,0,1.56.7A2.06,2.06,0,0,0,80,99.94V78ZM77,97l-7-6-7,6V81H77Z" transform="translate(-10 -8)" fill="#c1aa95"/></svg>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
