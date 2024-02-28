<?php

    include '../../../../../wp-load.php';

    //Get Decription and encode
    $statusemail = $_POST["statusEmail"];
    $title = $_POST["title"];
    $stype = $_POST["stype"];
    $email = base64_encode($statusemail);

    $args = array(
        'post_type'      => $stype,
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
        if($stype == "network-etvmail"){
            $checkboxemail = $_POST["checkboxemail"];
 
            if (metadata_exists('post', $post_id, 'checkboxemail')) {
                if($checkboxemail == true){
                    update_post_meta( $post_id, 'checkboxemail', 'true'); 
                }else{
                    update_post_meta( $post_id, 'checkboxemail', 'false'); 
                }
            } else {
                if($checkboxemail == true){
                    add_post_meta( $post_id, 'checkboxemail', 'true', true );
                }else{
                    add_post_meta( $post_id, 'checkboxemail', 'false', true );
                }
            }
        }

        if(!empty($_FILES['emailattachment']['tmp_name'][0])) {

            if (metadata_exists('post', $post_id, 'attachment')) {
                $imageid = get_post_meta( $post_id, 'attachment', true );
                wp_delete_attachment( $imageid );
                delete_post_meta($post_id, 'attachment');
            }
            Add_triel_attachment($post_id);

        }


    } else {
        // No posts found
        $my_post = array(
        'post_title'    => $title,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'   => $stype,
        );
        $post_id = wp_insert_post( $my_post );
        $checkemail = get_post_meta($post_id, 'email', true);
        if (!empty($checkemail)) {
            update_post_meta( $post_id, 'email', $email);  
        } else {
            add_post_meta( $post_id, 'email', $email, true );
        }
    }

    $url = admin_url('admin.php?page=networkers-email');
    if($stype == "network-statusemail"){$url = admin_url('admin.php?page=network-email-status-scheduled');}
    if($stype == "network-avmail"){$url = admin_url('admin.php?page=network-email-status-active-visitor');}
    if($stype == "network-etvmail"){$url = admin_url('admin.php?page=network-email-status-end-trial-visitor');}
    if($stype == "network-ammail"){$url = admin_url('admin.php?page=network-email-status-active-member');}
    if($stype == "network-pmmail"){$url = admin_url('admin.php?page=network-email-status-past-member');}
    if($stype == "network-ngemail"){$url = admin_url('admin.php?page=network-email-new-register');}
    if($stype == "network-potentail"){$url = admin_url('admin.php?page=network-email-status-potential-member');}
    
    header("Location: $url"); 
    exit();
    
?>