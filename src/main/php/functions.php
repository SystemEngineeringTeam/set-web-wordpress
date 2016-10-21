<?php 
if (!function_exists('setup_my_theme')):
function setup_my_theme() {
 add_theme_support('post-thumbnails');
}
endif;

add_action('after_setup_theme', 'setup_my_theme');
?>