<?php

    include '../../../../../wp-load.php';

    $popupRemoveID = $_POST["popupRemoveID"];

    //Remove Image
    $imageid = get_post_meta( $popupRemoveID, 'regionimageid', true );
    if($imageid){
        wp_delete_attachment( $imageid );
    }

    wp_delete_post( $popupRemoveID, false );

    $url = admin_url('admin.php?page=networkers-region');
    header("Location: $url"); 
    exit();
    
?>