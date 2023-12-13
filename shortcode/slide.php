<?php

function slideshow_shortcode() {

    ob_start();

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'groupslidejs', plugins_url() . '/thenetworks/public/js/groupslide.js' );

    $args = array(
        'post_type' => 'network-group',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => 'active', 
                'compare' => '=',
            ),
        ),
    );
    $groupss = get_posts($args);
    $groupsarray = [];
    $imagePaths = [];
    foreach($groupss as $group) {
        $obj = Get_Group($group->ID);
        $url = $obj->imageurl;
        $slug = $group->post_name;
        $post_title = $obj->post_title;
        $weekday = ucfirst($obj->weekday);
        $start = $obj->start;
        $imageid = $obj->imageid;
        $image_info = wp_get_attachment_image_src($imageid, 'large');
        $newObject = (object) [
            'id' => $group->ID,
            'url' => $image_info[0],
            'slug' => $slug,
            'post_title' => $post_title,
            'weekday' => $weekday,
            'start' => $start,
        ];
        if($url && $url !=""){
            array_push($imagePaths, $newObject);
        }
    }
    
    ?>
    <div id="slideshow-container">
        <?php
        foreach ($imagePaths as $path) {
            $pieces = explode(":", $path->start);
            $title = $path->weekday . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2] . " - " . $path->post_title;
            echo '<div class="netslide"><div class="netdivimg" style="background-image: url(' . esc_url($path->url) . ');background-size: cover;border-radius:10px;width:100%"></div></div>';
            echo '<div class="netslidestitle">'. $title .'</div>';
            echo "<div class='netslideslink'><a href='https://netdev.breeze.marketing/group/$path->slug'>Visit this group</a></div>";
        }
        ?>
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('networkersslideshow', 'slideshow_shortcode');
?>