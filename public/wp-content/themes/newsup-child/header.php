<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Newsup
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'newsup' ); ?></a>
    <div class="wrapper">
        <header class="mg-headwidget">
            <!--==================== TOP BAR ====================-->

            <?php do_action('newsup_action_header_section');  ?>
            <div class="clearfix"></div>
            <?php $background_image = get_theme_support( 'custom-header', 'default-image' );
            if ( has_header_image() ) {
              $background_image = get_header_image();
            } ?>
            <div class="mg-nav-widget-area-back" style='background: url("<?php echo esc_url( $background_image ); ?>" ) repeat scroll center 0 #143745;'>
            <?php $remove_header_image_overlay = get_theme_mods('remove_header_image_overlay',true);
            if($remove_header_image_overlay == true){ ?>
            <div class="overlay">
            <?php } ?>
              <div class="inner">
                <div class="container-fluid">
                    <div class="mg-nav-widget-area">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 text-center-xs">
                                <div class="navbar-header">
                                <?php the_custom_logo();
                                if (display_header_text()) : ?>
                                <div class="site-branding-text">
                                <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                <p class="site-description"><?php bloginfo('description'); ?></p>
                                </div>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-wp"> <span class="sr-only"><?php esc_html_e('Toggle Navigation','newsup');?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                              <?php endif; ?>
                                </div>
                            </div>
                           <?php do_action('newsup_action_banner_advertisement'); ?>

                        </div>
                    </div>
                </div>
              </div>
              <?php $remove_header_image_overlay = get_theme_mods('remove_header_image_overlay',true);
              if($remove_header_image_overlay == true){ ?>
              </div>
             <?php } ?>
          </div>
    <div class="mg-menu-full">
            <nav class="navbar navbar-default navbar-static-top navbar-wp">
                <div class="container-fluid">
         <!-- navbar-toggle -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-wp"> <span class="sr-only"><?php esc_html_e('Toggle Navigation','newsup'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <!-- /navbar-toggle -->

                  <div class="collapse navbar-collapse" id="navbar-wp">
                  <?php wp_nav_menu( array(
        								'theme_location' => 'primary',
        								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
        								'menu_class' => 'nav navbar-nav',
        								'fallback_cb' => 'newsup_fallback_page_menu',
        								'walker' => new newsup_nav_walker()
        							) );
        						?>
              </div>
          </div>
      </nav> <!-- /Navigation -->
    </div>
</header>
<div class="clearfix"></div>
<?php  if (is_front_page() || is_home()) { ?>
<section class="mg-tpt-tag-area">
  <div class="container-fluid">
 <?php $show_popular_tags_title = newsup_get_option('show_popular_tags_title');
 $select_popular_tags_mode = newsup_get_option('select_popular_tags_mode');
 $number_of_popular_tags = newsup_get_option('number_of_popular_tags');
 newsup_list_popular_taxonomies($select_popular_tags_mode, $show_popular_tags_title, $number_of_popular_tags); ?>
</div>
</section>
 <?php }?>
 <!-- ==================== FEATURE BANNER ===================== -->
<?php
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
    $all_posts = new WP_Query(array('post_type' => 'anime', 'orderby' => 'date'));
    $show_trending = true;
    $count = 1;
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
                if ($all_posts->have_posts()) :
                    while ($all_posts->have_posts()) : $all_posts->the_post();
                        ?>
                        <a href="<?php echo esc_url(get_the_permalink()); ?>#content">
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
 ?>
 <!-- ======================= END BANNER ====================== -->
 <!-- =================== FEATURE CAROUSEL ==================== -->
<?php
if (is_front_page()) {
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
                          $newsup_slider_category = newsup_get_option('select_slider_news_category');
                          $newsup_number_of_slides = newsup_get_option('number_of_slides');
                          $newsup_all_posts_main = newsup_get_posts($newsup_number_of_slides, $newsup_slider_category);
                          $newsup_all_posts_main = new WP_Query(array('post_type' => 'anime', 'orderby' => 'rand'));
                          $newsup_count = 1;

                          if ($newsup_all_posts_main->have_posts()) :
                              while ($newsup_all_posts_main->have_posts()) : $newsup_all_posts_main->the_post();

                                  global $post;
                                  $newsup_url = newsup_get_freatured_image_url($post->ID, 'newsup-slider-full');

                                  ?>
                                   <div class="item">
                                      <div class="mg-blog-post lg">
                                          <div class="mg-blog-img">
                                           <a class="ta-slide-items" href="<?php echo esc_url(get_the_permalink()); ?>#content">
                                              <?php if (!empty($newsup_url)): ?>
                                                  <img src="<?php echo esc_url($newsup_url); ?>">
                                              <?php endif; ?>
                                              </a>
                                          </div>

                                          <article class="bottom">
                                                  <span class="post-form"><i class="fa fa-camera"></i></span>
                                                  <div class="mg-blog-category"> <?php newsup_post_categories(); ?> </div>
                                                  <h1 class="title"> <a href="<?php echo esc_url(get_the_permalink()); ?>#content"><?php the_title(); ?></a></h1>
                                                  <?php newsup_post_meta(); ?>
                                          </article>
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
 <!-- ==================== END CAROUSEL ===================== -->
