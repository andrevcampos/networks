<?php

    include '../../../../wp-load.php';

    $removeid = $_POST["removeid"];

    wp_delete_post( $removeid, false );

    $url = admin_url('admin.php?page=networkers-industry');
    header("Location: $url"); 
    exit();
    
?>