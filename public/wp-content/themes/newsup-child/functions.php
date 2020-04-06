<?php


    //=========== CUSTOM CODE FOR GROUP PROJECT =================

    // Code partially taken from wordpress.org
    // Ref: https://developer.wordpress.org/themes/advanced-topics/child-themes/
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
    function my_theme_enqueue_styles() {
        // Enqueue parent styles
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
        wp_style_add_data('newsup-style', 'rtl', 'replace');
        wp_enqueue_style('newsup-default', get_template_directory_uri() . '/css/colors/default.css');
        wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
        wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

        // Enqueue parent scripts
        wp_enqueue_script('newsup-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
        wp_enqueue_script('owl-carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'));
        wp_enqueue_script('smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));
        wp_enqueue_script('smartmenus-bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));
        wp_enqueue_script('newsup-main-js', get_template_directory_uri() . '/js/jquery.marquee.js' , array('jquery'));
        wp_enqueue_script('newsup-main-js', get_template_directory_uri() . '/js/main.js' , array('jquery'));
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

    // Add live search script
    add_action( 'init', 'enqueue_live_search' );
    function enqueue_live_search(){
        wp_enqueue_script( 'live_search', './wp-content/themes/newsup-child/js/livesearch.js', array('jquery'));
    }

?>
