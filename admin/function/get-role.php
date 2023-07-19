<?php
function Get_User_Role() {
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    $user_role = $roles[0];
    return $user_role;
}
?>