<?php

    include '../../../../../wp-load.php';

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
        $url = admin_url('admin.php?page=networkers-industry-new&messagetitle=Duplicate Registration&message=The Industry title has already been taken.');
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
    $regionslug = "industry-".$slug;

    $my_post = array(
    'post_title'    => $name,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'   => 'network-industry',
    'post_name'   => $regionslug,
    );

    wp_insert_post( $my_post );

    $url = admin_url('admin.php?page=networkers-industry');
    header("Location: $url"); 
    exit();
    
?>