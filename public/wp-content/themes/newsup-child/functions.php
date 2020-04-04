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

// These functions below override existing hooks in
// the parent theme. These functions specifically
// deal with injected HTML/PHP code for the use of
// content sections such as the Homepage Banner, and
// other advanced content blocks.
//
// NOTE:  CHILD THEMES LOAD BEFORE PARENT THEMES AND
//        THUS CAN OVERRIDE THEIR FUNCTIONS. THIS IS
//        CALLED REPLUGGING A HOOK FROM THE PARENT.
//
// This function is called whenever the theme requests
// the content section for the banner of trending posts
// on the homepage. This function is originall located
// in ../newsup/inc/hooks/hooks.php and has been copied
// here to be overriden.
if (!function_exists('newsup_banner_trending_posts')):
    /**
     *
     * @since newsup 1.0.0
     *
     */
    function newsup_banner_exclusive_posts()  {
            if (is_front_page() || is_home()) {
                $show_flash_news_section = newsup_get_option('show_flash_news_section');
            if ($show_flash_news_section):
        ?>
            <section class="mg-latest-news-sec">
                <?php
                $category = newsup_get_option('select_flash_news_category');
                $number_of_posts = newsup_get_option('number_of_flash_news');
                $newsup_ticker_news_title = newsup_get_option('flash_news_title');

                $all_posts = newsup_get_posts($number_of_posts, $category);
                $show_trending = true;
                $count = 1;

                // This code will provide a query on Custom Post Type: Anime
                // to be used by this module. Modifications were made to use
                // the custom query instead of the original $all_posts obejct.
                $anime_posts = new WP_Query(array('post_type' => 'anime', 'orderby' => 'date'));
                ?>
                <div class="container-fluid">
                    <div class="mg-latest-news">
                         <div class="bn_title">
                            <h2>
                                <?php if (!empty($newsup_ticker_news_title)): ?>
                                    <?php echo esc_html($newsup_ticker_news_title); ?><span></span>
                                <?php endif; ?>
                            </h2>
                        </div>
                        <div class="mg-latest-news-slider marquee">
                            <?php
                            if ($anime_posts->have_posts()) :
                                while ($anime_posts->have_posts()) : $anime_posts->the_post();
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <span><?php the_title(); ?></span>
                                     </a>
                                    <?php
                                    $count++;
                                endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Excluive line END -->
        <?php endif;
         }
    }
endif;

?>
