<?php

    include '../../../../../wp-load.php';

    
    $post_id = $_POST["postid"];
    $orginalname = $_POST["orginalname"];
    $originalimage = $_POST["originalimage"];
    if($originalimage){
        $originalurl = get_post_meta( $originalimage, '_wp_attached_file', true );
    }

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

    //Get Decription and encode
    $my_option = $_POST["my_option"];
    $encodedContent = base64_encode($my_option);

    //Change Time Formation
    $start = $starthour . ":" . $startmin . ":" . $starttime;
    $finsh = $finishhour . ":" . $finishmin . ":" . $finishtime;

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
        $regionslug = "group-".$slug;

        $my_post = array(
            'ID'           => $post_id,
            'post_title'   => $name,
            'post_name' => $regionslug,
        );
        wp_update_post( $my_post );
    }
    


    //Create Post Meta
    update_post_meta( $post_id, 'weekday', $weekday);
    update_post_meta( $post_id, 'start', $start);
    update_post_meta( $post_id, 'finsh', $finsh);
    update_post_meta( $post_id, 'description', $encodedContent);
    update_post_meta( $post_id, 'lcompany', $lcompany);
    update_post_meta( $post_id, 'laddress', $laddress);
    update_post_meta( $post_id, 'lsuburb', $lsuburb);
    update_post_meta( $post_id, 'lcity', $lcity);
    update_post_meta( $post_id, 'lpostcode', $lpostcode);

    if($regions[0]){
        update_post_meta( $post_id, 'regions', $regions[0]);
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