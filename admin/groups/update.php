<?php

    ob_start();

    include '../../../../../wp-load.php';

    
    $post_id = $_POST["postid"];
    $orginalname = $_POST["orginalname"];
    $originalimage = $_POST["originalimage"];
    if($originalimage){
        $originalurl = get_post_meta( $originalimage, '_wp_attached_file', true );
    }

    $name = $_POST["name"];
    $status = $_POST["status"];
    $weekday = $_POST["weekday"];
    $starthour = $_POST["starthour"];
    $startmin = $_POST["startmin"];
    $starttime = $_POST["starttime"];
    $finishhour = $_POST["finishhour"];
    $finishmin = $_POST["finishmin"];
    $finishtime = $_POST["finishtime"];
    $description = $_POST["groupdescription"];
    $lcompany = $_POST["lcompany"];
    $laddress = $_POST["laddress"];
    $laddress2 = $_POST["laddress2"];
    $lsuburb = $_POST["lsuburb"];
    $lcity = $_POST["lcity"];
    $lpostcode = $_POST["lpostcode"];
    $regions = $_POST["regionid"];
    $facilitator = $_POST["facilitatorid"];

    //Get Decription and encode
    $my_option = $_POST["groupdescription"];
    $my_option = stripslashes($my_option);
    $encodedContent = base64_encode($my_option);

    //Change Time Formation
    $start = $starthour . ":" . $startmin . ":" . $starttime;
    $finish = $finishhour . ":" . $finishmin . ":" . $finishtime;

    if($name != $orginalname){

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

        $my_post = array(
            'ID'           => $post_id,
            'post_title'   => $name,
            'post_name' => $regionslug,
        );
        wp_update_post( $my_post );
    }
    


    //Create Post Meta
    update_post_meta( $post_id, 'status', $status);
    update_post_meta( $post_id, 'weekday', $weekday);
    update_post_meta( $post_id, 'start', $start);
    update_post_meta( $post_id, 'finish', $finish);
    update_post_meta( $post_id, 'description', $encodedContent);
    if (metadata_exists('post', $post_id, 'company')) {
        update_post_meta( $post_id, 'company', $lcompany);
    }else{
        add_post_meta( $post_id, 'company', $lcompany, true );
    }

    if (metadata_exists('post', $post_id, 'address1')) {
        update_post_meta( $post_id, 'address1', $laddress);
    }else{
        add_post_meta( $post_id, 'address1', $laddress, true );
    }

    if (metadata_exists('post', $post_id, 'address2')) {
        update_post_meta( $post_id, 'address2', $laddress2);
    }else{
        add_post_meta( $post_id, 'address2', $laddress2, true );
    }

    if (metadata_exists('post', $post_id, 'suburb')) {
        update_post_meta( $post_id, 'suburb', $lsuburb);
    }else{
        add_post_meta( $post_id, 'suburb', $lsuburb, true );
    }

    if (metadata_exists('post', $post_id, 'city')) {
        update_post_meta( $post_id, 'city', $lcity);
    }else{
        add_post_meta( $post_id, 'city', $lcity, true );
    }
    if (metadata_exists('post', $post_id, 'postcode')) {
        update_post_meta( $post_id, 'postcode', $lpostcode);
    }else{
        add_post_meta( $post_id, 'postcode', $lpostcode, true );
    }

    if($regions[0]){
        update_post_meta( $post_id, 'regions', $regions[0]);
        if (metadata_exists('post', $post_id, 'regions')) {
            update_post_meta( $post_id, 'regions', $regions[0]);
        }else{
            add_post_meta( $post_id, 'regions', $regions[0], true );
        }
    }else{
        if (metadata_exists('post', $post_id, 'regions')) {
            update_post_meta( $post_id, 'regions', "");
        }
    }

    if($facilitator[0]){
        if (metadata_exists('post', $post_id, 'facilitator')) {
            update_post_meta( $post_id, 'facilitator', $facilitator[0]);
        }else{
            add_post_meta( $post_id, 'facilitator', $facilitator[0], true );
        }
    }else{
        if (metadata_exists('post', $post_id, 'facilitator')) {
            update_post_meta( $post_id, 'facilitator', "");
        }
    }

    //Update image if have any change.
    if(!$originalimage){
        //Check if have Image
        if(file_exists($_FILES['image_url']['tmp_name'][0])) {

            //remove the old post
            $imageid = get_post_meta( $post_id, 'imageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'imageid');

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

        }else{
            //remove image 
            $imageid = get_post_meta( $post_id, 'imageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'imageid');
        }
    }
    
    $url = admin_url('admin.php?page=networkers-group');
    header("Location: $url");
    exit();
?>