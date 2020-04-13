<?php
$newsup_background_image = get_theme_support( 'custom-header', 'default-image' );

if ( has_header_image() ) {
    $newsup_background_image = get_header_image();
}
?>
