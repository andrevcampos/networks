<?php

    include '../../../../../wp-load.php';

    $regionremoveid = $_POST["regionremoveid"];

    wp_delete_post( $regionremoveid, false );

    $url = admin_url('admin.php?page=networkers-region');
    header("Location: $url"); 
    exit();
    
?>