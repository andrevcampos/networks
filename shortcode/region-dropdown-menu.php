<?php

function region_dropdown_menu_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $selected = $_GET["region"];
    $args = array('post_type' => 'network-region','posts_per_page' => -1);
    $regions = get_posts($args);
    $regionsarray = [];
    foreach($regions as $region) {
        $regionid = $region->ID;
        $regiontitle = $region->post_title;
        $obj = Get_Region($region->ID);
        $newObject = (object) [
            'id' => $regionid,
            'post_title' => $regiontitle,
        ];
        if($regionid != 505){
            array_push($regionsarray, $obj);
        }
        
    }

    // Define a custom sorting function
    // function sortByRegionTitle2($a, $b) {
    //     return strcmp($a->post_title, $b->post_title);
    // }

    // Sort the array by regiontitle
    usort($regionsarray, 'sortByRegionOrder');
    
    ?>
    <div id="region-dropdown-menu">
        <?php
        foreach ($regionsarray as $region) {
            $post_name = get_post_field('post_name', $region->ID);
        }
        echo '<select id="selectBox" name="selectedOption" onchange="regiondropdownchange()">';
            echo "<option value='notselected'>Select Region</option>";
        foreach ($regionsarray as $region) {
            $post_name = get_post_field('post_name', $region->ID);
            if($post_name == $selected){
                echo "<option value='$region->ID' selected>$region->post_title</option>";
            }else{
                echo "<option value='$region->ID'>$region->post_title</option>";
            }
        }
        echo '</select>';
        ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('regiondropdownmenu', 'region_dropdown_menu_shortcode');
?>