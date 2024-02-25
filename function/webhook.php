<?php

// Create a custom endpoint
function my_custom_webhook_endpoint() {
    add_rewrite_rule('^webhook$', 'index.php?webhook=1', 'top');
    add_rewrite_tag('%webhook%', '([^&]+)');
}
add_action('init', 'my_custom_webhook_endpoint');

function handle_webhook_request() {
    global $wp;
    if (isset($wp->query_vars['webhook'])) {
        // Process the incoming data
        //$data = json_decode(file_get_contents('php://input'), true);
        $data = $_POST;
        $serialized = serialize($data);
        $decodedData = unserialize($serialized);
          
        $email = isset($decodedData['Email_address']) ? $decodedData['Email_address'] : null;
        $businessname = isset($decodedData['Business_name']) ? $decodedData['Business_name'] : null;
        $firstName = isset($decodedData['First_name']) ? $decodedData['First_name'] : null;
        $lastName = isset($decodedData['Last_name']) ? $decodedData['Last_name'] : null;
        $phone = isset($decodedData['Your_phone']) ? $decodedData['Your_phone'] : null;
        $formmessage = isset($decodedData['Message']) ? $decodedData['Message'] : null;
        //region info
        $regionid = isset($decodedData['Region']) ? $decodedData['Region'] : null;
        $regiontitle = get_the_title($regionid);
        //group info
        $groupid = isset($decodedData['Preferred_group']) ? $decodedData['Preferred_group'] : null;
        $grouptitle = get_the_title($groupid);
        

        $args3 = array(
            'role'       => 'franchise',
            'meta_query' => array(
                array(
                    'key'   => 'region',
                    'value' => $regionid,
                ),
            ),
        );
        $user_query = new WP_User_Query($args3);
        $fusers = $user_query->get_results();

        $args4 = array(
            'role'       => 'network-admin',
        );
        $user_query = new WP_User_Query($args4);
        $ausers = $user_query->get_results();
        


        //wp_send_json_success('Webhook processed successfully.');


        $post_bname = strtolower($businessname);
        $post_bname2 = trim($post_bname);
        $slug = str_replace(' ', '-', $post_bname2);
          
        if($firstName){
            $post_fname = strtolower($firstName);
            $post_fname2 = trim($post_fname);
            $fslug = str_replace(' ', '-', $post_fname2);
            $slug = $slug . "-" . $fslug;
        }
        if($lastName){
            $post_lname = strtolower($lastName);
            $post_lname2 = trim($post_lname);
            $lslug = str_replace(' ', '-', $post_lname2);
            $slug = $slug . "-" . $lslug;
        }
        $regionslug = $slug;
      
        //Create Post
        $my_post = array(
        'post_title'    => $businessname,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'   => 'network-member',
        'post_name'   => $regionslug,
        );
      
        $post_id = wp_insert_post( $my_post );
      
        add_post_meta( $post_id, 'status', 'Potential Member', true );
        add_post_meta( $post_id, 'firstName', $firstName, true );
        add_post_meta( $post_id, 'lastName', $lastName, true );
        add_post_meta( $post_id, 'email', $email, true );
        add_post_meta( $post_id, 'country', 'New Zealand', true );
        add_post_meta( $post_id, 'payment', 'N/A', true );
        add_post_meta( $post_id, 'phone', $phone, false);
        add_post_meta( $post_id, 'group', $groupid, false);
        add_post_meta( $post_id, 'paymentcheckbox', 'false', true );
        add_post_meta( $post_id, 'newslettercheckbox', 'false', true );
        add_post_meta( $post_id, 'businessinformationcheckbox', 'false', true );
        add_post_meta( $post_id, 'agreecheckbox', 'false', true );
        

        // Email to new user
        $result = webhook_new_register_user_message($businessname, $firstName, $lastName, $grouptitle, $regiontitle);
        $statusEmail = $result[0];
        $title = $result[1];
        $to = $email;
        $subject = $title;
        $message = email_model($subject, $statusEmail);
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);

        // Email to All Franchise
        if (!empty($fusers)) {
            foreach ($fusers as $user) {
                $femail = $user->user_email;
                $nickname = $user->display_name;
                $writemessage = webhook_new_register_admin_message($nickname, $businessname, $firstName, $lastName, $email, $phone, $regiontitle, $grouptitle, $formmessage);
                $to = $femail;
                $subject = 'New Registration';
                $message = email_model($subject, $writemessage);
                $headers = array('Content-Type: text/html; charset=UTF-8');
                wp_mail($to, $subject, $message, $headers);
            }
        }

        // Email to All Networkers Admin
        if (!empty($ausers)) {
            foreach ($ausers as $user) {
                $aemail = $user->user_email;
                $nickname = $user->display_name;
                $writemessage = webhook_new_register_admin_message($nickname, $businessname, $firstName, $lastName, $email, $phone, $regiontitle, $grouptitle, $formmessage);
                $to = $aemail;
                $subject = 'New Registration';
                $message = email_model($subject, $writemessage);
                $headers = array('Content-Type: text/html; charset=UTF-8');
                wp_mail($to, $subject, $message, $headers);
            }
        }
    }
}
add_action('template_redirect', 'handle_webhook_request');


function webhook_new_register_admin_message($nickname, $businessname, $firstName, $lastName, $email, $phone, $regiontitle, $grouptitle, $formmessage ) {

    $message = "
        <p style='margin:0px;padding:0px;margin-top:5px'>Hello $nickname,</p>
        <p style='margin:0px;padding:0px;margin-top:5px'>A new user has registered on our website. Please find the details below:</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Business Name</strong></p>
        <p style='margin:0px;padding:0px;'>$businessname</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>First Name</strong></p>
        <p style='margin:0px;padding:0px;'>$firstName</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Last Name</strong></p>
        <p style='margin:0px;padding:0px;'>$lastName</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Email</strong></p>
        <p style='margin:0px;padding:0px;'>$email</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Phone</strong></p>
        <p style='margin:0px;padding:0px;'>$phone</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Region</strong></p>
        <p style='margin:0px;padding:0px;'>$regiontitle</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Group</strong></p>
        <p style='margin:0px;padding:0px;'>$grouptitle</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Message</strong></p>
        <p style='margin:0px;padding:0px;'>$formmessage</p>
    ";
    return $message;

}

function webhook_new_register_user_message($businessname, $firstName, $lastName, $grouptitle, $regiontitle) {

    $name = $firstName . " " . $lastName;
    $args = array(
        'post_type'      => 'network-ngemail',
        'posts_per_page' => 1,
    );
    $posts = get_posts($args);
    $post_idd = $posts[0]->ID;
    $title = $posts[0]->post_title;
    $post_content = get_post_meta( $post_idd, 'email', true );
    $statusEmail = base64_decode($post_content);
    $statusEmail = html_entity_decode($statusEmail);
    $statusEmail = stripslashes($statusEmail);
    $statusEmail = str_replace('{{name}}', $name, $statusEmail);
    $statusEmail = str_replace('{{businessname}}', $businessname, $statusEmail);
    $statusEmail = str_replace('{{grouptitle}}', $grouptitle, $statusEmail);
    $statusEmail = str_replace('{{regiontitle}}', $regiontitle, $statusEmail);

    return array($statusEmail, $title);

}


?>