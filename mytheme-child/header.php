<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--ファビコン -->
    <?php $mytheme_favicon = esc_url(get_option('mytheme_favicon_img')) ?>
    <link rel="icon" type="image/png" href="<?php echo $mytheme_favicon; ?>">
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <div class="container">
        <?php if ( is_home() ) { ?>
          <h1 class="h1 py-3">My Theme</h1>
        <?php } else { ?>
          <div class="h1 py-3">My Theme</div>
        <?php } ?>
      </div>
    </header>
    <!--グローバルナビ-->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container">
        <a class="navbar-brand text-white" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <?php
          $defaults = array(
            'menu_class'      => 'navbar-nav',
            'container'       => false,
            'link_before'     => '<span class="nav-item text-white mr-4">',
            'link_after'      => '<span>',
            'theme_location'  => 'gloval-navigation',
          );
          wp_nav_menu( $defaults );
          ?>
        </div>
      </div>
    </nav>
    <a class="text-white" href="https://shimotmk.com/Portfolio">
      <div class="attenstion text-center">
      自己紹介はこちら
      </div>
    </a>