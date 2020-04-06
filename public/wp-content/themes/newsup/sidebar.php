<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newsup
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<button type="button" class="search-trigger">Open Live Search</button>
	<div class="search-overlay">
		<div class="search-overlay__top">
			<div class="container">
				<input type="text"
					class="search-term"
					placeholder="Find your favourite anime"
					id="search-term"/>
				<i class="fa fa-window-close search-overlay__close" ariahidden="true"></i>
			</div>
		</div>
	</div>
	<div id="sidebar-right" class="mg-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
