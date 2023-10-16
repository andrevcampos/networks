<?php

function group_list_endpoint() {
    register_rest_route('networkers/v1', '/group-list', array(
        'methods' => 'GET',
        'callback' => 'group_list_callback',
    ));
}

function group_list_callback() {

    include '../../../../wp-load.php';
    

    $args = array('post_type' => 'network-group','posts_per_page' => -1);
    $groupss = get_posts($args);
    $groups = [];
    foreach($groupss as $group) {
        $obj = Get_Group($group->ID);
        array_push($groups, $obj);
    }
    $total = count($groups);
    if ($groups) {
        // Success response
        http_response_code(201);
        echo json_encode(array("message" => "Success", "total" => $total, "groups" => $groups));
        //echo json_encode(array("message" => "Post created successfully", "post_id" => $post_id));
    } else {
        // Error response
        http_response_code(500);
        echo json_encode(array("message" => "Error finding groups"));
    }
    
}

add_action('rest_api_init', 'group_list_endpoint');

?>