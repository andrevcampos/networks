<?php
function Get_Member_List($membername, $businessname, $region, $industry) {

    if($region == null){$region = "";}
    if($industry == null){$industry = "";}
    if($businessname == null){$businessname = "";}
    if($membername == null){$membername = "";}

    $memberarray = [];
    if($region){
        $memberarray = Get_Member_List_Region($region);
        if($industry){
            $memberarray = Get_Member_List_Industry($industry, $memberarray);
        }
        if($businessname){
            $memberarray = Get_Member_List_Business($businessname, $memberarray);
        }
        if($membername){
            $memberarray = Get_Member_List_Member($membername, $memberarray);
        }
        return $memberarray;
    }
    

    if($membername){
        $args = array(
            'post_type'      => 'network-member',
            'posts_per_page' => -1,
            'meta_query'     => array(
                'relation' => 'AND',
                array(
                    'key'     => 'status',
                    'value'   => 'Active Member',
                    'compare' => '=',
                ),
                array(
                    'relation' => 'OR', 
                    array(
                        'key'     => 'firstName',
                        'value'   => $membername,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => 'lastName',
                        'value'   => $membername,
                        'compare' => 'LIKE',
                    ),
                ),
            ),
        );
        $members = get_posts($args);
        if($industry){
            $members = Get_Member_List_Industry($industry, $members);
        }
        return $members;
    }

    if($businessname){
        $args = array(
            'post_type'      => 'network-member',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => 'status',
                    'value'   => 'Active Member',
                    'compare' => '=',
                ),
            ),
            's'     => $businessname,
        );
        $members = get_posts($args);
        if($industry){
            $members = Get_Member_List_Industry($industry, $members);
        }
        return $members;
    }

    if($industry){
        $args = array(
            'post_type' => 'network-member',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'status',
                    'value' => 'Active Member', 
                    'compare' => '=',
                ),
            ),
        );
        $members = get_posts($args);
        $members = Get_Member_List_Industry($industry, $members);
        return $members;
    }

    $args = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => 'Active Member', 
                'compare' => '=',
            ),
        ),
    );
    $members = get_posts($args);
    return $members;
}

function Get_Member_List_Region($region) {
    $args2 = array(
        'post_type' => 'network-group',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'regions',
                'value' => $region, 
                'compare' => '=',
            ),
        ),
    );
    $groups = get_posts($args2);
    $membersaway = [];
    foreach($groups as $group) {
        $args3 = array(
            'post_type' => 'network-member',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'status',
                    'value'   => 'Active Member',
                    'compare' => '=',
                ),
                array(
                    'key' => 'group',
                    'value' => $group->ID, 
                    'compare' => '=',
                ),
            ),
        );
        $members = get_posts($args3);
        foreach($members as $member) {
            array_push($membersaway, $member);
        }
    }
    return $membersaway;
}

function Get_Member_List_Industry($industry, $members) {
    $memberarray = [];
    foreach($members as $memberr) {
        $obj = Get_Member($memberr->ID);
        $industrys = $obj->industry;
        foreach($industrys as $industryid) {
            if($industry == $industryid){
                array_push($memberarray, $memberr);
            }
        }
    }
    return $memberarray;
}

function Get_Member_List_Business($business, $members) {
    $memberarray = [];
    foreach ($members as $member) {
        if(stripos($member->post_title, $business) !== false) {
            array_push($memberarray, $member);
        }
    }
    return $memberarray;
}
function Get_Member_List_Member($membername, $members) {
    $memberarray = [];
    foreach ($members as $member) {
        $obj = Get_Member($member->ID); // Corrected variable name
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        if(stripos($firstname, $membername) !== false || stripos($lastname, $membername) !== false) {
            array_push($memberarray, $member);
        }
    }
    return $memberarray;
}




?>