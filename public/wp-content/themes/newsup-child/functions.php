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
    if (is_archive() && !is_post_type_archive($post_types=['anime', 'genre', 'anime_review'])):
        // This condition is true on the archive.php and author.php templates.
        $query->set('post_type', 'any');
    endif;
}
add_action('pre_get_posts', 'adjust_archive_index_query');

if (!function_exists('newsup_get_terms')):
function newsup_get_terms( $category_id = 0, $taxonomy='category', $default='' ){
    $taxonomy = !empty($taxonomy) ? $taxonomy : 'category';

    if ( $category_id > 0 ) {
            $term = get_term_by('id', absint($category_id), $taxonomy );
            if($term)
                return esc_html($term->name);


    } else {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
        ));


        if (isset($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                if( $default != 'first' ){
                    $array['0'] = __('Select Category', 'newsup');
                }
                $array[$term->term_id] = esc_html($term->name);
            }

            return $array;
        }
    }
}
endif;

/**
 * Returns all categories.
 *
 * @since newsup 1.0.0
 */
if (!function_exists('newsup_get_terms_link')):
function newsup_get_terms_link( $category_id = 0 ){

    if (absint($category_id) > 0) {
        return get_term_link(absint($category_id), 'category');
    } else {
        return get_post_type_archive_link('post');
    }
}
endif;

/**
 * Returns word count of the sentences.
 *
 * @since newsup 1.0.0
 */
if (!function_exists('newsup_get_excerpt')):
    function newsup_get_excerpt($length = 25, $newsup_content = null, $post_id = 1) {
        $widget_excerpt   = newsup_get_option('global_widget_excerpt_setting');
        if($widget_excerpt == 'default-excerpt'){
            return the_excerpt();
        }

        $length          = absint($length);
        $source_content  = preg_replace('`\[[^\]]*\]`', '', $newsup_content);
        $trimmed_content = wp_trim_words($source_content, $length, '...');
        return $trimmed_content;
    }
endif;

/**
 * Returns no image url.
 *
 * @since newsup 1.0.0
 */
if(!function_exists('newsup_no_image_url')):
    function newsup_no_image_url(){
        $url = get_template_directory_uri().'/assets/images/no-image.png';
        return $url;
    }

endif;





/**
 * Outputs the tab posts
 *
 * @since 1.0.0
 *
 * @param array $args  Post Arguments.
 */
if (!function_exists('newsup_render_posts')):
  function newsup_render_posts( $type, $show_excerpt, $excerpt_length, $number_of_posts, $category = '0' ){

    $args = array();

    switch ($type) {
        case 'popular':
            $args = array(
                'post_type' => 'anime',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
                'orderby' => 'comment_count',
                'ignore_sticky_posts' => true
            );
            break;

        case 'recent':
            $args = array(
                'post_type' => 'anime',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
                'orderby' => 'date',
                'ignore_sticky_posts' => true
            );
            break;

        case 'categorised':
            $args = array(
                'post_type' => 'genre',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
                'ignore_sticky_posts' => true
            );
            $category = isset($category) ? $category : '0';
            if (absint($category) > 0) {
                $args['cat'] = absint($category);
            }
            break;


        default:
            break;
    }

    if( !empty($args) && is_array($args) ){
        $all_posts = new WP_Query($args);
        if($all_posts->have_posts()):
            echo '<div class="mg-posts-sec mg-posts-modul-2"><div class="mg-posts-sec-inner row"><div class="small-list-post col-lg-12"><ul>';
            while($all_posts->have_posts()): $all_posts->the_post();

                ?>

                  <li class="small-post clearfix">
                        <?php
                        if(has_post_thumbnail()){
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                            $url = $thumb['0'];
                            $col_class = 'col-sm-8';
                        }else {
                            $url = '';
                            $col_class = 'col-sm-12';
                        }
                        global $post;
                        ?>
                        <?php if (!empty($url)): ?>
                           <div class="img-small-post">
                                <img src="<?php echo esc_url($url); ?>"/>
                            </div>
                        <?php endif; ?>
                        <div class="small-post-content">
                                <div class="mg-blog-category">
                                   <?php newsup_post_categories('/'); ?>
                                </div>
                                 <div class="title_small_post">

                                    <a href="<?php echo esc_url(get_the_permalink()); ?>#content">
                                        <h5>
                                        <?php the_title(); ?>
                                        </h5>
                                    </a>

                                </div>
                        </div>
                </li>
            <?php
            endwhile;wp_reset_postdata();
            echo '</ul></div></div></div>';
        endif;
    }
}
endif;




?>
