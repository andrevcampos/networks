<?php
function Get_Groups() {
    $user_role = Get_User_Role();
    if($user_role == "administrator" || $user_role == "network-admin" || $user_role == "franchise"){
        $args = array('post_type' => 'network-group','posts_per_page' => -1);
        $groupss = get_posts($args);
        $groups = [];
        foreach($groupss as $group) {
            $obj = Get_Group($group->ID);
            array_push($groups, $obj);
        }
        return $groups;
    }else if($user_role == "franchise"){
        $regions = Get_Regions();
        $args = array('post_type' => 'network-group','posts_per_page' => -1);
        $groupss = get_posts($args);
        $groups = [];
        foreach($groupss as $group) {
            foreach($regions as $region) {
                if($group->ID == $region->ID){
                    $obj = Get_Group($group->ID);
                    array_push($groups, $obj);
                }
            }
        }
        return $groups;
    }
}
?>