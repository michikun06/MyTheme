<?php get_header(); ?>
    <main class="bg-light">
      <div class="container">
        <!--ピックアップ記事-->
        <div class="row py-3">
          <?php  $top_query = new WP_Query( 'tag=toppickup' ); ?>
          <?php if ( $top_query->have_posts() ) : ?>
            <?php while ( $top_query->have_posts() ) : $top_query->the_post(); ?>
              <div class="col-md-4 col-12">
                <div class="bg-white py-3">
                  <!--サムネイル-->
                  <div class="pb-3">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
                    <?php else : ?>
                      <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
                    <?php endif; ?>
                  </div>
                  <!--記事タイトル-->
                  <h2 class="h4 px-3 pb-3"><?php the_title(); ?></h2>
                  <!--ボタン-->
                  <div class="text-center">
                    <a href="<?php the_permalink(); ?>">
                      <div class="d-inline-block border p-3 text-secondary">
                        READ MORE
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>

        <div class="row pt-3">
          <!-- メインコンテンツ -->
          <div class="col-md-8 col-xs-12">
            <!-- 記事の概要を表示-->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <div class="bg-white text-center mb-5 py-5">
                <!--日付-->
                <p><?php the_time('Y/n/j'); ?></p>
                <!--記事タイトル-->
                <h2 class="px-3 pb-3 font-weight-bolder"><?php the_title(); ?></h2>
                <!--カテゴリー-->
                <p><?php the_category( ' ' ); ?></p>
                <!--サムネイル-->
                <div class="pb-3">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
                  <?php else : ?>
                    <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
                  <?php endif; ?>
                </div>
                <!--ディスクリプション-->
                <p class="text-secondary"><?php the_excerpt(); ?></p>
                <!--ボタン-->
                <div class="text-center">
                  <a href="<?php the_permalink(); ?>">
                    <div class="d-inline-block border p-3 text-secondary">
                      READ MORE
                    </div>
                  </a>
                </div>
              </div>
            <?php endwhile; else : ?>
              <p>記事がありません。</p>
            <?php endif; ?>
            <!--ページネーション-->
            <?php if(function_exists("mytheme_pagenation")):?>
              <?php mytheme_pagenation(); ?>
            <?php endif; ?>
          </div>
          <!--サイドバー-->
          <?php get_sidebar(); ?>
        </div> 
      </div>       
<?php get_footer(); ?>