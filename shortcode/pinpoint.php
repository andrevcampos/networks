<?php

function pinpoint_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $args = array('post_type' => 'network-region', 'posts_per_page' => -1);
    $regions = get_posts($args);
    $regionarray = [];
    
    foreach ($regions as $region) {
        $obj = Get_Region($region->ID);
        $name = $obj->post_title;

        $args2 = array(
            'post_type' => 'network-group', 
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'regions',
                    'value' => $region->ID,
                ),
                array(
                    'key'     => 'status',
                    'value'   => 'inactive',
                    'compare' => '!=',
                ),
            ),
        );
        $groups = get_posts($args2);
        $group_count = count(get_posts($args2)); // Total de Groups na Regiao
        $member_count = 0;
        foreach ($groups as $group) {
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
            $member_count += count(get_posts($args_member_count)); 
        }
        $newObject = array(
            'ID' => $region->ID,
            'name'   => $name,
            'group_count'   => $group_count,
            'member_count'   => $member_count,
        );
        $regionarray[] = $newObject;
    }
    print_r($regionarray);

    $mapurl =  plugins_url() . '/thenetworks/public/img/nzmap.png';

    echo '<div class="image-container">';
        echo "<img src='$mapurl' alt='The Networkers Map' style='max-height:700px;max-width:740px'>";

        foreach ($regionarray as $region) {
            echo $region['ID'];

            if ($region->ID === '502 ') { // Canterbury
                echo '<div class="hotspot hotspoticon1"><a href="/networking-groups/nelson-tasman-business-networking-groups/"><i class="material-symbols-outlined">person_pin_circle</i></a></div>';
                    echo "<div class='info-box hotspotbox1'>";
            }
            if ($region->ID === '499') { // Nelson
                echo '<div class="hotspot hotspoticon2"><a href="/networking-groups/nelson-tasman-business-networking-groups/"><i class="material-symbols-outlined">person_pin_circle</i></a></div>';
                    echo "<div class='info-box hotspotbox2'>";
            }
            if ($region->ID  === '498') { // Wellington
                echo '<div class="hotspot hotspoticon3"><a href="/networking-groups/nelson-tasman-business-networking-groups/"><i class="material-symbols-outlined">person_pin_circle</i></a></div>';
                    echo "<div class='info-box hotspotbox3'>";
            }
            if ($region->ID === '500') { // Marlborough
                echo '<div class="hotspot hotspoticon4"><a href="/networking-groups/nelson-tasman-business-networking-groups/"><i class="material-symbols-outlined">person_pin_circle</i></a></div>';
                    echo "<div class='info-box hotspotbox4'>";
            }
            if ($region->ID  === '502' || $region->ID  === '500' || $region->ID  === '499' || $region->ID  === '498') {
                    echo '<div class="group-info-left" style="padding-left:10px">';
                        echo '<div class="group-info-left-icon">
                            <span class="material-symbols-outlined">person_pin_circle</span>
                        </div>';
                        echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$region->name</div>";
                    echo '</div>';
                    echo '<div class="group-info-left" style="padding-left:10px">';
                        echo '<div class="group-info-left-icon">
                            <span class="material-symbols-outlined">groups</span>
                        </div>';
                        echo "<div class='group-info-left-text-title' style='font-size:18px;margin-left:5px'>$region->group_count Groups</div>";
                    echo '</div>';
                    echo '<div class="group-info-left" style="padding-left:10px">';
                    echo '</div>';
                echo "</div>";
            }
        }

    echo '</div>';
    return ob_get_clean();
}

add_shortcode('pinpoint', 'pinpoint_shortcode');
?>