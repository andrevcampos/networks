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

            $to = $email;
            $subject = $title;
            $message = $emailContent;
            $headers = array('Content-Type: text/html; charset=UTF-8');

            // Send email
            wp_mail($to, $subject, $message, $headers);
        }
    }
    
    $url = admin_url("admin.php?page=networkers-members&id=$id");
    header("Location: $url"); 
    exit();
    
?>