<?php

    include '../../../../wp-load.php';

    $name = $_POST["name"];

    $args = array(
        'post_type' => "network-region",
        'post_title' => $name,
      );
    $latest_posts = get_posts( $args );

    if(count($latest_posts) > 0 ){
        $url = admin_url('admin.php?page=network-region-new&messagetitle=Duplicate Registration&message=The region title has already been taken.');
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
    'post_title'    => $name,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'   => 'network-region',
    'post_name'   => $regionslug,
    );

    wp_insert_post( $my_post );

    $url = admin_url('admin.php?page=networkers-region');
    header("Location: $url"); 
    exit();
    
?>