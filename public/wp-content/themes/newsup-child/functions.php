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

?>
