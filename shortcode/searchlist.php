<?php
function search_list_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $industrys = Get_Industrys();
    $search = $_GET['s'];
    $type = $_GET['type'];

    if($type == 'business'){
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
            's'     => $search,
        );
    }
    if($type == 'member'){
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
    }

    if($type == 'industry'){
        $args2 = array(
            'post_type'      => 'network-industry',
            'posts_per_page' => -1,
            's'     => $search,
        );
        $industrys = get_posts($args2);
        $industryarray = [];
        foreach($industrys as $industry) {
            $id = $industry->ID;
            //$membertitle = $industry->post_title;
            array_push($industryarray, $id);
        }
        if(Count($industryarray) > 0){
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
                        'key'     => 'industry',
                        'value'   => $industryarray,
                        'compare' => 'IN',
                    ),
                ),
            );
        }
    }
    $members = get_posts($args);
    $memberarray = [];
    foreach($members as $memberr) {
        //group info
        $memberid = $memberr->ID;
        $membertitle = $memberr->post_title;
        $slug = $memberr->post_name;
        $obj = Get_Member($memberid);
        $status = $obj->status;
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        $logoid = $obj->logoid;
        $industrys = $obj->industry;
        $industry = "";
        foreach($industrys as $industryid) {
            $industryname = get_the_title($industryid);
            if ($industry == ""){
                $industry = $industryname;
            }else{
                $industry = $industry . " " . $industryname;
            }
        }
        //$image_info = get_site_url()."/wp-content/uploads/".get_post_meta( $logoid, '_wp_attached_file', true );
        $image = "https://netdev.breeze.marketing/wp-content/uploads/";
        if($logoid){
            $image_info = wp_get_attachment_image_src($logoid, 'large');
            $image = $image_info[0];
        }
        if($image == "https://netdev.breeze.marketing/wp-content/uploads/"){
            $image = "https://netdev.breeze.marketing/wp-content/uploads/2023/10/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not.jpg";
        }
        //$logo_url = wp_get_attachment_image_src($logoid, 'large');
        $groups = $obj->group;

        foreach ($groups as $group) {
            $newObject = (object) [
                'id' => $memberid,
                'title' => $membertitle,
                'logourl' => $image,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'slug' =>  $slug,
                'industry' => $industry
            ];
            array_push($memberarray, $newObject);
        }
    }

    // // Define a custom sorting function
    // function sortByMemberTitle($a, $b) {
    //     return strcmp($a->title, $b->title);
    // }

    // // Sort the array by regiontitle
    // usort($memberarray, 'sortByMemberTitle');

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">collections_bookmark</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Members</strong></div>";
    echo '</div>';

    echo "<div class='group-list-container'>";

    
    foreach ($memberarray as $member) {
        echo "<div class='group-list-single-box allindustrys $member->industry hoverorange'>";
            echo "<a href='/members/$member->slug' style=''>";
                echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($member->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                echo '<div class="group-list-single-box-text">';
                    if($type == 'business'){
                        echo "<h6>$member->title</h6>";
                    }
                    if($type == 'member'){
                        echo "<h6 style=''>[ $member->firstname $member->lastname ]</h6>";
                        echo "<h6 style='margin-top:-10px'>$member->title</h6>";
                    }
                    if($type == 'industry'){
                        echo "<h6 style=''>[ $member->industry ]</h6>";
                        echo "<h6 style='margin-top:-10px'>$member->title</h6>";
                    }
                    

                    
                    
                    // echo "<h6 style='color:black'> $member->firstname $member->lastname</h6>";
                echo '</div>';
            echo '</a>';
        echo "</div>";
    }
    echo "</div>";

    return ob_get_clean();
}
add_shortcode('searchlist', 'search_list_shortcode');
?>