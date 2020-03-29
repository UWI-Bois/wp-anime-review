<?php // Footer copyright section 
function newsup_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('newsup_copyright', array(
		'priority' => 100,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings', 'newsup'),
	) );

    		
}
add_action( 'customize_register', 'newsup_footer_copyright' );