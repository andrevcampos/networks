<?php
function Get_Member_List($search, $region, $industry) {

    if(!$region && !$industry && !$search){
        $members = []; //Initial Result.
        $currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($currentUrl, '?') !== false) {
            $members = []; //Initial Result.
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
        } 
        return $members;
    }

    $memberarray = [];
    if($region){
        $memberarray = Get_Member_List_Region($region);
        if($industry){
            $memberarray = Get_Member_List_Industry($industry, $memberarray);
        }
        $list1 = Get_Member_List_Business($search, $memberarray);
        $list2 = Get_Member_List_Member($search, $memberarray);
        $memberarray = Duplicate_List_Member($list2, $list1);
        return $memberarray;
    }
    

    $margs = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation'   => 'AND',
            array(
                'key'     => 'status',
                'value'   => 'Active Member',
                'compare' => '=',
            ),
            array(
                'relation' => 'OR', 
                array(
                    'key'     => 'firstName',
                    'value'   => $search,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'lastName',
                    'value'   => $search,
                    'compare' => 'LIKE',
                ),
            ),
        ),
    );
    $mmembers = get_posts($margs);
    if($industry){
        $mmembers = Get_Member_List_Industry($industry, $mmembers);
    }
    $bargs = array(
        'post_type'      => 'network-member',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => 'status',
                'value'   => 'Active Member',
                'compare' => '=',
            ),
        ),
        's'     => $search,
    );
    $bmembers = get_posts($bargs);
    if($industry){
        $bmembers = Get_Member_List_Industry($industry, $bmembers);
    }
    $memberarray = Duplicate_List_Member($mmembers, $bmembers);
    return $memberarray;
    

    
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
    $membersawayregion = [];
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
            array_push($membersawayregion, $member);
        }
    }
    return $membersawayregion;
}

function Get_Member_List_Industry($industry, $members) {
    $memberarrayindustry = [];
    foreach($members as $memberr) {
        $obj = Get_Member($memberr->ID);
        $industrys = $obj->industry;
        foreach($industrys as $industryid) {
            if($industry == $industryid){
                array_push($memberarrayindustry, $memberr);
            }
        }
    }
    return $memberarrayindustry;
}

function Get_Member_List_Business($business, $members) {
    $memberarraybusiness = [];
    foreach ($members as $member) {
        if(stripos($member->post_title, $business) !== false) {
            array_push($memberarraybusiness, $member);
        }
    }
    return $memberarraybusiness;
}
function Get_Member_List_Member($membername, $members) {
    $memberarraymember = [];
    foreach ($members as $member) {
        $obj = Get_Member($member->ID); // Corrected variable name
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        if(stripos($firstname, $membername) !== false || stripos($lastname, $membername) !== false) {
            array_push($memberarraymember, $member);
        }
    }
    return $memberarraymember;
}
function Duplicate_List_Member($list1, $list2) {

    if(Count($list1) == 0){
        return $list2;
    }
    if(Count($list2) == 0){
        return $list1;
    }

    $memberarraylist = $list1;
    foreach ($list2 as $member2) {
        $result = "no";
        foreach ($memberarraylist as $member) {
            if($member->ID == $member2->ID){
                $result = "yes";
            }
        }
        if($result == "no"){array_push($memberarraylist, $member2);}
    }
    return $memberarraylist;
}



?>