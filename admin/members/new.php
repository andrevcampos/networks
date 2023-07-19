<?php

    include '../../../../../wp-load.php';

    $memberstatus = $_POST["memberstatus"];
    $facilitator = $_POST["facilitator"];
    if(!$facilitator)
        $facilitator = "no";
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phones = $_POST["phone"];
    $groupid = $_POST["groupid"];
    $businessname = $_POST["businessname"];
    $industryid = $_POST["industryid"];
    $socialmediatitle = $_POST["socialmediatitle"];
    $socialmedialink = $_POST["socialmedialink"];
    //Get Decription and encode
    $businessDescription = $_POST["businessDescription"];
    $description = base64_encode($businessDescription);
    $country = $_POST["country"];
    $streetaddress1 = $_POST["streetaddress1"];
    $streetaddress2 = $_POST["streetaddress2"];
    $suburb = $_POST["suburb"];
    $city = $_POST["city"];
    $postalcode = $_POST["postalcode"];
    $payment = $_POST["payment"];

    //Check if already have Group Name ---------------------
    global $user_ID, $wpdb;
    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
        WHERE post_title = %s
        AND post_type = \'network-member\'',
        $name
    );
    $wpdb->query( $query );
    if ( $wpdb->num_rows ) {
        $url = admin_url('admin.php?page=networkers-group-new&messagetitle=Duplicate Registration&message=The Group title has already been taken.');
        header("Location: $url"); 
        exit();
    }
    //lowercap
    $post_name = strtolower($businessname);
    //remove white space
    $post_name2 = trim($post_name);
    //replace space with -
    $slug = str_replace(' ', '-', $post_name2);
    //add region to slug
    $regionslug = $slug;

    //Create Post
    $my_post = array(
    'post_title'    => $businessname,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'   => 'network-member',
    'post_name'   => $regionslug,
    );

    $post_id = wp_insert_post( $my_post );

    //------------------------------------------------------------


    

    add_post_meta( $post_id, 'memberstatus', $memberstatus, true );
    add_post_meta( $post_id, 'facilitator', $facilitator, true );
    add_post_meta( $post_id, 'firstName', $firstName, true );
    add_post_meta( $post_id, 'lastName', $lastName, true );
    add_post_meta( $post_id, 'description', $description, true );
    add_post_meta( $post_id, 'country', $country, true );
    add_post_meta( $post_id, 'streetaddress1', $streetaddress1, true );
    add_post_meta( $post_id, 'streetaddress2', $streetaddress2, true );
    add_post_meta( $post_id, 'suburb', $suburb, true );
    add_post_meta( $post_id, 'city', $city, true );
    add_post_meta( $post_id, 'postalcode', $postalcode, true );
    add_post_meta( $post_id, 'payment', $payment, true );

    foreach($phones as $phone) {
        if($phone)
            add_user_meta( $user_id, 'phone', $region);
    }
    foreach($groupid as $groupidd) {
        if($groupidd)
            add_user_meta( $user_id, 'group', $groupidd);
    }
    foreach($industryid as $industryidd) {
        if($industryidd)
            add_user_meta( $user_id, 'industry', $industryidd);
    }
    if($socialmediatitle){
        for ($x = 0; $x < count($socialmediatitle); $x++) {
            $array = array("$socialmediatitle[$x]","$socialmedialink[$x]");
            add_user_meta( $user_id, 'socialmedia', $array);
        }
    }
    
    //Check if have User Image
    if(file_exists($_FILES['userimage_url']['tmp_name'][0])) {

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["userimage_url"]['tmp_name'] );

        $filename = basename( $_FILES["userimage_url"]["name"] );

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
        add_post_meta( $post_id, 'userimageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );

    }

    //Check if have Logo Image
    if(file_exists($_FILES['logo_image_url']['tmp_name'][0])) {

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["logo_image_url"]['tmp_name'] );

        $filename = basename( $_FILES["logo_image_url"]["name"] );

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
        add_post_meta( $post_id, 'logoimageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );

    }

    
    $url = admin_url('admin.php?page=networkers-member');
    header("Location: $url"); 
    exit();
    
?>