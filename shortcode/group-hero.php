<?php

function group_hero_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $groupid = $_GET['id'];
    $obj = Get_Group($groupid);
    $imageid = $obj->imageid;
    $pieces = explode(":", $obj->start);
    $time = ucfirst($obj->weekday) . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];

    $image_info = wp_get_attachment_image_src($imageid, 'full');
    echo '<div class="group-hero" style="background-image: url(' . esc_url($image_info[0]) . ');background: linear-gradient(90deg, rgba(241, 97, 41, 0.8), rgba(99, 38, 155, 0.8)),
    url(' . esc_url($image_info[0]) . ');background-repeat: no-repeat;background-size: cover;background-position: center center;">';
    
        echo '<div class="group-hero-box">';
            echo '<div class="group-hero-text">';
                echo "<h2 style='color:white'><strong> $obj->post_title </strong></h2>";
                echo "<h3 style='color:white'> $time </h3>";
            echo '</div>';
        echo '</div>';
    echo '</div>';
    return ob_get_clean();
}

add_shortcode('grouphero', 'group_hero_shortcode');
?>