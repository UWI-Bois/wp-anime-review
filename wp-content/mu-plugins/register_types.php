<?php
/*
  This file defines and registers the required
  custom post types necessary for the Anime
  Review website.
*/

function anime_post_types () {
  register_post_type('anime',
    array(
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'labels' => array(
          'name' => "Animes",
          'add_new_item' => 'Add New Anime',
          'edit_item' => 'Edit Anime',
          'all_items' => 'All Anime',
          'singular_name' => 'Anime'
        ),
        'description' => "Collection of Japanese film, television and comic adaptations.",
        'menu_icon' => 'dashicons-images-alt'
    )
  );

  register_post_type('genre',
    array(
      'public' => true,
      'supports' => array('title', 'editor', 'excerpt'),
      'labels' => array (
        'name' => "Genres",
        'add_new_item' => 'Add New Genre',
        'edit_item' => 'Edit Genre',
        'all_items' => 'All Genre',
        'singular_name' => 'Genre'
      ),
      'description' => "Describes the nature of the story telling and type of plot of some creative work.",
      'menu_icon' => 'dashicons-editor-kitchensink'
    )
  );

  register_post_type('anime_review',
    array(
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'labels' => array(
          'name' => "Anime Reviews",
          'add_new_item' => 'Add New Anime Review',
          'edit_item' => 'Edit Anime Review',
          'all_items' => 'All Anime Review',
          'singular_name' => 'Anime Review'
        ),
        'description' => "Collection of Japanese film, television and comic adaptations.",
        'menu_icon' => 'dashicons-format-quote'
    )
  );
}

add_action('init', 'anime_post_types')

?>
