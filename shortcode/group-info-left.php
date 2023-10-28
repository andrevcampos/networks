<?php
function group_info_left_shortcode() {

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
    

    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">event_upcoming</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Meeting day & time</strong></div>";
    echo '</div>';
    echo "<div class='group-info-left-text'>$time</div>";
    
    echo "<br>";

    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">where_to_vote</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Location</strong></div>";
    echo '</div>';
    if($address1){
        echo "<div class='group-info-left-text'>$address1</div>";
    }
    if($address2){
        echo "<div class='group-info-left-text'>$address2</div>";
    }
    if($suburb){
        echo "<div class='group-info-left-text'>$suburb</div>";
    }
    if($city){
        echo "<div class='group-info-left-text'>$city</div>";
    }
    if($postcode){
        echo "<div class='group-info-left-text'>$postcode</div>";
    }

    echo "<br>";

    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">manage_accounts</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Facilitator</strong></div>";
    echo '</div>';

    return ob_get_clean();
}
add_shortcode('groupinfoleft', 'group_info_left_shortcode');
?>