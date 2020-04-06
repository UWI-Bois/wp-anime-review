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
		hello 123
	</div>
	<div id="sidebar-right" class="mg-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->
