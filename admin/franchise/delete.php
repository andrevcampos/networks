<?php

    include '../../../../../wp-load.php';

    require_once( ABSPATH.'wp-admin/includes/user.php' );

    $popupRemoveID = $_POST["popupRemoveID"];

    wp_delete_user( $popupRemoveID );

    $url = admin_url('admin.php?page=networkers-franchise');
    header("Location: $url"); 
    exit();
    
?>