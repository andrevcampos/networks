<?php

    include '../../../../../wp-load.php';

    $post_id = $_POST["post_id"];

    $memberstatus = $_POST["memberstatus"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phones = $_POST["phone"];
    $businessname = $_POST["businessname"];
    $orginalname = $_POST["orginalname"];

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

    if($orginalname != $businessname){

        //lowercap
        $post_name = strtolower($businessname);
        //remove white space
        $post_name2 = trim($post_name);
        //replace space with -
        $slug = str_replace(' ', '-', $post_name2);
        //add region to slug
        $regionslug = $slug;

        $my_post = array(
            'ID'           => $post_id,
            'post_title'   => $businessname,
            'post_name' => $regionslug,
        );
        wp_update_post( $my_post );

    }

    $paymentcheckboxvalue = get_post_meta($post_id, 'paymentcheckbox', true);
    if (!empty($paymentcheckboxvalue)) {
        if($paymentcheckbox == true){
            update_post_meta( $post_id, 'paymentcheckbox', 'true');
        }else{
            update_post_meta( $post_id, 'paymentcheckbox', 'false');
        }
    } else {
        if($paymentcheckbox == true){
            add_post_meta( $post_id, 'paymentcheckbox', 'true', true );
        }else{
            add_post_meta( $post_id, 'paymentcheckbox', 'false', true );
        }
    }
    $newslettercheckboxvalue = get_post_meta($post_id, 'newslettercheckbox', true);
    if (!empty($newslettercheckboxvalue)) {
        if($newslettercheckbox == true){
            update_post_meta( $post_id, 'newslettercheckbox', 'true');
        }else{
            update_post_meta( $post_id, 'newslettercheckbox', 'false');
        }
    } else {
        if($newslettercheckbox == true){
            add_post_meta( $post_id, 'newslettercheckbox', 'true', true );
        }else{
            add_post_meta( $post_id, 'newslettercheckbox', 'false', true );
        }
    }
    $businessinformationcheckboxvalue = get_post_meta($post_id, 'businessinformationcheckbox', true);
    if (!empty($businessinformationcheckboxvalue)) {
        if($businessinformationcheckbox == true){
            update_post_meta( $post_id, 'businessinformationcheckbox', 'true');
        }else{
            update_post_meta( $post_id, 'businessinformationcheckbox', 'false');
        }
    } else {
        if($businessinformationcheckbox == true){
            add_post_meta( $post_id, 'businessinformationcheckbox', 'true', true );
        }else{
            add_post_meta( $post_id, 'businessinformationcheckbox', 'false', true );
        }
    }
    $agreecheckboxvalue = get_post_meta($post_id, 'agreecheckbox', true);
    if (!empty($agreecheckboxvalue)) {
        if($agreecheckbox == true){
            update_post_meta( $post_id, 'agreecheckbox', 'true');
        }else{
            update_post_meta( $post_id, 'agreecheckbox', 'false');
        }
    } else {
        if($agreecheckbox == true){
            add_post_meta( $post_id, 'agreecheckbox', 'true', true );
        }else{
            add_post_meta( $post_id, 'agreecheckbox', 'false', true );
        }
    }

    update_post_meta( $post_id, 'status', $memberstatus );
    update_post_meta( $post_id, 'firstName', $firstName );
    update_post_meta( $post_id, 'lastName', $lastName );
    if($email)
        update_post_meta( $post_id, 'email', $email );
    if($description)
        update_post_meta( $post_id, 'description', $description );
    if($country)
        update_post_meta( $post_id, 'country', $country );
    if($streetaddress1)
        update_post_meta( $post_id, 'streetaddress1', $streetaddress1 );
    if($streetaddress2)
        update_post_meta( $post_id, 'streetaddress2', $streetaddress2 );
    if($suburb)
        update_post_meta( $post_id, 'suburb', $suburb );
    if($city)
        update_post_meta( $post_id, 'city', $city );
    if($postalcode)
        update_post_meta( $post_id, 'postalcode', $postalcode );
    update_post_meta( $post_id, 'payment', $payment );

    Update_User_Image($post_id);
    Update_User_Logo($post_id);

    Update_Industry($post_id);

    delete_post_meta( $post_id, 'phone' );
    if($phones){
        foreach($phones as $phone) {
            if($phone)
                add_post_meta( $post_id, 'phone', $phone, false);
        }
    }
    Update_Group($post_id);
    Update_Social_Media($post_id);

    Update_Referedby($post_id);

    $url = admin_url('admin.php?page=networkers-members');
    header("Location: $url"); 
    exit();
    
?>