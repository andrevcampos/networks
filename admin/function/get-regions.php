<?php
function Get_Regions() {
    $user_role = Get_User_Role();
    if($user_role == "administrator" || $user_role == "network-admin"){
        $args = array('post_type' => 'network-region','posts_per_page' => -1);
        $regions = get_posts($args);
        return $regions;
    }else if($user_role == "franchise"){
        $user = wp_get_current_user();
        $regionss = get_user_meta( $user->ID, 'region', false );
        $regions = [];
        foreach($regionss as $regionid) {
            $region = get_post( $regionid );
            $obj = new region();
            $obj->ID = $regionid;
            $obj->post_title = $region->post_title;
            array_push($regions, $obj);
        }
        return $regions;
    }
}
?>