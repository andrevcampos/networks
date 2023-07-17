<?php

    include '../../../../../wp-load.php';

    $id = $_POST["popupRemoveID"];

    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    $user_role = $roles[0];

    //Dont have permition
    if ($user_role != 'franchise' && $user_role != 'administrator'){
        $url = admin_url('admin.php?page=networkers-group');
        header("Location: $url"); 
        exit();
        // print('<script>window.location.href="admin.php?page=networkers-group"</script>');
        // exit();
    }
    //Check if franchise have permiton to delete this group
    if($user_role == 'franchise'){
        $groupregionid = get_post_meta( $id, 'regions', true );
        $userregionids = get_user_meta( $user->ID, 'region', false );
        if (!in_array($groupregionid, $userregionids)) {
            $url = admin_url('admin.php?page=networkers-group');
            header("Location: $url"); 
            exit();
        }
    }
    //Delete the group
    $imageid = get_post_meta( $id, 'imageid', true );
    wp_delete_attachment( $imageid );
    wp_delete_post( $id, false );
    $url = admin_url('admin.php?page=networkers-group');
    header("Location: $url"); 
    exit();

?>