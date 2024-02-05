<?php
function group_members_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $obj = Get_Group($groupid);
    $groupid = $obj->ID;
    $args = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'group',
                'value' => $groupid, 
                'compare' => '=',
            ),
            array(
                'key' => 'status',
                'value' => 'Active Member', 
                'compare' => '=',
            ),
        ),
    );
    $members = get_posts($args);
    $args2 = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'group',
                'value' => $groupid, 
                'compare' => '=',
            ),
            array(
                'key' => 'status',
                'value' => 'Active Visitor', 
                'compare' => '=',
            ),
        ),
    );
    $visitormembers = get_posts($args2);

    $args3 = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'group',
                'value' => $groupid, 
                'compare' => '=',
            ),
            array(
                'key' => 'status',
                'value' => 'Scheduled Visitor', 
                'compare' => '=',
            ),
        ),
    );
    $scheduledmembers = get_posts($args3);

    $memberarray = [];
    foreach($members as $memberr) {
        //group info
        $memberid = $memberr->ID;
        $membertitle = $memberr->post_title;
        $obj = Get_Member($memberid);

        $status = $obj->status;
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        $logoid = $obj->logoid;
        $slug = $memberr->post_name;
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
        //$groups = $obj->group;

        // foreach ($groups as $group) {

        //     if($group == $groupid){
                
                $newObject = (object) [
                    'id' => $memberid,
                    'title' => $membertitle,
                    'logourl' => $image,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'slug' =>  $slug,
                ];
                array_push($memberarray, $newObject);
        //     }
        // }
    }

    // Define a custom sorting function
    function sortByMemberTitle($a, $b) {
        return strcmp($a->title, $b->title);
    }

    // Sort the array by regiontitle
    usort($memberarray, 'sortByMemberTitle');

    echo '<div class="group-info-left" style="margin-left:10px">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">collections_bookmark</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Members</strong></div>";
    echo '</div>';

    echo "<div class='group-list-container'>";
    foreach ($memberarray as $member) {
        echo "<div class='group-list-single-box hoverorange'>";
            echo "<a href='/members/$member->slug' style=''>";
                echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($member->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                echo '<div class="group-list-single-box-text">';
                    echo "<h3 style='margin:0px;padding:0px;padding-top:10px;font-size:18px'>$member->title</h3>";
                    echo "<h3 class='fontroboto' style='color:black;margin:0px;padding-top:5px;padding:0px;font-size:16px;'>$member->firstname $member->lastname</h3>";
                echo '</div>';  
            echo "</a>";
        echo "</div>";
    }
    echo "</div>";

    $visitortotal = Count($visitormembers);
    if($visitortotal > 0){
        $visitormemberarray = [];
        foreach($visitormembers as $visitormemberr) {
            //group info
            $memberid = $visitormemberr->ID;
            $membertitle = $visitormemberr->post_title;
            $obj = Get_Member($memberid);

            $status = $obj->status;
            $firstname = $obj->firstname;
            $lastname = $obj->lastname;
            $logoid = $obj->logoid;
            $slug = $visitormemberr->post_name;
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
            //$groups = $obj->group;

            // foreach ($groups as $group) {

            //     if($group == $groupid){
                    
                    $newObject = (object) [
                        'id' => $memberid,
                        'title' => $membertitle,
                        'logourl' => $image,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'slug' =>  $slug,
                    ];
                    array_push($visitormemberarray, $newObject);
            //     }
            // }
        }

        // Define a custom sorting function
        function sortByMemberTitle2($a, $b) {
            return strcmp($a->title, $b->title);
        }

        // Sort the array by regiontitle
        usort($visitormemberarray, 'sortByMemberTitle2');

        echo '<div class="group-info-left" style="margin-left:10px;margin-top:50px">';
            // echo '<div class="group-info-left-icon">
            //     <span class="material-symbols-outlined">collections_bookmark</span>
            // </div>';
            echo "<div class='group-info-left-text-title'><strong>Active Visitor</strong></div>";
        echo '</div>';

        echo "<div class='group-list-container'>";
        foreach ($visitormemberarray as $vmember) {
            echo "<div class='group-list-single-box'>";
                echo "<a href='/members/$vmember->slug' style=''>";
                    echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($vmember->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                    echo '<div class="group-list-single-box-text">';
                        echo "<h3 style='margin:0px;padding:0px;padding-top:10px;font-size:18px'>$vmember->title</h3>";
                        echo "<h3 class='fontroboto' style='color:black;margin:0px;padding-top:5px;padding:0px;font-size:16px;'>$vmember->firstname $vmember->lastname</h3>";
                    echo '</div>';  
                echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }




    $scheduledtotal = Count($scheduledmembers);
    if($scheduledtotal > 0){
        $scheduledmemberarray = [];
        foreach($scheduledmembers as $scheduledmemberr) {
            //group info
            $memberid = $scheduledmemberr->ID;
            $membertitle = $scheduledmemberr->post_title;
            $obj = Get_Member($memberid);

            $status = $obj->status;
            $firstname = $obj->firstname;
            $lastname = $obj->lastname;
            $logoid = $obj->logoid;
            $slug = $scheduledmemberr->post_name;
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
            //$groups = $obj->group;

            // foreach ($groups as $group) {

            //     if($group == $groupid){
                    
                    $newObject = (object) [
                        'id' => $memberid,
                        'title' => $membertitle,
                        'logourl' => $image,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'slug' =>  $slug,
                    ];
                    array_push($scheduledmemberarray, $newObject);
            //     }
            // }
        }

        // Define a custom sorting function
        function sortByMemberTitle3($a, $b) {
            return strcmp($a->title, $b->title);
        }

        // Sort the array by regiontitle
        usort($scheduledmemberarray, 'sortByMemberTitle3');

        echo '<div class="group-info-left" style="margin-left:10px;margin-top:50px">';
            // echo '<div class="group-info-left-icon">
            //     <span class="material-symbols-outlined">collections_bookmark</span>
            // </div>';
            echo "<div class='group-info-left-text-title'><strong>Scheduled Visitor</strong></div>";
        echo '</div>';

        echo "<div class='group-list-container'>";
        foreach ($scheduledmemberarray as $smember) {
            echo "<div class='group-list-single-box'>";
                echo "<a href='/members/$smember->slug' style=''>";
                    echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($smember->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                    echo '<div class="group-list-single-box-text">';
                        echo "<h3 style='margin:0px;padding:0px;padding-top:10px;font-size:18px'>$smember->title</h3>";
                        echo "<h3 class='fontroboto' style='color:black;margin:0px;padding-top:5px;padding:0px;font-size:16px;'>$smember->firstname $smember->lastname</h3>";
                    echo '</div>';  
                echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }


    return ob_get_clean();
}
add_shortcode('groupmembers', 'group_members_shortcode');
?>