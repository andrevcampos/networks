<?php

function pinpoint_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $args = array('post_type' => 'network-group', 'posts_per_page' => -1);
    $groupss = get_posts($args);
    $groupsarray = [];
    
    foreach ($groupss as $group) {
        $obj = Get_Group($group->ID);
        $status = $obj->status;
        $city = trim($obj->city);
    
        if ($status != "inactive") {
            if (!array_key_exists($city, $groupsarray)) {
                $groupsarray[$city] = (object) [
                    'city' => $city,
                    'id' => [$group->ID],
                    'member_count' => 0, // Initialize member count
                ];
            } else {
                $groupsarray[$city]->id[] = $group->ID;
            }
    
            // Get member count with 'group' post meta matching the group ID
            $args_member_count = array(
                'post_type' => 'network-member', // Replace with your actual member post type
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'group', // Replace with your post meta key
                        'value' => $group->ID,
                    ),
                ),
            );
    
            $member_count = count(get_posts($args_member_count));
    
            // Update the 'member_count' property of the corresponding group
            $groupsarray[$city]->member_count += $member_count;
        }
    }


    $totalMembersCanterbury = 0;
    $totalGroupsCanterbury = 0;
    $totalMembersNelson = 0;
    $totalGroupsNelson = 0;
    $totalMembersWellington = 0;
    $totalGroupsWellington = 0;
    foreach ($groupsarray as $group) {
        if ($group->city === 'Christchurch' || $group->city === 'Ashburton' || $group->city === 'Selwyn' || $group->city === 'Canterbury') {
            $totalMembersCanterbury += $group->member_count;
            $totalGroupsCanterbury += Count($group->id);
        }
        if ($group->city === 'Nelson') {
            $totalMembersNelson += $group->member_count;
            $totalGroupsNelson += Count($group->id);
        }
        if ($group->city === 'Wellington') {
            $totalMembersWellington += $group->member_count;
            $totalGroupsWellington += Count($group->id);
        }
    }
    
    //Kapiti Coast
    //Timaru
    //Motueka
    //Waimakariri
    //Richmond
    //Blenheim

    echo '<div class="image-container">';
        echo '<img src="https://netdev.breeze.marketing/wp-content/uploads/2023/11/nzmap-1.png" alt="Your Image" style="max-height:700px;max-width:740px">';
        echo '<div class="hotspot hotspoticon1" onmouseover="pinboxinfo(0)"><i class="material-symbols-outlined">person_pin_circle</i></div>';

        echo "<div class='info-box hotspotbox1'  style='border-radius:10px;'>";
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person_pin_circle</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>Canterbury</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">groups</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalGroupsCanterbury Groups</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalMembersCanterbury Members</div>";
            echo '</div>';
        echo "</div>";

        echo '<div class="hotspot hotspoticon2" onmouseover="pinboxinfo(1)"><i class="material-symbols-outlined">person_pin_circle</i></div>';
        echo "<div class='info-box hotspotbox2' style='border-radius:10px;'>";
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person_pin_circle</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>Nelson</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">groups</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalGroupsNelson Groups</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalMembersNelson Members</div>";
            echo '</div>';
        echo "</div>";
    
        echo '<div class="hotspot hotspoticon3" onmouseover="pinboxinfo(2)"><i class="material-symbols-outlined">person_pin_circle</i></div>';
        echo "<div class='info-box hotspotbox3' style='border-radius:10px;'>";
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person_pin_circle</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>Wellington</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">groups</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalGroupsWellington Groups</div>";
            echo '</div>';
            echo '<div class="group-info-left" style="padding-left:10px">';
                echo '<div class="group-info-left-icon">
                    <span class="material-symbols-outlined">person</span>
                </div>';
                echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalMembersWellington Members</div>";
            echo '</div>';
        echo "</div>";

    echo '</div>';
    return ob_get_clean();
}

add_shortcode('pinpoint', 'pinpoint_shortcode');
?>