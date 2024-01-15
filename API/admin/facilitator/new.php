<?php

    ob_start();
    
    include '../../../../../wp-load.php';

    $name = $_POST["Name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    //Get Decription and encode
    $my_option = $_POST["my_option"];
    $encodedContent = base64_encode($my_option);

    //Check if already have Group Name
    global $user_ID, $wpdb;
    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
        WHERE post_title = %s
        AND post_type = \'network-facilitator\'',
        $name
    );
    $wpdb->query( $query );
    if ( $wpdb->num_rows ) {
        $url = admin_url('admin.php?page=networkers-facilitator-new&messagetitle=Duplicate Registration&message=The Facilitator already registered.');
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
    'post_type'   => 'network-facilitator',
    'post_name'   => $regionslug,
    );

    $post_id = wp_insert_post( $my_post );

    //Create Post Meta
    add_post_meta( $post_id, 'email', $email, true );
    add_post_meta( $post_id, 'phone', $phone, true );
    add_post_meta( $post_id, 'description', $encodedContent, true );
    
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
    $url = admin_url('admin.php?page=networkers-facilitator');
    header("Location: $url"); 
    exit();
?>