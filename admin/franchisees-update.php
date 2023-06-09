<?php

include '../../../../wp-load.php';

$userid = $_POST["userid"];
$login = $_POST["login"];
$password = $_POST["password"];
$first_name = $_POST["firstName"];
$last_name = $_POST["lastName"];
$oldemail = $_POST["oldemail"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$region = $_POST["region"];

if( email_exists( $email ) && $oldemail != $email ){ 
    echo "The new email alrady registered";
    return;
}

$nickname = $first_name . " " . $last_name;
if($password){
    wp_set_password( $password, $userid );
}
$user_id = wp_update_user( array( 'ID' => $userid, 'user_pass' => $password, 'user_email' => $email, 'display_name' => $nickname, 'first_name' => $first_name, 'last_name' => $last_name ) );
update_user_meta( $userid, 'phone', $phone);
update_user_meta( $userid, 'region', $region);

$url = admin_url('admin.php?page=networkers-franchisees-update&message=User update successful');

header("Location: $url"); 
exit();

?>