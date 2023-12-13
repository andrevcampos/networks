<?php
function group_info_right_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $groupid = $_GET['id'];
    $obj = Get_Group($groupid);
    $pieces = explode(":", $obj->start);
    $time = ucfirst($obj->weekday) . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
    $address1 = $obj->address1;
    $address2 = $obj->address2;
    $suburb = $obj->suburb;
    $city = $obj->city;
    $postcode = $obj->postcode;
    $region = $obj->regions;
    $robj = Get_Region($region);
    $region = $robj->post_title;
    $postname = get_post_field('post_name', $robj->ID);
    $description2 = $obj->description;
    $description = base64_decode($description2);
    
    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">share_location</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Region</strong></div>";
    echo '</div>';
    echo "<a href='/networking-groups/$postname'><div class='group-info-left-text' style='color:red;'>$region</div></a>";

    echo "<br>";

    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">Description</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Description</strong></div>";
    echo '</div>';
    echo "$description";

    return ob_get_clean();
}
add_shortcode('groupinforight', 'group_info_right_shortcode');
?>