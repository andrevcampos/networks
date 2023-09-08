<?php

    include '../../../../../wp-load.php';

    $popupRemoveID = $_POST["popupRemoveID"];

    //Delete User Image from Media if have one. 
    Delete_User_Image($popupRemoveID);
    //Delete User Logo from Media if have one. 
    Remove_User_Logo($popupRemoveID);

    wp_delete_post( $popupRemoveID, false );

    $url = admin_url('admin.php?page=networkers-members');
    header("Location: $url"); 
    exit();
    
?>