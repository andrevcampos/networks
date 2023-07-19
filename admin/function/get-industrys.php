<?php
function Get_Industry() {
    $args = array('post_type' => 'network-industry','posts_per_page' => -1);
    $industrys = get_posts($args);
    return $industrys;
}
?>