<?php
function group_info_left_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $user_role = Get_User_Role();
    $obj = Get_Group($groupid);
    $groupid = $obj->ID;
    $pieces = explode(":", $obj->start);
    $time = ucfirst($obj->weekday) . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
    $address1 = $obj->address1;
    $address2 = $obj->address2;
    $suburb = $obj->suburb;
    $city = $obj->city;
    $postcode = $obj->postcode;
    $facilitatorid = $obj->facilitator;
    $objfacilitator = Get_Facilitator($facilitatorid);
    $imageid = $objfacilitator->imageid;
    $pimage_info = wp_get_attachment_image_src($imageid, 'full');

    if ($user_role == 'administrator' || $user_role == 'network-admin'){
        

        echo '<div class="group-info-left">';
            // echo '<div class="group-info-left-icon">
            //     <span class="material-symbols-outlined">home_work</span>
            // </div>';
            echo "<div class='group-info-left-text-title'><strong>Networkers Admin</strong></div>";
        echo '</div>';
        echo "<div class='group-info-left-text'><a href='/wp-admin/admin.php?page=networkers-group-update&id=$obj->ID'>Edit Profile</a></div>";
        echo "<br>";
    }

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">event_upcoming</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Meeting day & time</strong></div>";
    echo '</div>';
    echo "<div class='group-info-left-text'>$time</div>";
    
    echo "<br>";

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">where_to_vote</span>
        // </div>';
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

    $cleaned_number = str_replace(' ', '', $objfacilitator->phone);
    $number = 'tel:+64'.ltrim($cleaned_number, '0');
    

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">manage_accounts</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Facilitator</strong></div>";
    echo '</div>';
    echo '<div class="profile-picture" style="background-image: url(' . esc_url($pimage_info[0]) . ')"></div>';
    echo "<div class='group-info-left-text'>$objfacilitator->name</div>";
    echo "<a href='$number'><div class='group-info-left-text' style='color:#5F259F;'>$objfacilitator->phone</div></a>";
    echo "<a href='mailto:$objfacilitator->email'><div class='group-info-left-text' style='color:#5F259F;'>$objfacilitator->email</div></a>";
    echo "<br>";

    return ob_get_clean();
}
add_shortcode('groupinfoleft', 'group_info_left_shortcode');
?>