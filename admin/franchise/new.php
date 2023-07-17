<?php

include '../../../../../wp-load.php';

$login = $_POST["login"];
$password = $_POST["password"];
$first_name = $_POST["firstName"];
$last_name = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$region = $_POST["regionid"];

if( !username_exists( $login )  && !email_exists( $email ) ){ 
$user_id = wp_create_user( $login, $password, $email ); 
$user = new WP_User( $user_id ); 
$user->set_role( 'franchise' ); 

$nickname = $first_name . " " . $last_name;

$user_id = wp_update_user( array( 'ID' => $user_id, 'role' => 'franchise', 'display_name' => $nickname, 'first_name' => $first_name, 'last_name' => $last_name ) );

add_user_meta( $user_id, 'phone', $phone);


foreach($_POST['region'] as $region) {
    add_user_meta( $user_id, 'region', $region);
}

if ( is_wp_error( $user_id ) ) { 
    //There was an error, probably that user doesn't exist. 
} else { 
    $url = admin_url('admin.php?page=networkers-franchise');
    header("Location: $url"); 
    exit();
}

}else{ 

    $url = admin_url('admin.php?page=network-franchise-new&messagetitle=Duplicate Registration&message=The Franchise username or email alrady exist');
    header("Location: $url"); 
    exit();
}
    
?>