<?php

    ob_start();

    include '../../../../../wp-load.php';

    $status = $_POST["memberstatus"];
    $firstvisit = $_POST["firstvisit"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phones = $_POST["phone"];
    $businessname = $_POST["businessname"];

    //Permitions
    $paymentcheckbox = $_POST["paymentcheckbox"];
    $newslettercheckbox = $_POST["newslettercheckbox"];
    $businessinformationcheckbox = $_POST["businessinformationcheckbox"];
    $agreecheckbox = $_POST["agreecheckbox"];
   
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
    // $query = $wpdb->prepare(
    //     'SELECT ID FROM ' . $wpdb->posts . '
    //     WHERE post_title = %s
    //     AND post_type = \'network-member\'',
    //     $businessname
    // );
    // $wpdb->query( $query );
    // if ( $wpdb->num_rows ) {
    //     $url = admin_url('admin.php?page=network-members-new&messagetitle=Duplicate Registration&message=The Group title has already been taken.');
    //     header("Location: $url"); 
    //     exit();
    // }
    //lowercap
    $post_bname = strtolower($businessname);
    //remove white space
    $post_bname2 = trim($post_bname);
    //replace space with -
    $slug = str_replace(' ', '-', $post_bname2);
    
    if($firstName){
        $post_fname = strtolower($firstName);
        $post_fname2 = trim($post_fname);
        $fslug = str_replace(' ', '-', $post_fname2);
        $slug = $slug . "-" . $fslug;
    }
    
    if($lastName){
        $post_lname = strtolower($lastName);
        //remove white space
        $post_lname2 = trim($post_lname);
        //replace space with -
        $lslug = str_replace(' ', '-', $post_lname2);
        $slug = $slug . "-" . $lslug;
    }
    
   
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

    if($paymentcheckbox == true){
        add_post_meta( $post_id, 'paymentcheckbox', 'true', true );
    }else{
        add_post_meta( $post_id, 'paymentcheckbox', 'false', true );
    }
    if($newslettercheckbox == true){
        add_post_meta( $post_id, 'newslettercheckbox', 'true', true );
    }else{
        add_post_meta( $post_id, 'newslettercheckbox', 'false', true );
    }
    if($businessinformationcheckbox == true){
        add_post_meta( $post_id, 'businessinformationcheckbox', 'true', true );
    }else{
        add_post_meta( $post_id, 'businessinformationcheckbox', 'false', true );
    }
    if($agreecheckbox == true){
        add_post_meta( $post_id, 'agreecheckbox', 'true', true );
    }else{
        add_post_meta( $post_id, 'agreecheckbox', 'false', true );
    }
        

    add_post_meta( $post_id, 'status', $status, true );
    if($firstvisit)
        add_post_meta( $post_id, 'firstvisit', $firstvisit, true );
    add_post_meta( $post_id, 'firstName', $firstName, true );
    add_post_meta( $post_id, 'lastName', $lastName, true );
    if($email)
        add_post_meta( $post_id, 'email', $email, true );
    if($description)
        add_post_meta( $post_id, 'description', $description, true );
    if($country)
        add_post_meta( $post_id, 'country', $country, true );
    if($streetaddress1)
        add_post_meta( $post_id, 'streetaddress1', $streetaddress1, true );
    if($streetaddress2)
        add_post_meta( $post_id, 'streetaddress2', $streetaddress2, true );
    if($suburb)
        add_post_meta( $post_id, 'suburb', $suburb, true );
    if($city)
        add_post_meta( $post_id, 'city', $city, true );
    if($postalcode)
        add_post_meta( $post_id, 'postalcode', $postalcode, true );
    add_post_meta( $post_id, 'payment', $payment, true );

    Add_Industry($post_id);
    

    if($phones ){
        foreach($phones as $phone) {
            if($phone)
                add_post_meta( $post_id, 'phone', $phone, false);
        }
    }
    Add_Group($post_id);

    Add_Social_Media($post_id);
    Add_Referedby($post_id);
    Add_User_Image($post_id);
    Add_User_Logo($post_id);

    $url = admin_url('admin.php?page=networkers-members');
    header("Location: $url"); 
    exit();
    
?>