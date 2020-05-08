<div class="col-md-4 col-12">
  <?php dynamic_sidebar( 'sidebar_widget01' ); ?>
  <!--読んで欲しい記事-->
  <div class="container bg-white mb-5 py-5">
    <div class="text-center pb-5">
      <h4 class="d-inline-block py-3 border-bottom border-info">読んで欲しい記事</h4>
    </div>      
      <?php  $side_query = new WP_Query( 'tag=sidepickup' ); ?>
      <?php if ( $side_query->have_posts() ) : ?>
        <?php while ( $side_query->have_posts() ) : $side_query->the_post(); ?>
          <div class="pb-5">
            <!--サムネイル-->
            <div class="pb-3">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
              <?php else : ?>
                <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
              <?php endif; ?>
            </div>
            <!--記事タイトル-->
            <h5 class="h5"><a class="text-secondary" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          </div>
        <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    <div class="text-center pb-5">
    <h4 class="d-inline-block py-3 border-bottom border-info">管理画面から入力した</h4>
    </div>      
      <?php $pickup_id = esc_html(get_option('mytheme_pickup_article')) ?>
      <?php $pickup_ids = explode("," ,$pickup_id);?>  
      <?php if($pickup_ids !=='') :?> 
      <?php $manage_query = new WP_Query( 
        array(
          'post_type' => 'any',
          'orderby' => 'post__in',
          'post__in' => $pickup_ids,
          'posts_per_page' => -1,
        )
        ); ?> 
        <?php if ( $manage_query->have_posts() ) : ?>
          <?php while ( $manage_query->have_posts() ) : $manage_query->the_post(); ?>
            <div class="pb-5">
              <!--サムネイル-->
              <div class="pb-3">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
                <?php else : ?>
                  <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
                <?php endif; ?>
              </div>
              <!--記事タイトル-->
              <h5 class="h5"><a class="text-secondary" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>
          <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      <?php endif; ?>

      <div class="text-center pb-5">
        <h4 class="d-inline-block py-3 border-bottom border-info">人気記事の表示</h4>
      </div>      
      <?php set_post_views(get_the_ID());?>  
      
      <?php $popular_query = new WP_Query( 
        array(
          'meta_key' => $post_views_count,
          'orderby' => $meta_value_num,
          'post_per_page' => 5,
        )
      ); ?> 
      <?php if ( $popular_query->have_posts() ) : ?>
        <?php while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>
          <div class="pb-5">
            <!--サムネイル-->
            <div class="pb-3">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
              <?php else : ?>
                <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
              <?php endif; ?>
            </div>
            <!--記事タイトル-->
            <h5 class="h5"><a class="text-secondary" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          </div>
        <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
      <?php endif; ?>
  </div>
</div>