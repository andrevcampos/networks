<?php

    include '../../../../../wp-load.php';

    $name = $_POST["name"];
    $weekday = $_POST["weekday"];
    $starthour = $_POST["starthour"];
    $startmin = $_POST["startmin"];
    $starttime = $_POST["starttime"];
    $finishhour = $_POST["finishhour"];
    $finishmin = $_POST["finishmin"];
    $finishtime = $_POST["finishtime"];
    $description = $_POST["description"];
    $lcompany = $_POST["lcompany"];
    $laddress = $_POST["laddress"];
    $lsuburb = $_POST["lsuburb"];
    $lcity = $_POST["lcity"];
    $lpostcode = $_POST["lpostcode"];
    $regions = $_POST["regionid"];
    $facilitator = $_POST["facilitator"];

    //Get Decription and encode
    $my_option = $_POST["my_option"];
    $encodedContent = base64_encode($my_option);

    //Change Time Formation
    $start = $starthour . ":" . $startmin . ":" . $starttime;
    $finsh = $finishhour . ":" . $finishmin . ":" . $finishtime;
    
    //Check if already have Group Name
    global $user_ID, $wpdb;
    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
        WHERE post_title = %s
        AND post_type = \'network-group\'',
        $name
    );
    $wpdb->query( $query );
    if ( $wpdb->num_rows ) {
        $url = admin_url('admin.php?page=networkers-group-new&messagetitle=Duplicate Registration&message=The Group title has already been taken.');
        header("Location: $url"); 
        exit();
    }

    //lowercap
    $post_name = strtolower($name);
    //remove white space
    $post_name2 = trim($post_name);
    //replace space with -
    $slug = str_replace(' ', '-', $post_name2);
    //add region to slug
    $regionslug = $slug;

    //Create Post
    $my_post = array(
    'post_title'    => $name,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'   => 'network-group',
    'post_name'   => $regionslug,
    );

    $post_id = wp_insert_post( $my_post );

    //Create Post Meta
    add_post_meta( $post_id, 'weekday', $weekday, true );
    add_post_meta( $post_id, 'start', $start, true );
    add_post_meta( $post_id, 'finsh', $finsh, true );
    add_post_meta( $post_id, 'description', $encodedContent, true );
    add_post_meta( $post_id, 'company', $lcompany, true );
    add_post_meta( $post_id, 'address1', $laddress, true );
    add_post_meta( $post_id, 'address2', $laddress, true );
    add_post_meta( $post_id, 'suburb', $lsuburb, true );
    add_post_meta( $post_id, 'city', $lcity, true );
    add_post_meta( $post_id, 'postcode', $lpostcode, true );
    if($regions[0]){
        add_post_meta( $post_id, 'regions', $regions[0], true );
    }
    if($facilitator){
        add_post_meta( $post_id, 'facilitator', $facilitator, true );
    }
    
    //Check if have Image
    if(file_exists($_FILES['image_url']['tmp_name'][0])) {

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["image_url"]['tmp_name'] );

        $filename = basename( $_FILES["image_url"]["name"] );

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

        //Add image ulr to postmeta
        add_post_meta( $post_id, 'imageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        
    }
    $url = admin_url('admin.php?page=networkers-group');
    header("Location: $url"); 
    exit();
?>