<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Newsup
 */
get_header(); ?>
<!-- BANNER AND STUFF BY CODE -->
<?php
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
 ?>
<!--==================== Newsup breadcrumb section ====================-->
            <div id="content" class="container-fluid home">
                <!--row-->
                <div class="">
                    <!--col-md-8-->
                    <?php
                    $newsup_content_layout = esc_attr(get_theme_mod('newsup_content_layout','align-content-right'));
                    if($newsup_content_layout == "align-content-left")
                    { ?>
                    <aside class="col-md-4 col-sm-4">
                        <?php get_sidebar();?>
                    </aside>
                    <?php } ?>
                    <?php if($newsup_content_layout == "align-content-right"){
                    ?>
                    <div class="col-md-8 col-sm-8">
                    <?php } elseif($newsup_content_layout == "align-content-left") { ?>
                    <div class="col-md-8 col-sm-8">
                    <?php } elseif($newsup_content_layout == "full-width-content") { ?>
                     <div class="col-md-12 col-sm-12">
                     <?php } get_template_part('content',''); ?>
                    </div>
                    <!--/col-md-8-->
                    <?php if($newsup_content_layout == "align-content-right") { ?>
                    <!--col-md-4-->
                    <aside class="col-md-4 col-sm-4">
                        <?php get_sidebar();?>
                    </aside>
                    <!--/col-md-4-->
                    <?php } ?>
                </div>
                <!--/row-->
    </div>
<?php
get_footer();
?>
