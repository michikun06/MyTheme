<?php get_header(); ?>
    <main class="bg-light">
      <div class="container">
        <div class="row pt-3">
          <!-- メインコンテンツ -->
          <div class="col-md-8 col-xs-12">
            <!-- 記事の概要を表示-->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <div class="bg-white text-center mb-5 py-5">
                <!--日付-->
                <p>
                  <?php the_time('Y/n/j'); ?>
                  <?php if(get_the_modified_date("Y/n/j")) :?>
                    (更新日:<?php echo the_modified_date("Y/n/j"); ?>)
                  <?php endif; ?>
                  <!--カスタムフィールド-->
                  <?php $weather = get_post_meta($post->ID,'Weather',true) ?>
                  <?php if($weather): ?>
                    天気は<?php echo $weather; ?>
                  <?php endif; ?>
                </p>
                <!--記事タイトル-->
                <h1 class="h2 px-3 pb-3 font-weight-bolder"><?php the_title(); ?></h1>
                <!--カテゴリー-->
                <p><?php the_category( ' ' ); ?></p>
                <!--カスタムタクソノミー -->
                <p><?php the_terms($post->ID, 'genre'); ?></p>
                <!--サムネイル-->
                <div class="pb-3">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('', array( 'class' => 'img-fluid' ) ); ?>
                  <?php else : ?>
                    <img class="img-fluid" width="100%" src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="">
                  <?php endif; ?>
                </div>
                <!--本文-->
                <div class="text-left px-2">
                  <?php the_content(); ?>
                  <!--SNSシェボタン-->
                  <?php get_template_part( 'parts-sns' ); ?>
                  <?php comments_template( ); ?>
                  <p>投稿者 
                    <a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>">
                      <?php echo esc_attr(get_the_author_meta('nickname')); ?>
                    </a>
                  </p>
                  <?php get_template_part('related'); ?>
                  <?php get_template_part('breadcrumb'); ?>
                </div>
              </div>
            <?php endwhile; else : ?>
              <p>記事がありません。</p>
            <?php endif; ?>
          </div>
          <!--サイドバー-->
          <?php get_sidebar(); ?>
        </div> 
      </div>       
<?php get_footer(); ?>
