<?php
function Get_Facilitators() {
    $args = array('post_type' => 'network-facilitator','posts_per_page' => -1);
    $facilitator = get_posts($args);
    return $facilitator;
}
?>