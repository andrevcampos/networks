<?php

    include '../../../../../wp-load.php';

    $userid = $_POST["userid"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $oldemail = $_POST["oldemail"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $regions = $_POST["regionid"];

    if( email_exists( $email ) && $oldemail != $email ){ 
        $url = admin_url('admin.php?page=network-franchise-new&messagetitle=Duplicate Registration&message=The new email is already registered');
        header("Location: $url"); 
        exit();
    }

    $nickname = $first_name . " " . $last_name;
    if($password){
        wp_set_password( $password, $userid );
    }
    $user_id = wp_update_user( array( 'ID' => $userid, 'user_pass' => $password, 'user_email' => $email, 'display_name' => $nickname, 'first_name' => $first_name, 'last_name' => $last_name ) );
    update_user_meta( $userid, 'phone', $phone);

    delete_user_meta( $userid, 'region' );
    foreach($regions as $region) {
        add_user_meta( $userid, 'region', $region);
    }

    $url = admin_url('admin.php?page=networkers-franchise');
    header("Location: $url"); 
    exit();
    
?>