<?php
/*サムネイル */
add_theme_support('post-thumbnails');

/*メニュー機能 */
register_nav_menus(
 array(
 'gloval-navigation' => 'グローバル', 
 'footer-navigation' => 'フッター',
 )
); 

/*titileタグの設定 */
add_theme_support( 'title-tag' ); 

/*ウィジェットの登録 */
function my_widgets_init() {
	register_sidebar( array(
		'name' => 'サイドバー',
		'id' => 'sidebar_widget01',
		'before_widget' => '<div class="container bg-white mb-5 py-5">',
    'after_widget' => '</div>',
  ) );

  register_sidebar( array(
		'name' => 'フッターAbout',
		'id' => 'footer_widget01',
		'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title'  => '<h4 class="d-inline-block py-3 border-bottom border-info">',
	  'after_title'   => '</h4>'
  ) );

  register_sidebar( array(
		'name' => 'フッターTwitter',
		'id' => 'footer_widget02',
		'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title'  => '<h4 class="d-inline-block py-3 border-bottom border-info">',
	  'after_title'   => '</h4>'
  ) );
  
}
add_action( 'widgets_init', 'my_widgets_init' );

/**
 * スクリプトとスタイルを正しくエンキューする方法
 */
function theme_name_scripts() {
	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	wp_enqueue_style( 
		'bootstrap-css',
		'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
	);

	wp_enqueue_script( 
		'jquery', 
		'https://code.jquery.com/jquery-3.4.1.slim.min.js',
		array(), 
		'', 
		true 
	);
	wp_enqueue_script( 
		'jsdelivr', 
		'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
		array(), 
		'', 
		true 
	);
	wp_enqueue_script( 
		'bootstrap-js', 
		'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
		array(), 
		'', 
		true 
	);
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

/**
 * ボタン ショートコード
 */
function mytheme_shortcode ($atts, $content = "") {
	return '<a href= " ' . $atts['link']. ' " class = " btn '. $atts['class'] .' " > ' .$content . '</a>'; 
}
add_shortcode ( 'btn' , 'mytheme_shortcode' );




















/**
 * ページネーション
 */
function mytheme_pagenation() {
	global $wp_query;
	if ( $wp_query->max_num_pages <=1)
	return;
	echo '<nav class="pagenation">';
	echo paginate_links( array(
		'total' => $wp_query->max_num_pages,
		'prev_text'          => __('<'),
		'next_text'          => __('>'),
		'type'               => 'list'
	) );
	echo '</nav>';
}

/**
 * 投稿者ページカスタマイズ
 */
function mytheme_profile_fields ($user_contact){
	//項目の追加
	$user_contact['twitter'] = 'Twitter';
	return $user_contact;
}
add_filter('user_contactmethods','mytheme_profile_fields');

/*
カスタム投稿タイプ
*/
function codex_custom_init() {
	$args = array(
		'public' => true,
		'label'  => 'Books',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-book',
		'has_archive' => true
	);
	register_post_type( 'book', $args );

	//カスタムタクソノミー
	$args = array(
		'label' => __( '本のカテゴリー' ),
		'rewrite' => array( 'slug' => 'genre' ),
		'hierarchical' => true,
	);
	register_taxonomy('genre','book',$args);

}
add_action( 'init', 'codex_custom_init' );

/*
管理画面に独自のフィールド
*/
function register_custom_menu() {
	add_menu_page(
		'mytheme管理',
		'mytheme管理',
		'manage_options',
		'mytheme-manage',
		'manage_html',
		'dashicons-admin-generic',
		0
	);
}
add_action( 'admin_menu', 'register_custom_menu' );

function manage_html(){
	include 'form-manage.php';
}

function register_custom_settings(){
	register_setting( 'original-field-manage', 'mytheme_pickup_article' );
	register_setting( 'original-field-manage', 'mytheme_favicon_img' ); 
}
add_action( 'admin_init', 'register_custom_settings' );

/*メニューの非表示 */
function remove_menus() {
	if(current_user_can('read')){
		remove_menu_page( 'index.php' );
		remove_menu_page( 'upload.php' ); 
		remove_menu_page( 'edit.php?post_type=book' );
	}
}
add_action( 'admin_menu', 'remove_menus' );

/*人気記事の表示 */
function get_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key,'0');
	}
	return $count.'Views';
}

function set_post_views($postID) {
	$count=0;
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key,'0');
	} else {
		if(!is_user_logged_in()){
			$count++;
			update_post_meta($postID, $count_key,$count);
		}
	}
}
add_action('init' , 'set_post_views');

/*管理画面にPV数を表示*/
function add_views_columns($columns) {
	$columns['post_views_count'] = '閲覧数';
	return $columns;
}
add_filter ('manage_posts_columns', 'add_views_columns');

function add_views_column($column_name,$post_id) {
	if($column_name == 'post_views_count') {
		$title = get_post_meta($post_id,'post_views_count',true);
	}
	if(isset($title)) {
		echo esc_attr($title);
	}
}
add_action('manage_posts_custom_column','add_views_column',10,2);

function column_orderby_custom($vars) {
	if('post_views_count' == $vars['orderby']){
		$vars = array_merge($vars, array(
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
		));
	}
	return $vars;
}
add_filter('request','column_orderby_custom');

function posts_register_sortable($sortable_column) {
	$sortable_column['post_views_count'] = 'post_views_count';
	return $sortable_column;
}
add_filter('manage_edit-post_sortable_columns','posts_register_sortable');

