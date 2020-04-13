<!-- =========================
     Page Breadcrumb
============================== -->
<?php get_header(); ?>
<!--==================== Newsup breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
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
                                <div class="mg-blog-post-box">
                                    <div class="mg-header">
                                        <div class="mg-blog-category">
                                            <?php newsup_post_categories(); ?>
                                        </div>
                                        <h1 class="title single"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => esc_html_e('Permalink to: ','newsup'),'after'  => '') ); ?>">
                                                <?php the_title(); ?></a>
                                        </h1>

                                        <div class="media mg-info-author-block"> <a class="mg-author-pic" href="#"> <?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?> </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><span><?php esc_html_e('Posted By','newsup'); ?></span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
                                                <span class="mg-blog-date">Date Posted: <?php echo get_the_date('M'); ?> <?php echo get_the_date('j,'); ?> <?php echo get_the_date('Y'); ?></span>
                                                <?php $tag_list = get_the_tag_list();
                                                if($tag_list){ ?>
                                                    <span class="newsup-tags"><a href="<?php the_permalink(); ?>"><?php the_tags('', ', ', ''); ?></a></span>
                                                <?php } ?>
                                            </div>
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
                                    <article class="small single">
<!--                                        show the associated rating-->
                                        <?php the_content(); ?>
                                        <?php
                                        $anime_po = get_field('review_anime'); // https://www.advancedcustomfields.com/resources/post-object/
                                        $rating = get_field('review_rating');
                                        // some global variables to grab any data we need about the associated anime post
                                        $anime_po_id = null;
                                        $anime_po_title = null;
                                        $anime_po_permalink = null;
                                        if($anime_po){
                                            $post = $anime_po;
                                            setup_postdata($post);
                                            global $anime_po_id;
                                            $anime_po_id = get_the_ID();
                                            $anime_po_title = get_the_title();
                                            $anime_po_permalink = get_the_permalink();
                                            wp_reset_postdata(); // important, if omitted, the rest of the post methods will be related to the anime post object (eg, the_title() -> Bleach)
                                        }
                                        ?>
                                        <hr>
                                        <hr>
                                        <h4>Anime being reviewed: <a href="<?php echo $anime_po_permalink; ?>"><?php echo $anime_po_title ?></a> </h4>
                                        <hr>
                                        <?php
                                        if($rating){ ?>
                                            <h4>
                                                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a>
                                                Rated it :
                                                <?php echo $rating; ?> / 5
                                            </h4>
                                            <?
                                        }// end if
                                        else { ?>
                                            <h4>No rating provided :(</h4>
                                            <?php
                                        } // end else
                                        ?>
                                    </article>
                                </div>
                            <?php } ?>

                            <?php
                            // query for more queries about this anime
                            // grab all queries
	                        $query_all_reviews = array(
		                        'posts_per_page' => 10,
		                        'post_type'=> 'anime_review',
		                        'orderby' => 'rand',
		                        'order' => 'ASC'
	                        );
                            $reviews = new WP_Query($query_all_reviews);
                            ?>
                            <div style="padding: 40px" class="media mg-card-box">
                                <div class="mg-wid-title">
                                    <h1>
                                        More
                                        <a href="<?php echo $anime_po_permalink; ?>"><?php echo $anime_po_title ?></a>
                                        Reviews
                                    </h1>
                                </div>

                                <?php
                                if($reviews) {
                                    ?>
                                    <div class="media-body">
                                        <ul class="list-group">
                                        <?php
                                        while ($reviews->have_posts()) {
                                            $reviews->the_post();
                                            $reviews_anime = get_field('review_anime');
                                            $reviews_rating = get_field('review_rating');
                                            $reviews_anime_id = $reviews_anime->ID; // works
                                            $reviews_anime_title = $reviews_anime->post_title; // works

                                            if($this_id != get_the_ID()) {
                                                if($anime_po_id == $reviews_anime_id) {
                                                    ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <h4>
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                            <?php
                                                            if($reviews_rating) {
                                                                ?>
                                                                <span class="badge badge-warning badge-pill">
                                                                    Rating:
                                                                    <?php echo $reviews_rating; ?>
                                                                    / 5
                                                                </span>
                                                                <?php
                                                            }// end if reviews rating
                                                                ?>
                                                        </h4>
                                                    </li>
                                                    <?php
                                                } // end if anime id
                                            } // end if this review id
                                        } // end while have posts
                                        ?>
                                        </ul>
                                    </div>
                                    <?php
                                    wp_reset_postdata();
                                } // end if reviews query
                                ?>

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
