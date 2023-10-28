<?php

function region_dropdown_menu_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $args = array('post_type' => 'network-region','posts_per_page' => -1);
    $regions = get_posts($args);
    $regionsarray = [];
    foreach($regions as $region) {
        $regionid = $region->ID;
        $regiontitle = $region->post_title;
        $newObject = (object) [
            'id' => $regionid,
            'post_title' => $regiontitle,
        ];
        array_push($regionsarray, $newObject);
    }

    // Define a custom sorting function
    function sortByRegionTitle2($a, $b) {
        return strcmp($a->post_title, $b->post_title);
    }

    // Sort the array by regiontitle
    usort($regionsarray, 'sortByRegionTitle2');
    
    ?>
    <div id="region-dropdown-menu" style="max-width:300px">
        <?php
        echo '<select id="selectBox" name="selectedOption" onchange="regiondropdownchange()">';
            echo "<option value='notselected'>Select Region</option>";
        foreach ($regionsarray as $region) {
            echo "<option value='$region->id'>$region->post_title</option>";
        }
        echo '</select>';
        ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('regiondropdownmenu', 'region_dropdown_menu_shortcode');
?>