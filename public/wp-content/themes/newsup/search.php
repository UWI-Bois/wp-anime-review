<?php
/**
 * The template for displaying search results pages.
 *
 * @package Newsup
 */

get_header(); ?>
<!--==================== Newsup breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<div id="content">
    <!--container-->
    <div class="container-fluid">
    <!--row-->
        <div class="row">
            <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-xs-12">
                <h2><?php /* translators: %s: search term */ printf( esc_html__( 'Search Results for: %s','newsup'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <!-- mg-posts-sec mg-posts-modul-6 -->
                            <div class="mg-posts-sec mg-posts-modul-6">
                                <!-- mg-posts-sec-inner -->
                                <div class="mg-posts-sec-inner">
                                    <?php if ( have_posts() ) : /* Start the Loop */
                                    while ( have_posts() ) : the_post(); ?>
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
                                    <?php endwhile; else :?>
                                    
        <h2><?php esc_attr_e( "Nothing Found", 'newsup' ); ?></h2>
        <div class="">
        <p><?php esc_attr_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'newsup' ); ?>
        </p>
        <?php get_search_form(); ?>
        </div><!-- .blog_con_mn -->
        <?php endif; ?>
                                </div>
                                <!-- // mg-posts-sec-inner -->
                            </div>
                            <!-- // mg-posts-sec block_6 -->

                            <!--col-md-12-->
</div>
            </div>
            <aside class="col-md-4 col-sm-4">
                    <?php get_sidebar();?>
            </aside>
        </div><!--/row-->
    </div><!--/container-->
</div>
<?php
get_footer();
?>