<?php

    include '../../../../../wp-load.php';

    //Get Decription and encode
    $statusemail = $_POST["statusEmail"];
    $title = $_POST["title"];
    $email = base64_encode($statusemail);

    $args = array(
        'post_type'      => 'network-avmail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);

    if(!$title){$title = "Status Update";}
    
    if ($posts) {
        $post_id = $posts[0]->ID;

        $my_post = array(
            'ID'           => $post_id,
            'post_title'   => $title,
        );
        wp_update_post( $my_post );
        
        if (metadata_exists('post', $post_id, 'email')) {
            update_post_meta( $post_id, 'email', $email);  
            
        } else {
            add_post_meta( $post_id, 'email', $email, true );
        }

    } else {
        // No posts found
        $my_post = array(
        'post_title'    => $title,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'   => 'network-avmail',
        );
        $post_id = wp_insert_post( $my_post );
        $checkemail = get_post_meta($post_id, 'email', true);
        if (!empty($checkemail)) {
            update_post_meta( $post_id, 'email', $email);  
        } else {
            add_post_meta( $post_id, 'email', $email, true );
        }
    }

    $url = admin_url('admin.php?page=network-email-status-active-visitor');
    header("Location: $url"); 
    exit();
    
?>