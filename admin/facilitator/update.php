<?php

    include '../../../../../wp-load.php';

    $post_id = $_POST["postid"];
    $orginalname = $_POST["orginalname"];
    $originalimage = $_POST["originalimage"];

    $name = $_POST["Name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    //Get Decription and encode
    $Description2 = $_POST["my_option"];
    $description = base64_encode($Description2);

    if($orginalname != $name){

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

    update_post_meta( $post_id, 'email', $email );
    update_post_meta( $post_id, 'phone', $phone );
    update_post_meta( $post_id, 'description', $description );
    
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

    $url = admin_url('admin.php?page=networkers-facilitator');
    header("Location: $url"); 
    exit();
    
?>