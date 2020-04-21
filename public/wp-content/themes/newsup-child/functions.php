<?php


//=========== CUSTOM CODE FOR GROUP PROJECT =================

// Enqueue parent theme
// Code taken from wordpress.org
// Ref: https://developer.wordpress.org/themes/advanced-topics/child-themes/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Remove default wordpress roles
add_action( 'init', 'rm_custom_roles');
function rm_custom_roles(){
    remove_role( 'author' );
    remove_role( 'editor' );
    remove_role( 'subscriber' );
    remove_role( 'contributor' );
}

/**
 * Merge two arrays using the PHP version 
 * and then return the merged array.
 *
 * @param array $dest
 * @param array $val
 * @return array [...$dest, $val]
 */
function array_push_aux($dest=[], $val=[]) {
    array_push($dest, $val);
    return $dest;
}

/**
 * This function overrides the default WP_Query 
 * object as the primary query for a subset of 
 * template files: specifically the archives.
 * 
 * E.g. When the archive.php and author.php for example 
 * use the default WP_Query object as the primary 
 * query which only searches for Page and Post 
 * default post types.
 *
 * @param [WP_Query] $query
 * @return void
 */
function adjust_archive_index_query($query) {
    // We exclude the custom post types from the check 
    // as the archive-$posttype.php already overrites 
    // the WP_Query that is used for those pages.
    if ((is_home() || is_archive()) && !is_post_type_archive($post_types=['anime', 'genre', 'anime_review'])):
        // This condition is true on the archive.php and author.php templates.
        $query->set('post_type', ['anime', 'genre', 'anime_review']);
    endif;
}
add_action('pre_get_posts', 'adjust_archive_index_query');

?>
