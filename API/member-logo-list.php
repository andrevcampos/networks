<?php

function member_logo_list_endpoint() {
    register_rest_route('networkers/v1', '/member/logo-list', array(
        'methods' => 'GET',
        'callback' => 'member_logo_list_callback',
    ));
}

function member_logo_list_callback() {

    include '../../../../wp-load.php';

    $servername = "thenetworkers.co.nz";
    $username = "thenetw_andre";
    $password = "Andre@123!";
    $dbname = "thenetw_networkers";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = new WP_Query(array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
    ));

    $logos = array();
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        if (metadata_exists('post', $post_id, 'logoid')) {
            $logoid = get_post_meta( $post_id, 'logoid', true );
            $logo = array($post_id, $logoid);
            array_push($logos, $logo);
        }
    }
    wp_reset_postdata();
    
    $total = count($logos);
    if ($logos) {
        // Success response
        http_response_code(200);
        echo json_encode(array("message" => "Success", "total" => $total, "logos" => $logos));
        //echo json_encode(array("message" => "Post created successfully", "post_id" => $post_id));
    } else {
        // Error response
        http_response_code(500);
        echo json_encode(array("message" => "Error finding images"));
    }
    
}

add_action('rest_api_init', 'member_logo_list_endpoint');

?>