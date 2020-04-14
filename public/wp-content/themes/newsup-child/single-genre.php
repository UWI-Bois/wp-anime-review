<!-- =========================
     Page Breadcrumb
============================== -->
<?php get_header(); ?>
<!--==================== Newsup breadcrumb section ====================-->
<!-- =========================
     Page Content Section
============================== -->
<main id="content">
    <!--container-->
    <div class="container-fluid">
        <!--row-->
        <div class="row">
            <!--col-md-->
            <?php
            $this_id = get_the_ID();
            $this_title = get_the_title();
            //        echo $this_id;
            $newsup_single_page_layout = get_theme_mod('newsup_single_page_layout','single-align-content-right');
            if($newsup_single_page_layout == "single-align-content-left")
            { ?>
                <aside class="col-md-3 col-sm-3">
                    <?php get_sidebar();?>
                </aside>
            <?php } ?>
            <?php if($newsup_single_page_layout == "single-align-content-right"){
            ?>
            <div class="col-md-9 col-sm-8">
                <?php } elseif($newsup_single_page_layout == "single-align-content-left") { ?>
                <div class="col-md-9 col-sm-8">
                    <?php } elseif($newsup_single_page_layout == "single-full-width-content") { ?>
                    <div class="col-md-12 col-sm-12">
                        <?php } ?>
                        <?php if(have_posts())
                        {
                            while(have_posts()) { the_post(); ?>
                                <div class="media mg-info-author-block">
                                    <div class="mg-header">
                                        <div class="mg-blog-category">
                                            <?php newsup_post_categories(); ?>
                                        </div>
                                        <div class="mg-wid-title">
                                            <h1>
                                                <b><?php the_title(); ?></b>
                                            </h1>
                                        </div>
                                    </div>
                                    <?php
                                    $single_show_featured_image = esc_attr(get_theme_mod('single_show_featured_image','true'));
                                    if($single_show_featured_image == true) {
                                        if(has_post_thumbnail()){
                                            echo '<a class="mg-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
                                            the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
                                            echo '</a>';
                                        } }?>
                                    <article style="font-size: 20px;">
                                        <?php the_content(); ?>
                                    </article>
                                </div>
                            <?php } ?>

                            <!--                    list genres and anime information here-->
                            <?php
                            $related_anime = new WP_Query(array(
                                'posts_per_page' => -1,
                                'post_type'=> 'anime',
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'anime_genres',
                                        'compare' => 'LIKE',
                                        'value' => '"' . get_the_ID() . '"' // ensure we compare strings not ints
                                    )
                                )
                            ));
                            ?>
                            <div style="padding: 40px" class="media mg-card-box">
                                <div class="mg-wid-title">
                                    <h1 class="media-heading"> <?php the_title(); ?> Anime Titles </h1>
                                </div>
                                <div class="media-body">
                                    <?php
                                    if($related_anime->have_posts()) { ?>
                                        <ul style="font-size: large;">
                                            <?php while($related_anime->have_posts()){ $related_anime->the_post(); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <p><?php the_title(); ?></p>
                                                    </a>
                                                </li>
                                            <?php } // end while ?>
                                        </ul>
                                        <?php
                                    } // end if
                                    else { ?>
                                        <h1 class="media-heading"> No <?php the_title(); ?> Titles </h1>
                                        <?php
                                    } // end else
                                    wp_reset_postdata(); // clear the query object
                                    ?>
                                </div>
                            </div>

                            <?php
                            $newsup_enable_related_post = esc_attr(get_theme_mod('newsup_enable_related_post','true'));
                            $newsup_enable_related_post = false; // comment out this line to print the related post card on this single page.
                            if($newsup_enable_related_post == true){
                                ?>


                                <!--                this is for the related posts card -->
                                <div class="mg-featured-slider">
                                    <!--Start mg-realated-slider -->
                                    <div class="mg-sec-title">
                                        <!-- mg-sec-title -->
                                        <?php $newsup_related_post_title = get_theme_mod('newsup_related_post_title', esc_html__('Related Post','newsup'))?>
                                        <h4><?php echo esc_html($newsup_related_post_title);?></h4>
                                    </div>
                                    <!-- // mg-sec-title -->
                                    <div class="row">
                                        <!-- featured_post -->
                                        <?php
                                        global $post;
                                        $categories = get_the_category($post->ID);
                                        $number_of_related_posts = 3;

                                        if ($categories) {
                                            $cat_ids = array();
                                            foreach ($categories as $category) $cat_ids[] = $category->term_id;
                                            $args = array(
                                                'category__in' => $cat_ids,
                                                'post__not_in' => array($post->ID),
                                                'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                                                'ignore_sticky_posts' => 1
                                            );
                                            $related_posts = new wp_query($args);

                                            while ($related_posts->have_posts()) {
                                                $related_posts->the_post();
                                                global $post;
                                                ?>
                                                <!-- blog -->
                                                <div class="col-md-4">
                                                    <div class="mg-blog-post-3">
                                                        <?php
                                                        if(has_post_thumbnail()){ ?>
                                                            <div class="mg-blog-img">
                                                                <?php echo '<a class="mg-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
                                                                the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
                                                                echo '</a>';
                                                                ?>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="mg-blog-img image-blog-bg">
                                                            </div>
                                                        <?php } ?>

                                                        <div class="mg-blog-inner">
                                                            <?php $newsup_enable_single_post_category = esc_attr(get_theme_mod('newsup_enable_single_post_category','true'));

                                                            if($newsup_enable_single_post_category == true){ ?>
                                                                <div class="mg-blog-category"> <?php newsup_post_categories(); ?>
                                                                </div> <?php } ?>
                                                            <h1 class="title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>">
                                                                    <?php the_title(); ?></a>
                                                            </h1>
                                                            <div class="mg-blog-meta">
                                                                <?php $newsup_enable_single_post_date = esc_attr(get_theme_mod('newsup_enable_single_post_date','true'));
                                                                if($newsup_enable_single_post_date == true){
                                                                    ?>
                                                                    <span class="mg-blog-date"><i class="fa fa-clock-o"></i><a href="<?php echo esc_url(get_month_link(get_post_time('J'),get_post_time('M'))); ?>">
                                            <?php echo esc_html(get_the_date('J M, Y')); ?></a></span>
                                                                <?php } $newsup_enable_single_post_admin = esc_attr(get_theme_mod('newsup_enable_single_post_admin','true'));
                                                                if($newsup_enable_single_post_admin == true) {?>
                                                                    <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"> <i class="fa fa-user-circle-o"></i> <?php the_author(); ?></a>
                                                                <?php } ?> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- blog -->
                                            <?php }
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </div>

                                </div>
                                <!--End mg-realated-slider -->
                            <?php } }
                        $newsup_enable_single_post_admin_details = esc_attr(get_theme_mod('newsup_enable_single_post_admin_details','true'));
                        if($newsup_enable_single_post_admin_details == true) {
                            comments_template('',true); } ?>
                    </div>
                    <?php if($newsup_single_page_layout == "single-align-content-right") { ?>
                        <!--sidebar-->
                        <!--col-md-3-->
                        <aside class="col-md-3 col-sm-4">
                            <?php get_sidebar(); // load the widgest on the side (meta, recent comments, etc)?>
                        </aside>
                        <!--/col-md-3-->
                        <!--/sidebar-->
                    <?php } ?>
                </div>
            </div>
</main>
<?php get_footer(); ?>
