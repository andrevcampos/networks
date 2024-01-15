<?php

include '../../../../wp-load.php';

$nid = $_GET['nid'];

$servername = "thenetworkers.co.nz";
$username = "thenetw_andre";
$password = "Andre@123!";
$dbname = "thenetw_networkers";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//User Image
$sql7 = "SELECT * FROM node__field_member_image WHERE entity_id='$nid'";
$result7 = mysqli_query($conn, $sql7);
if ($result7 && mysqli_num_rows($result7) > 0) {
    $row = mysqli_fetch_assoc($result7);
    $fid = $row['field_member_image_target_id'];
    $sql8 = "SELECT * FROM file_managed WHERE fid='$fid'";
    $result8 = mysqli_query($conn, $sql8);
    $row8 = mysqli_fetch_assoc($result8);
    $photourl2 = $row8['uri'];
    $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
    $encoded_url = str_replace(' ', '%20', $photourl);

    
    //Upload image to WP Media
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents( $encoded_url );
    if(!$image_data){
        $image_data = file_get_contents( $photourl );
    }
    if($image_data){
        $filename = basename( $photourl );
        if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
        }
        else {
        $file = $upload_dir['basedir'] . '/' . $filename;
        }
        file_put_contents( $file, $image_data );
        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file );
        add_post_meta( $post_id, 'userimageid', $attach_id, true );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }
    
}

//logo
$sql7 = "SELECT * FROM node__field_member_logo WHERE entity_id='$nid'";
$result7 = mysqli_query($conn, $sql7);
if ($result7 && mysqli_num_rows($result7) > 0) {
    $row = mysqli_fetch_assoc($result7);
    $fid = $row['field_member_logo_target_id'];
    $sql8 = "SELECT * FROM file_managed WHERE fid='$fid'";
    $result8 = mysqli_query($conn, $sql8);
    $row8 = mysqli_fetch_assoc($result8);
    $photourl2 = $row8['uri'];
    $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
    $encoded_url = str_replace(' ', '%20', $photourl);

    //Upload image to WP Media
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents( $encoded_url );
    if(!$image_data){
        $image_data = file_get_contents( $photourl );
    }
    if($image_data){
        $filename = basename( $photourl );
        if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
        }
        else {
        $file = $upload_dir['basedir'] . '/' . $filename;
        }
        file_put_contents( $file, $image_data );
        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file );
        add_post_meta( $post_id, 'logoimageid', $attach_id, true );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }
}

?>