<?php

function member_image_list_endpoint() {
    register_rest_route('networkers/v1', '/member/image-list', array(
        'methods' => 'GET',
        'callback' => 'member_image_list_callback',
    ));
}

function member_image_list_callback() {

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

    $images = array();
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        if (metadata_exists('post', $post_id, 'imageid')) {
            $imageid = get_post_meta( $post_id, 'imageid', true );
            $image = array($post_id, $imageid);
            array_push($images, $image);
        }
    }
    wp_reset_postdata();
    
    $total = count($images);
    if ($images) {
        // Success response
        http_response_code(200);
        echo json_encode(array("message" => "Success", "total" => $total, "images" => $images));
        //echo json_encode(array("message" => "Post created successfully", "post_id" => $post_id));
    } else {
        // Error response
        http_response_code(500);
        echo json_encode(array("message" => "Error finding images"));
    }
    
}

add_action('rest_api_init', 'member_image_list_endpoint');

?>