<?php

    include '../../../../wp-load.php';

    $id = $_POST["editregionid"];
    $name = $_POST["editregionname"];

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

    $url = admin_url('admin.php?page=networkers-region');
    header("Location: $url"); 
    exit();
    
?>