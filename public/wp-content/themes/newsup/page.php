<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Newsup
 */
get_header(); 
?>
<!--==================== Newsup breadcrumb section ====================-->
<?php
$newsup_background_image = get_theme_support( 'custom-header', 'default-image' );

if ( has_header_image() ) {
  $newsup_background_image = get_header_image();
}
?>
<div class="mg-breadcrumb-section" style='background: url("<?php echo esc_url( $newsup_background_image ); ?>" ) repeat scroll center 0 #143745;'>
<?php $newsup_remove_header_image_overlay = get_theme_mods('remove_header_image_overlay',true);
if($newsup_remove_header_image_overlay == true){ ?>
  <div class="overlay">
<?php } ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-sm-12">
			    <div class="mg-breadcrumb-title">
           <h1><?php the_title(); ?></h1>
          </div>
        </div>
      </div>
    </div>
  <?php $newsup_remove_header_image_overlay = get_theme_mods('remove_header_image_overlay',true);
if($newsup_remove_header_image_overlay == true){ ?>
  </div>
<?php } ?>
</div>
<div class="clearfix"></div>
<!--==================== main content section ====================-->
<main id="content">
    <div class="container-fluid">
      <div class="row">
		<!-- Blog Area -->
			<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
			<div class="col-md-12 mg-card-box padding-20">
			<?php if (have_posts()) {  while (have_posts()) : the_post(); ?>
			<?php the_content(); endwhile; } } else {?>
			<div class="col-md-8 col-sm-8 mg-card-box padding-20">
			<?php if( have_posts()) :  the_post(); ?>		
			<?php the_content(); ?>
			<?php endif; 
				while ( have_posts() ) : the_post();
				// Include the page
				the_content();
				comments_template( '', true ); // show comments
				wp_link_pages(array(
        'before' => '<div class="link btn-theme">' . esc_html__('Pages:', 'newsup'),
        'after' => '</div>',
    ));
				
				endwhile;
			?>	
			</div>
			<!--Sidebar Area-->
			<aside class="col-md-4">
				<?php get_sidebar(); ?>
			</aside>
			<?php } ?>
			<!--Sidebar Area-->
			</div>
		</div>
	</div>
</main>
<?php
get_footer();