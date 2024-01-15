<?php
function member_info_right_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $memberid = $_GET['id'];
    $obj = Get_Member($memberid);
    $description2 = $obj->businessdescription;
    $description = base64_decode($description2);
    $logoid = $obj->logoid;
    $image_info = wp_get_attachment_image_src($logoid, 'full');

    // echo '<div class="group-info-left">';
    //     echo '<div class="group-info-left-icon">
    //         <span class="material-symbols-outlined">branding_watermark</span>
    //     </div>';
    //     echo "<div class='group-info-left-text-title'><strong>Logo</strong></div>";
    // echo '</div>';

    echo '<div class="profile-logo" style="background-image: url(' . esc_url($image_info[0]) . ')"></div>';

    echo "<br>";

    // echo '<div class="group-info-left">';
    //     echo '<div class="group-info-left-icon">
    //         <span class="material-symbols-outlined">Description</span>
    //     </div>';
    //     echo "<div class='group-info-left-text-title'><strong>Description</strong></div>";
    // echo '</div>';
    echo "$description";

    return ob_get_clean();
}
add_shortcode('memberinforight', 'member_info_right_shortcode');
?>