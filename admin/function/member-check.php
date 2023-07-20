<?php

$businessname = $_GET["businessname"];

include '../../../../../wp-load.php';
global $user_ID, $wpdb;

$query = $wpdb->prepare(
    'SELECT ID FROM ' . $wpdb->posts . '
    WHERE post_title = %s
    AND post_type = \'network-member\'',
    $businessname
);

$wpdb->query( $query );
if ( $wpdb->num_rows ) {
    echo "true";
    return;
}
    
echo "false";

?>