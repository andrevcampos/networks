<?php

    include '../../../../../wp-load.php';

    $popupRemoveID = $_POST["popupRemoveID"];

    wp_delete_post( $popupRemoveID, false );

    $url = admin_url('admin.php?page=networkers-region');
    header("Location: $url"); 
    exit();
    
?>