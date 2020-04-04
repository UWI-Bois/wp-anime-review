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
    function jarvis_banner_exclusive_posts()  {
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

// This function is called on the home page for the featured
// posts to be displayed on an Owl Carousel content section.
// Similarly to the above function, we expect to simply
// override the WP_Query object.
if (!function_exists('newsup_front_page_banner_section')) :
    /**
     *
     * @since Newsup
     *
     */
    function jarvis_front_page_banner_section()
    {
        if (is_front_page() || is_home()) {
        $newsup_enable_main_slider = newsup_get_option('show_main_news_section');
        $select_vertical_slider_news_category = newsup_get_option('select_vertical_slider_news_category');
        $vertical_slider_number_of_slides = newsup_get_option('vertical_slider_number_of_slides');
        $all_posts_vertical = newsup_get_posts($vertical_slider_number_of_slides, $select_vertical_slider_news_category);
        if ($newsup_enable_main_slider):

            $main_banner_section_background_image = newsup_get_option('main_banner_section_background_image');
            $main_banner_section_background_image_url = wp_get_attachment_image_src($main_banner_section_background_image, 'full');
        if(!empty($main_banner_section_background_image)){ ?>
             <section class="mg-fea-area over" style="background-image:url('<?php echo $main_banner_section_background_image_url[0]; ?>');">
        <?php }else{ ?>
            <section class="mg-fea-area">
        <?php  } ?>
            <div class="overlay">
                <div class="container-fluid">
                    <div class="">
                        <div class="col-md-8">
                            <div class="row">
                                <div id="homemain"class="homemain owl-carousel mr-bot60 pd-r-10">
                                  <?php
                                  // This code was pulled from ../newsup/inc/hooks/blocks/block-banner-list.php
                                  // and controls "The Loop" which populates the Home Feature Post Carousel.
                                  $newsup_slider_category = newsup_get_option('select_slider_news_category');
                                  $newsup_number_of_slides = newsup_get_option('number_of_slides');
                                  $newsup_all_posts_main = newsup_get_posts($newsup_number_of_slides, $newsup_slider_category);
                                  $newsup_count = 1;

                                  $anime_posts = new WP_Query(array('post_type' => 'anime'));
                                  if ($anime_posts->have_posts()) :
                                      while ($anime_posts->have_posts()) : $anime_posts->the_post();

                                          global $post;
                                          $newsup_url = newsup_get_freatured_image_url($post->ID, 'newsup-slider-full');

                                          ?>
                                           <div class="item">
                                              <div class="mg-blog-post lg">
                                                  <div class="mg-blog-img">
                                                   <a class="ta-slide-items" href="<?php the_permalink(); ?>">
                                                      <?php if (!empty($newsup_url)): ?>
                                                          <img src="<?php echo esc_url($newsup_url); ?>">
                                                      <?php endif; ?>
                                                      </a>
                                                  </div>
                                                  <!-- POST FEATURE ITEM -->
                                                  <article class="bottom">
                                                          <span class="post-form"><i class="fa fa-camera"></i></span>
                                                          <div class="mg-blog-category"> <?php newsup_post_categories(); ?> </div>
                                                          <h1 class="title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                                          <!-- POST META DATA: DATE AUTHOR -->
                                                          <div class="mg-blog-meta">
                                                              <span class="mg-blog-date"><i class="fa fa-clock-o"></i>
                                                               <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
                                                               <?php echo esc_html(get_the_date('M j, Y')); ?></a></span>
                                                               <a class="auth" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user-circle-o"></i>
                                                              <?php the_author(); ?></a>
                                                          </div>
                                                          <!-- END POST META -->
                                                  </article>
                                                  <!-- END POST FEATURE -->
                                              </div>
                                          </div>
                                      <?php
                                      endwhile;
                                  endif;
                                  wp_reset_postdata();
                                  ?>
                                </div>
                            </div>
                        </div>
                        <?php do_action('newsup_action_banner_tabbed_posts');?>
                    </div>
                </div>
            </div>
        </section>
        <!--==/ Home Slider ==-->
        <?php endif; ?>
        <!-- end slider-section -->
        <?php }
    }
endif;

?>
