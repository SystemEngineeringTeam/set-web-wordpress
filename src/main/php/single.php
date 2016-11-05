<?php
    $post = $wp_query->post;
    if ( in_category('event-plans') ) {
        include(TEMPLATEPATH.'/single/single-event-plans.php');
    } else {
        include(TEMPLATEPATH.'/single/single-normal.php');
    };
?>