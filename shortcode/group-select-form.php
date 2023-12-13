<?php

function group_select_form_shortcode() {
    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    $args = array(
        'post_type' => 'network-group',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => 'active', 
                'compare' => '=',
            ),
        ),
    );
    $network_groups = get_posts($args);
    foreach ($network_groups as $network_group) {
        echo '<option>' . esc_html($network_group->post_title) . '</option>';
        //$string = $string . $network_group->post_title . "<br />";
    }
    return ob_get_clean();
}
add_shortcode('groupselectform', 'group_select_form_shortcode');
?>