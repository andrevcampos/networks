<?php

    include '../../../../../wp-load.php';

    $id = $_POST["popupRemoveID"];

    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    //$user_role = $roles[0];
    $user_role = Get_User_Role();

    //Dont have permition
    // if ($user_role != 'administrator'){
    //     $url = admin_url('admin.php?page=networkers-facilitator');
    //     header("Location: $url"); 
    //     exit();
    // }
    //Delete the facilitator
    $imageid = get_post_meta( $id, 'imageid', true );
    wp_delete_attachment( $imageid );
    wp_delete_post( $id, false );
    $url = admin_url('admin.php?page=networkers-facilitator');
    header("Location: $url"); 
    exit();

?>