<?php

    include '../../../../../wp-load.php';

    $post_id = $_POST["post_id"];
    $oldstatus = $_POST["oldstatus"];
    $memberstatus = $_POST["memberstatus"];
    $email = $_POST["email"];
    $emailbox = $_POST["emailbox"];

    if($oldstatus != $memberstatus){
        update_post_meta( $post_id, 'status', $memberstatus );
        if($emailbox == true){

            $result = networkers_email_status_content($post_id, $memberstatus);
            $statusEmail = $result[0];
            $title = $result[1];
            
            $emailContent = email_model($title, $statusEmail);

            if($memberstatus == "End Trial Visitor"){
                $argss = array(
                    'post_type'      => 'network-etvmail',
                    'posts_per_page' => 1,  // Limit to only one post
                );
                $postss = get_posts($argss);
                $post_idd = $postss[0]->ID;
                $attachment = get_post_meta( $post_idd, 'attachment', true );
                $attachment_url = wp_get_attachment_url($attachment);
                $to = $email;
                $subject = $title;
                $message = $emailContent;
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $attachments = array(ABSPATH . ltrim(str_replace(site_url(), '', $attachment_url), '/')); // Use the correct file path
                print_r($attachments);
                $success = wp_mail($to, $subject, $message, $headers, $attachments);
                $url = admin_url("admin.php?page=networkers-members&id=$post_id");
                header("Location: $url"); 
                exit();
            }


            $to = $email;
            $subject = $title;
            $message = $emailContent;
            // $headers = array(
            //     'Content-Type: text/html; charset=UTF-8',
            //     'From: Your Name <your-email@example.com>', // Replace with your email and name
            // );
            //$headers[] = 'Cc: additional-email@example.com';
            $headers = array('Content-Type: text/html; charset=UTF-8');
            // Send email
            wp_mail($to, $subject, $message, $headers);
            
        }
    }
    
    $url = admin_url("admin.php?page=networkers-members&id=$post_id");
    header("Location: $url"); 
    exit();
    
?>