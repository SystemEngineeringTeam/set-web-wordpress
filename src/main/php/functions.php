<?php

//サムネイルの処理
if (!function_exists('setup_my_theme')):
function setup_my_theme() {
 add_theme_support('post-thumbnails');
}
endif;

add_action('after_setup_theme', 'setup_my_theme');

//サイドバーの処理
if ( function_exists('register_sidebar') ){
 register_sidebar(array(
   'name'=>'サイドバー',
   'before_widget'=>'<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">',
   'after_widget'=>'</div>',
   'before_title' => '<div class="mdl-card__title"><h2 class="mdl-card__title-text">',
   'after_title' => '</h2></div>'
 ));
}

//アイキャッチをrssに
function rss_post_thumbnail($content) {
 global $post;
 if(has_post_thumbnail($post->ID)) {
  $content = '<p class="thumbnail">' . get_the_post_thumbnail($post->ID) . '</p>' . $content;
 }
 return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');

// カスタム投稿タイプの追加
//add_action('init', 'create_post_type');
function create_post_type() {
 
 $exampleSupports = [  // supports のパラメータを設定する配列（初期値だと title と editor のみ投稿画面で使える）
   'title',  // 記事タイトル
   'editor',  // 記事本文
   'thumbnail',  // アイキャッチ画像
   'revisions'  // リビジョン
 ];
 
 register_post_type( 'event',
   array(
     'menu_icon' => 'dashicons-clipboard',
     'labels' => array(
       'name' => __( '投稿 [イベント]' ),
       'singular_name' => __( 'イベント' ),
       'all_items' => __( 'イベント記事一覧' )
     ),
     'public' => true,
     'has_archive' => true,
     'menu_position' =>5,
     'supports' => $exampleSupports,
     'taxonomies' => array('category', 'post_tag')
   )
   );
}

//カスタム投稿タイプのデフォルトカテゴリを固定
//$housecatを場合によっては変更してください
//add_action('publish_event', 'add_set_housecategory_automatically');
function add_set_housecategory_automatically($post_ID) {
 global $wpdb;
 if(!wp_is_post_revision($post_ID)) {
  $housecat = 'event';
  wp_set_object_terms( $post_ID, $housecat, 'category');
 }
}


// 'post', -'page' および 'event' 投稿タイプの投稿をホームページに表示する
//add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
function add_my_post_types_to_query( $query ) {
 
  if ( is_home() && $query->is_main_query() ){
    //index でもイベントを表示
    $query->set('post_type', array( 'post', 'event' ));
  }else if(is_category() && $query->is_main_query()){
    //カテゴリーページ
    $query->set('post_type', array( 'post', 'event' ));
  }
  return $query;
}



//URL
function myposttype_permalink($post_link, $id = 0, $leavename) {
 global $wp_rewrite;
 $post = &get_post($id);
 if ( is_wp_error( $post ) )
  return $post;
  $newlink = $wp_rewrite->get_extra_permastruct($post->post_type);
  $newlink = str_replace('%'.$post->post_type.'%', $post->ID, $newlink);
  $newlink = home_url(user_trailingslashit($newlink));
  return $newlink;
}
//add_filter('post_type_link', 'myposttype_permalink', 1, 3);




//カスタムフィールド(イベント用)

define('SET_ADD_FIELD_TYPE', 'post');//どの投稿にカスタムフィールドを追加するか

add_action('admin_menu', 'add_set_custom_field');
add_action('save_post', 'save_set_event_date');
add_action('save_post', 'save_set_event_location');


function add_set_custom_field(){
 if(function_exists('add_set_custom_field')){
  add_meta_box('event_date', '[イベント予告] 開催日', 'insert_event_date', SET_ADD_FIELD_TYPE, 'normal', 'high');
  add_meta_box('event_location', '[イベント予告] 開催場所', 'insert_event_location', SET_ADD_FIELD_TYPE, 'normal', 'high');
 }
}

function insert_event_date(){
 global $post;
 wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
 echo '<label class="hidden" for="event_date">開催日</label><input type="datetime-local" name="event_date" size="20" value="'.esc_html(get_post_meta($post->ID, 'event_date', true)).'" />';
 echo '<p>イベントの開催日を入力します。</p>';
}

function insert_event_location(){
 global $post;
 wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
 echo '<label class="hidden" for="event_location">開催場所</label><input type="text" name="event_location" size="60" value="'.esc_html(get_post_meta($post->ID, 'event_location', true)).'" />';
 echo '<p>イベントの開催場所を入力します。</p>';
}

//日付
function save_set_event_date($post_id){
 $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
 if(!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
  return $post_id;
 }
 if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
 if(!current_user_can('edit_post', $post_id)) { return $post_id; }

 $data = $_POST['event_date'];

 if(get_post_meta($post_id, 'event_date') == ""){
  add_post_meta($post_id, 'event_date', $data, true);
 }elseif($data != get_post_meta($post_id, 'event_date', true)){
  update_post_meta($post_id, 'event_date', $data);
 }elseif($data == ""){
  delete_post_meta($post_id, 'event_date', get_post_meta($post_id, 'event_date', true));
 }
}

//場所
function save_set_event_location($post_id){
 $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
 if(!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
  return $post_id;
 }
 if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
 if(!current_user_can('edit_post', $post_id)) { return $post_id; }

 $data = $_POST['event_location'];

 if(get_post_meta($post_id, 'event_location') == ""){
  add_post_meta($post_id, 'event_location', $data, true);
 }elseif($data != get_post_meta($post_id, 'event_location', true)){
  update_post_meta($post_id, 'event_location', $data);
 }elseif($data == ""){
  delete_post_meta($post_id, 'event_location', get_post_meta($post_id, 'event_location', true));
 }
}

?>