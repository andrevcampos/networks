<?php

function member_upload_image_endpoint() {
    register_rest_route('networkers/v1', '/member/upload-image', array(
        'methods' => 'GET',
        'callback' => 'member_upload_image_callback',
    ));
}

function member_upload_image_callback($request) {

    include '../../../../wp-load.php';

    $post_id = $request->get_param('postid');
    $imageid = $request->get_param('imageid');

    $servername = "thenetworkers.co.nz:3306";
    $username = "thenetwo_andre";
    $password = "zxezsu0MCXGR";
    $dbname = "thenetwo_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = new WP_Query(array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
    ));

    //User Image
    $sql8 = "SELECT * FROM file_managed WHERE fid='$imageid'";
    $result8 = mysqli_query($conn, $sql8);
    if ($result8) {
        $row8 = mysqli_fetch_assoc($result8);
        if ($row8) {
            $photourl2 = $row8['uri'];
            $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
            $encoded_url = str_replace(' ', '%20', $photourl);

            // Upload image to WP Media
            $upload_dir = wp_upload_dir();
            $image_data = file_get_contents($encoded_url);
            if (!$image_data) {
                // Fallback to the original URL
                $image_data = file_get_contents($photourl);
            }

            if ($image_data) {
                $filename = basename($photourl);
                if (wp_mkdir_p($upload_dir['path'])) {
                    $file = $upload_dir['path'] . '/' . $filename;
                } else {
                    $file = $upload_dir['basedir'] . '/' . $filename;
                }

                if (file_put_contents($file, $image_data)) {
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    delete_post_meta($post_id, 'imageid');
                    $attach_id = wp_insert_attachment($attachment, $file);

                    if (!is_wp_error($attach_id)) {
                        add_post_meta($post_id, 'userimageid', $attach_id, true);
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                    }
                }else{
                    delete_post_meta($post_id, 'imageid');
                }
            }else{
                delete_post_meta($post_id, 'imageid');
            }
        } else {
            // Handle the case where $row8 is empty
            delete_post_meta($post_id, 'imageid');
        }
    } else {
        // Handle the SQL query error
        delete_post_meta($post_id, 'imageid');
    }

    // Success response
    http_response_code(200);
    echo json_encode(array("message" => "Success"));
    
}

add_action('rest_api_init', 'member_upload_image_endpoint');

?>