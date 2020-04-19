<?php


//=========== CUSTOM CODE FOR GROUP PROJECT =================

// Enqueue parent theme
// Code taken from wordpress.org
// Ref: https://developer.wordpress.org/themes/advanced-topics/child-themes/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Remove default wordpress roles, and add custom ones
add_action( 'init', 'set_custom_roles');
function set_custom_roles(){
    remove_role( 'author' );
    remove_role( 'editor' );
    remove_role( 'subscriber' );
    remove_role( 'contributor' );
    add_role( 'animeAuthor', 'Anime Author', array(
        'delete_posts' => true,
        'delete_published_posts' => true,
        'edit_posts' => true,
        'edit_published_posts' => true,
        'publish_posts' => true,
        'read' => true,
        'upload_files' => true
    ) );
    add_role( 'animeEditor', 'Anime Editor', array(
        'delete_others_pages' => true,
        'delete_others_posts' => true,
        'delete_pages' => true,
        'delete_posts' => true,
        'delete_private_pages' => true,
        'delete_private_posts' => true,
        'delete_published_pages' => true,
        'delete_published_posts' => true,
        'edit_others_pages' => true,
        'edit_others_posts' => true,
        'edit_pages' => true,
        'edit_posts' => true,
        'edit_private_pages' => true,
        'edit_private_posts' => true,
        'edit_published_pages' => true,
        'edit_published_posts' => true,
        'manage_categories' => true,
        'manage_links' => true,
        'moderate_comments' => true,
        'publish_pages' => true,
        'publish_posts' => true,
        'read' => true,
        'read_private_pages' => true,
        'read_private_posts' => true,
        'upload_files' => true
    ) );
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
