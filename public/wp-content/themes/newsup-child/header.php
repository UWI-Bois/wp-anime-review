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
 <?php do_action('newsup_action_banner_exclusive_posts');
 ?>
