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
	<div class="search-overlay search-overlay--active">
		<div class="search-overlay__top">
			<div class="container">
				<input type="text"
					class="search-term"
					placeholder="Find your favourite anime"
					id="search-term"/>
			</div>
		</div>
	</div>
	<div id="sidebar-right" class="mg-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
