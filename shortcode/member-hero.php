<?php

function member_hero_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $memberid = $_GET['id'];
    $obj = Get_Member($memberid);
    $logoid = $obj->logoid;

    $image_info = wp_get_attachment_image_src($logoid, 'full');
    echo '<div class="group-hero" style="background-image: url(' . esc_url($image_info[0]) . ');background: linear-gradient(90deg, rgba(241, 97, 41, 0.8), rgba(99, 38, 155, 0.8)),
    url(' . esc_url($image_info[0]) . ');background-repeat: no-repeat;background-size: cover;background-position: center center;">';
    
        echo '<div class="group-hero-box">';
            echo '<div class="group-hero-text">';
                echo "<h2 style='color:white'><strong> $obj->businessname </strong></h2>";
                echo "<h3 style='color:white'> $obj->firstname $obj->lastname </h3>";
            echo '</div>';
        echo '</div>';
    echo '</div>';
    return ob_get_clean();
}

add_shortcode('memberhero', 'member_hero_shortcode');

function member_hero_shortcode2() {
    ob_start();
    $memberid = $_GET['id'];
    $obj = Get_Member($memberid);
    echo "<h3 style='color:white'> $obj->businessname - $obj->firstname $obj->lastname </h3>";
    return ob_get_clean();
}

add_shortcode('memberhero2', 'member_hero_shortcode2');
?>