<?php
/*
  This file defines and registers the required
  custom post types necessary for the Anime
  Review website.
*/

// When Wordpress is initialized, it will call
// this function to register three new post types 
// required for this website.
add_action('init', 'anime_post_types');
function anime_post_types () {
  register_post_type('anime',
    array(
        'public' => true,
        'has_archive' => true,
        'supports' => array('thumbnail', 'title', 'editor', 'excerpt'),
        'labels' => array(
          'name' => "Animes",
          'add_new_item' => 'Add New Anime',
          'edit_item' => 'Edit Anime',
          'all_items' => 'All Anime',
          'singular_name' => 'Anime',
        ),
        'description' => "Collection of Japanese film, television and comic adaptations.",
        'menu_icon' => 'dashicons-images-alt',
        'capability_type' => 'anime', //set custom permissions to be used with custom roles (created with plugin by MemberPress)
        'map_meta_cap' => true,
    )
  );

  register_post_type('genre',
    array(
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt'),
      'labels' => array (
        'name' => "Genres",
        'add_new_item' => 'Add New Genre',
        'edit_item' => 'Edit Genre',
        'all_items' => 'All Genre',
        'singular_name' => 'Genre',
      ),
      'description' => "Describes the nature of the story telling and type of plot of some creative work.",
      'menu_icon' => 'dashicons-editor-kitchensink',
      'rewrite' => array('slug' => 'genres'),
      'capability_type' => 'genre', 
      'map_meta_cap' => true,
    )
  );

  register_post_type('anime_review',
    array(
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt', 'comments'),
        'labels' => array(
          'name' => "Anime Reviews",
          'add_new_item' => 'Add New Anime Review',
          'edit_item' => 'Edit Anime Review',
          'all_items' => 'All Anime Review',
          'singular_name' => 'Anime Review',
        ),
        'description' => "Collection of Japanese film, television and comic adaptations.",
        'menu_icon' => 'dashicons-format-quote',
        'rewrite' => array('slug' => 'reviews'),
        'capability_type' => 'anime_review',
        'map_meta_cap' => true
    )
  );
}


?>
