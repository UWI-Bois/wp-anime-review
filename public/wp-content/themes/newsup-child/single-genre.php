single-genre.php -> details about a single genre
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
                    <h4 class="media-heading"><span><?php esc_html_e('By','newsup'); ?></span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
                    <span class="mg-blog-date"><?php echo get_the_date('M'); ?> <?php echo get_the_date('j,'); ?> <?php echo get_the_date('Y'); ?></span>
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
                <?php the_content(); ?>
              </article>
            </div>
		      <?php } ?>

           <div class="media mg-info-author-block">
            <?php $newsup_enable_single_post_admin_details = esc_attr(get_theme_mod('newsup_enable_single_post_admin_details','true'));
            if($newsup_enable_single_post_admin_details == true) { ?>
            <a class="mg-author-pic" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?></a>
                <div class="media-body">
                  <h4 class="media-heading"><?php esc_html_e('By','newsup'); ?> <a href "<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
                  <p><?php the_author_meta( 'description' ); ?></p>
                </div>
              <?php } ?>
            </div><?php $newsup_enable_related_post = esc_attr(get_theme_mod('newsup_enable_related_post','true'));
                                if($newsup_enable_related_post == true){
                            ?>
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
                  <?php get_sidebar();?>
            </aside>
          <!--/col-md-3-->
      <!--/sidebar-->
      <?php } ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
