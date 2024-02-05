<?php

// Create a custom endpoint
function my_custom_webhook_endpoint() {
    add_rewrite_rule('^webhook/?$', 'index.php?webhook=1', 'top');
}
add_action('init', 'my_custom_webhook_endpoint');

function handle_webhook_request() {
    if (get_query_var('webhook')) {
        // Process the incoming data
        $data = json_decode(file_get_contents('php://input'), true);

        // Check if the data is an array
        if (is_array($data)) {
            // Perform actions based on the received data
            // For example, update a post or trigger a specific function

            // Send a response if needed
            // wp_send_json_success('Webhook processed successfully.');

            $to = 'andrevcampos@gmail.com';
            $subject = 'Webhook Data Received';
            $message = print_r($data, true); // use print_r to convert array to string
            $headers = array('Content-Type: text/html; charset=UTF-8');

            // Send email
            wp_mail($to, $subject, $message, $headers);
        }else{
            $to = 'andrevcampos@gmail.com';
            $subject = 'Webhook Data Received';
            $message = "print_"; // use print_r to convert array to string
            $headers = array('Content-Type: text/html; charset=UTF-8');

            // Send email
            wp_mail($to, $subject, $message, $headers);
        }
    }
}

add_action('template_redirect', 'handle_webhook_request');
?>