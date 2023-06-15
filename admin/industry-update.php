<?php

    include '../../../../wp-load.php';

    $id = $_POST["networkersid"];
    $name = $_POST["name"];

    global $user_ID, $wpdb;
    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
        WHERE post_title = %s
        AND post_type = \'network-industry\'',
        $name
    );
    $wpdb->query( $query );

    if ( $wpdb->num_rows ) {
        $url = admin_url('admin.php?page=networkers-industry&messagetitle=Duplicate Registration&message=The Industry name has already been taken.');
        header("Location: $url"); 
        exit();
    }

    //lowercap
    $post_name = strtolower($name);
    //remove white space
    $post_name2 = trim($post_name);
    //replace space with -
    $slug = str_replace(' ', '-', $post_name2);
    //add region to slug
    $regionslug = "region-".$slug;

    $my_post = array(
        'ID'           => $id,
        'post_title'   => $name,
        'post_name'    => $regionslug,
    );
  
    wp_update_post( $my_post );

    $url = admin_url('admin.php?page=networkers-industry');
    header("Location: $url"); 
    exit();
    
?>