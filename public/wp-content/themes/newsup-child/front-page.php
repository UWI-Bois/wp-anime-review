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
                     <?php } ?>
                     <!-- xxx -->
                     <?php
                     $anime_posts = new WP_Query(array('post_type' => 'anime'));
                      ?>
                     <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                                 <!-- mg-posts-sec mg-posts-modul-6 -->
                                                 <div class="mg-posts-sec mg-posts-modul-6">
                                                     <!-- mg-posts-sec-inner -->,
                                                     <div class="mg-posts-sec-inner">
                                                         <?php while($anime_posts->have_posts()){ $anime_posts->the_post();
                                                           global $post;
                                                          ?>
                                                         <article class="mg-posts-sec-post">
                                                             <div class="standard_post">
                                                                 <?php if(has_post_thumbnail()) { ?>
                                                                 <div class="mg-thum-list col-md-6">

                                                                     <div class="mg-post-thumb">
                                                                         <?php
                                                                         echo '<a class="mg-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
                                                                         the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
                                                                         echo '</a>';

                                                                         ?>
                                                                         <span class="post-form"><i class="fa fa-camera"></i></span>
                                                                     </div>

                                                                 </div>
                                                                 <?php }  ?>
                                                                 <div class="list_content col">
                                                                     <div class="mg-sec-top-post">
                                                                         <div class="mg-blog-category">
                                                                             <?php newsup_post_categories(); ?>
                                                                         </div>

                                                                         <h1 class="entry-title title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>

                                                                         <div class="mg-blog-meta">
                                                                             <span class="mg-blog-date"><i class="fa fa-clock-o"></i>
                                                                             <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
                                                                             <?php echo esc_html(get_the_date('M j, Y')); ?></a></span>
                                                                             <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user-circle-o"></i> <?php the_author(); ?></a>
                                                                         </div>
                                                                     </div>

                                                                     <div class="mg-posts-sec-post-content">
                                                                         <div class="mg-content">
                                                                             <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                                                         </div>

                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </article>
                                                          <?php } ?>
                                                         <div class="col-md-12 text-center">
                                                             <?php //Previous / next page navigation
                                                             the_posts_pagination( array(
                                                             'prev_text'          => '<i class="fa fa-angle-left"></i>',
                                                             'next_text'          => '<i class="fa fa-angle-right"></i>',
                                                             ) ); ?>
                                                         </div>
                                                     </div>
                                                     <!-- // mg-posts-sec-inner -->
                                                 </div>
                                                 <!-- // mg-posts-sec block_6 -->

                                                 <!--col-md-12-->
                     </div>
                     <!-- xxx -->
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
