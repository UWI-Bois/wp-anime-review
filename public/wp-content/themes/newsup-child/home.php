<?php
  get_header(  );
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
            <h1>Blog</h1>
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
<?php
  // This page template is intended by Wordpress file hierarchy to
  // load the Blog Post Index Page; the page will load all default
  // Wordpress Post types in the database.
  //
  // The Blog Post Index Page typically uses this file first, and
  // will default to using index.php as a "catch all" file template.
  //
  // In order to achieve what we want for this website, this page
  // will be modified to use a WP_Query against all "Anime" and
  // "Review" custom post types.
?>
<div id="content" class="container w-50">
  <div class="col-md-12 col-sm-12">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="mg-posts-sec mg-posts-modul-6">
            <div class="mg-posts-sec-inner">
                <?php
                while (have_posts()):
                  the_post();
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
                                      <?php
                                      // This gets all the relevant metadata of this post and then
                                      // embeds them into a pill component to display as
                                      // the categories of this post preview.
                                      $post_type = get_post_type( $post );
                                      if ($post_type == 'anime'):
                                        $meta_value = get_field('anime_genres');
                                        foreach ($meta_value as $val):
                                          ?>
                                          <a class="newsup-categories category-color-1" href="<?php echo esc_url(get_permalink( $val )) ?>" alt="">
                                              <?php echo esc_html( get_the_title(get_post($val))); ?>
                                          </a>
                                          <?php
                                          endforeach; // for each genre on
                                      elseif ($post_type == 'anime_review'):
                                        $meta_value = get_field('review_anime');
                                        ?>
                                        <a class="newsup-categories category-color-1" href="<?php echo esc_url(get_permalink( $meta_value )) ?>" alt="">
                                          <?php echo esc_html( get_the_title(get_post($meta_value))); ?>
                                        </a>
                                        <?php
                                      elseif ($post_type == 'genre'):
                                        $genre_animes = new WP_Query(array(
                                          'post_type' => 'anime',
                                          'meta_query' => array(
                                            array(
                                              'key' => 'anime_genres',
                                              'compare' => 'LIKE',
                                              'value' => '"'.get_the_ID().'"',
                                            )
                                          )
                                        ));
                                        while ($genre_animes->have_posts()):
                                          $genre_animes->the_post();
                                          ?>
                                          <a class="newsup-categories category-color-1" href="<?php echo esc_url(get_permalink( $post )) ?>" alt="">
                                            <?php echo esc_html( get_the_title( $post )); ?>
                                        </a>
                                        <?php
                                        endwhile;
                                      endif;
                                      ?>
                                  </div>

                                  <h1 class="entry-title title"><a href="<?php echo esc_url(get_the_permalink()); ?>#content"><?php the_title();?></a></h1>

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
                  <?php
                endwhile;
                ?>
                <div class="col-md-12 text-center">
                    <?php //Previous / next page navigation
                    the_posts_pagination( array(
                    'prev_text'          => '<i class="fa fa-angle-left"></i>',
                    'next_text'          => '<i class="fa fa-angle-right"></i>',
                    ) ); ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<?php
  get_footer(  );
?>
