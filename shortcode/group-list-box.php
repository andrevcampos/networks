<?php

function group_list_box_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    // Get the ID of the current post
    $post_id = get_the_ID();
    // Check if a valid post ID is obtained
    if ($post_id) {
        // Get post title
        $posttitle = get_the_title($post_id);
    }

    
    

    // // Define a custom sorting function
    // function sortByWeekdayAndStart($a, $b) {
    //     // First, compare by weekdayNumber
    //     $weekdayComparison = $a->weekdayNumber - $b->weekdayNumber;

    //     // If weekdays are the same, then compare by start
    //     if ($weekdayComparison == 0) {
    //         // Use a numerical comparison for start
    //         return $a->start - $b->start;
    //     }

    //     return $weekdayComparison;
    // }

    // // Sort the array by weekdayNumber and then by start
    // usort($grouparray, 'sortByWeekdayAndStart');


    // Define a custom sorting function
    function sortByWeekdayAndStart($a, $b) {
        // First, compare by weekdayNumber
        $weekdayComparison = $a->weekdayNumber - $b->weekdayNumber;

        // If weekdays are the same, then compare by start
        if ($weekdayComparison == 0) {
            // Use a numerical comparison for start
            return $a->time - $b->time;
        }

        return $weekdayComparison;
    }

    if($posttitle == "Groups"){

        $regargs = array(
            'post_type' => 'network-region',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'status',
                    'value' => 'active', 
                    'compare' => '=',
                ),
            ),
        ); 
        $regions = get_posts($regargs);
        $regionarray = [];
        foreach($regions as $region) {
            $obj = Get_Region($region->ID);
            array_push($regionarray, $obj);
        }
        // Define a custom sorting function
        // function sortByRegionOrder($a, $b) {
        //     return strcmp($a->order, $b->order);
        // }
        // Sort the array by order
        usort($regionarray, 'sortByOrder');
        
        foreach ($regionarray as $region) {

            // Skip Virtual Region
            if ($region->ID == 505) {
                continue; 
            }
            
            $args = array(
                'post_type' => 'network-group',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'status',
                        'value' => 'active', 
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'regions',
                        'value' => $region->ID, 
                        'compare' => '=',
                    ),
                ),
            ); 
            $groups = get_posts($args);
            
            $grouparray = [];
            foreach($groups as $group) {
                //group info
                $groupid = $group->ID;
                $grouptitle = $group->post_title;
                $slug = $group->post_name;
                $obj = Get_Group($group->ID);
                
                $start = $obj->start;
                $pieces = explode(":", $group->start);
                if($pieces[2] == "pm"){
                    $hours = $pieces[0] + 12;
                    $time = $hours . ":" . $pieces[1];
                }else{
                    $time = $pieces[0] . ":" . $pieces[1];
                }
                $imageid = $obj->imageid;
                $logoid = $obj->logourl;
                $image_info = wp_get_attachment_image_src($imageid, 'large');

                //region info
                $region_id = get_post_meta( $groupid, 'regions', true );
                $region_post = get_post($region_id);
                $region_title = $region_post->post_title;

                // Create week day number for order.
                $weekday = ucfirst($obj->weekday);
                $weekdayMapping = [
                    'Monday'    => 1,
                    'Tuesday'   => 2,
                    'Wednesday' => 3,
                    'Thursday'  => 4,
                    'Friday'    => 5,
                    'Saturday'  => 6,
                    'Sunday'    => 7,
                ];
                $weekdayNumber = $weekdayMapping[$weekday];
                
                $newObject = (object) [
                    'id' => $groupid,
                    'title' => $grouptitle,
                    'url' => $image_info[0],
                    'slug' => $slug,
                    'weekday' => $weekday,
                    'weekdayNumber' => $weekdayNumber,
                    'start' => $start,
                    'time' => $time,
                    'regionid' => $region_id,
                    'regiontitle' => $region_title,
                ];
                array_push($grouparray, $newObject);
            }

            // Sort the array by weekdayNumber and then by start
            usort($grouparray, 'sortByWeekdayAndStart');

            echo "<h3 class='$region->ID allgroups' style='margin-top:40px;margin-left:10px'> $region->post_title </h3>";
            echo "<div class='group-list-container $region->ID allgroups'>";
            foreach ($grouparray as $group) {
                $pieces = explode(":", $group->start);
                $time = $group->weekday . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
                echo "<div class='group-list-single-box $group->regionid allgroups hoverorange'>";
                    echo "<a href='/groups/$group->slug' style=''>";
                        echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($group->url) . ');background-size: cover;"></div>';
                        echo '<div class="group-list-single-box-text">';
                            echo "<h5 style='color:black;font-size:17px'><strong> $time </strong></h5>";
                            echo "<h6 style='margin-top:-10px;font-size:16px'> $group->title </h6>"; 
                        echo '</div>';  
                    echo "</a>";
                echo "</div>";
            }
            echo "</div>";
        }
        
            
    }else{

        $args = array(
            'post_type' => 'network-group',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'status',
                    'value' => 'active', 
                    'compare' => '=',
                ),
                array(
                    'key' => 'regions',
                    'value' => $post_id, 
                    'compare' => '=',
                ),
            ),
        );

        $groups = get_posts($args);
        $grouparray = [];
        foreach($groups as $group) {
            //group info
            $groupid = $group->ID;
            $grouptitle = $group->post_title;
            $slug = $group->post_name;
            $obj = Get_Group($group->ID);
            
            $start = $obj->start;
            $pieces = explode(":", $group->start);
            if($pieces[2] == "pm"){
                $hours = $pieces[0] + 12;
                $time = $hours . ":" . $pieces[1];
            }else{
                $time = $pieces[0] . ":" . $pieces[1];
            }
            $imageid = $obj->imageid;
            $logoid = $obj->logourl;
            $image_info = wp_get_attachment_image_src($imageid, 'large');
            //region info
            $region_id = get_post_meta( $groupid, 'regions', true );
            $region_post = get_post($region_id);
            $region_title = $region_post->post_title;

            // Create week day number for order.
            $weekday = ucfirst($obj->weekday);
            $weekdayMapping = [
                'Monday'    => 1,
                'Tuesday'   => 2,
                'Wednesday' => 3,
                'Thursday'  => 4,
                'Friday'    => 5,
                'Saturday'  => 6,
                'Sunday'    => 7,
            ];
            $weekdayNumber = $weekdayMapping[$weekday];
            
            $newObject = (object) [
                'id' => $groupid,
                'title' => $grouptitle,
                'url' => $image_info[0],
                'slug' => $slug,
                'weekday' => $weekday,
                'weekdayNumber' => $weekdayNumber,
                'start' => $start,
                'time' => $time,
                'regionid' => $region_id,
                'regiontitle' => $region_title,
            ];
            array_push($grouparray, $newObject);
        }
        usort($grouparray, 'sortByWeekdayAndStart');

        echo "<div class='group-list-container $group->regionid allgroups'>";
        foreach ($grouparray as $group) {
            $pieces = explode(":", $group->start);
            $time = $group->weekday . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
            echo "<div class='group-list-single-box $group->regionid allgroups hoverorange'>";
                echo "<a href='/groups/$group->slug' style=''>";
                    echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($group->url) . ');background-size: cover;"></div>';
                    echo '<div class="group-list-single-box-text">';
                        echo "<h5 style='color:black;font-size:17px'><strong> $time </strong></h5>";
                        echo "<h6 style='margin-top:-10px;font-size:16px'> $group->title </h6>"; 
                    echo '</div>';  
                echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }


    

    return ob_get_clean();
}

add_shortcode('grouplistbox', 'group_list_box_shortcode');
?>