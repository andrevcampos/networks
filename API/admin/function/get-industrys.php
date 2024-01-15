<?php
function Get_Industrys() {
    $args = array('post_type' => 'network-industry','posts_per_page' => -1,'orderby' => 'title', 'order' => 'ASC');
    $industrys = get_posts($args);
    return $industrys;
}
?>