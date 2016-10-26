<?php
if (!function_exists('setup_my_theme')):
function setup_my_theme() {
 add_theme_support('post-thumbnails');
}
endif;

add_action('after_setup_theme', 'setup_my_theme');

if ( function_exists('register_sidebar') ){
 register_sidebar(array(
   'name'=>'サイドバー',
   'before_widget'=>'<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">',
   'after_widget'=>'</div>',
   'before_title' => '<div class="mdl-card__title"><h2 class="mdl-card__title-text">',
   'after_title' => '</h2></div>'
 ));
}



?>