<?php

function pinpoint_left_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $args = array('post_type' => 'network-group', 'posts_per_page' => -1);
    $groupss = get_posts($args);
    $groupsarray = [];
    $totalgroups = 0;
    $totalmembers = 0;
    
    foreach ($groupss as $group) {
        $obj = Get_Group($group->ID);
        $status = $obj->status;

        if ($status != "inactive") {
            $totalgroups+=1;
            $args_member_count = array(
                'post_type' => 'network-member',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'group',
                        'value' => $group->ID,
                    ),
                ),
            );
            $member_count = count(get_posts($args_member_count));
            $totalmembers+=$member_count;
        }
    }

    $args2 = array('post_type' => 'network-region', 'posts_per_page' => -1);
    $regions = get_posts($args2);
    $totalregions = Count(get_posts($args2));

    echo "<div class='info-box-left' style='border-radius:10px;display: block;'>";
        echo '<div class="group-info-left" style="padding-left:10px">';
            echo '<div class="group-info-left-icon">
                <span class="material-symbols-outlined">groups</span>
            </div>';
            echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalgroups Groups</div>";
        echo '</div>';
        echo '<div class="group-info-left" style="padding-left:10px">';
            echo '<div class="group-info-left-icon">
                <span class="material-symbols-outlined">person</span>
            </div>';
            echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalmembers Members</div>";
        echo '</div>';
        echo '<div class="group-info-left" style="padding-left:10px">';
            echo '<div class="group-info-left-icon">
                <span class="material-symbols-outlined">person_pin_circle</span>
            </div>';
            echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$totalregions Regions</div>";
        echo '</div>';
    echo "</div>";

    return ob_get_clean();
}

add_shortcode('pinpointleft', 'pinpoint_left_shortcode');

function pinpoint_left_shortcode2() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $args = array('post_type' => 'network-group', 'posts_per_page' => -1);
    $groupss = get_posts($args);
    $groupsarray = [];
    $totalgroups = 0;
    $totalmembers = 0;
    
    foreach ($groupss as $group) {
        $obj = Get_Group($group->ID);
        $status = $obj->status;

        if ($status != "inactive") {
            $totalgroups+=1;
            $args_member_count = array(
                'post_type' => 'network-member',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'group',
                        'value' => $group->ID,
                    ),
                ),
            );
            $member_count = count(get_posts($args_member_count));
            $totalmembers+=$member_count;
        }
    }

    $args2 = array('post_type' => 'network-region', 'posts_per_page' => -1);
    $regions = get_posts($args2);
    $totalregions = Count(get_posts($args2));

    echo "<div style='font-size:18px'>";
        echo "<span><strong>$totalgroups</strong></span><span style='margin-left:5px'>Groups</span>";
        echo "<span style='margin-left:20px'><strong>$totalmembers</strong></span><span style='margin-left:5px'>Members</span>";
        echo "<span style='margin-left:20px'><strong>$totalregions</strong></span><span style='margin-left:5px'>Regions</span>";
    echo "</div>";
    return ob_get_clean();
}

add_shortcode('pinpointleft2', 'pinpoint_left_shortcode2');


?>