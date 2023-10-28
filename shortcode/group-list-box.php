<?php

function group_list_box_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $args = array('post_type' => 'network-group','posts_per_page' => -1);
    $groups = get_posts($args);
    $grouparray = [];
    foreach($groups as $group) {
        //group info
        $groupid = $group->ID;
        $grouptitle = $group->post_title;
        $obj = Get_Group($group->ID);
        $weekday = ucfirst($obj->weekday);
        $start = $obj->start;
        $imageid = $obj->imageid;
        $logoid = $obj->logourl;
        $image_info = wp_get_attachment_image_src($imageid, 'large');
        //region info
        $region_id = get_post_meta( $groupid, 'regions', true );
        $region_post = get_post($region_id);
        $region_title = $region_post->post_title;
        
        $newObject = (object) [
            'id' => $groupid,
            'title' => $grouptitle,
            'url' => $image_info[0],
            'weekday' => $weekday,
            'start' => $start,
            'regionid' => $region_id,
            'regiontitle' => $region_title,
        ];
        array_push($grouparray, $newObject);
    }

    // Define a custom sorting function
    function sortByRegionTitle($a, $b) {
        return strcmp($a->regiontitle, $b->regiontitle);
    }

    // Sort the array by regiontitle
    usort($grouparray, 'sortByRegionTitle');


    $regionn = "";
    foreach ($grouparray as $group) {
        if($regionn != $group->regiontitle){

            if($regionn != ""){ echo "</div>";}
            $regionn = $group->regiontitle;
            
            echo "<h3 class='$group->regionid allgroups' style='margin-top:40px;'> $group->regiontitle </h3>";
            echo "<div class='group-list-container $group->regionid allgroups'>";
        }
        $pieces = explode(":", $group->start);
        $time = $group->weekday . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
        
        echo "<div class='group-list-single-box $group->regionid allgroups'>";
            echo "<a href='/group/?id=$group->id' style=''>";
                echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($group->url) . ');background-size: cover;"></div>';
                echo '<div class="group-list-single-box-text">';
                    echo "<h6 style='color:black'><strong> $group->title </strong></h6>";
                    echo "<h6 style='color:black'> $time </h6>";
                echo '</div>';  
            echo "</a>";
        echo "</div>";
        
    }
    echo "</div>";

    return ob_get_clean();
}

add_shortcode('grouplistbox', 'group_list_box_shortcode');
?>