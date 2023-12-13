<?php

function member_search_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $industrys = Get_Industrys();
    $industryarray = [];
    foreach($industrys as $industry) {
        $industryid = $industry->ID;
        $industrytitle = $industry->post_title;
        $newObject = (object) [
            'id' => $industryid,
            'post_title' => $industrytitle,
        ];
        array_push($industryarray, $newObject);
    }

    // Define a custom sorting function
    function sortByRegionTitle3($a, $b) {
        return strcmp($a->post_title, $b->post_title);
    }

    // Sort the array by regiontitle
    usort($industryarray, 'sortByRegionTitle3');

    ?>
    <div id="member-search" style="max-width:300px">
        <?php
        echo '<select id="selectBox" name="selectedOption" onchange="membersearchchange()">';
            echo "<option value='notselected'>All Industries</option>";
        foreach ($industryarray as $industry) {
            echo "<option value='$industry->id'>$industry->post_title</option>";
        }
        echo '</select>';
        ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('membersearch', 'member_search_shortcode');
?>