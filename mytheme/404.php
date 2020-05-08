<?php get_header(); ?>
    <main class="bg-light">
      <div class="container">
        <div class="row pt-3">
          <!-- メインコンテンツ -->
          <div class="col-md-8 col-xs-12">
            <div class="bg-white mb-5 p-5">
              <h1 class="h2 px-3 pb-3 font-weight-bolder">記事がありません</h1> 
              <p>キーワード検索</p>
              <?php get_search_form(); ?>
              <p>カテゴリーから探す</p>
              <?php wp_list_categories( ); ?>
            </div>
          </div>
          <!--サイドバー-->
          <?php get_sidebar(); ?>
        </div> 
      </div>       
<?php get_footer(); ?>