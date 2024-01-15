<?php
function Get_Members() {
    $args = array('post_type' => 'network-member','posts_per_page' => -1);
    $members = get_posts($args);
    return $members;
}
?>