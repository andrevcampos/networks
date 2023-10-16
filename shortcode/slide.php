
<?php
function slideshow_shortcode() {

    ob_start(); // Start output buffering

    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    $api_url = "https://netdev.breeze.marketing/wp-json/networkers/v1/group-list";
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response, true);
    $imagePaths = [];
    
    foreach ($data['groups'] as $group) {
        $url = $group["imageurl"];
        $post_title = $group["post_title"];
        $weekday = ucfirst($group["weekday"]);
        $start = $group["start"];
        $imageid = $group["imageid"];
        $image_info = wp_get_attachment_image_src($imageid, 'large');

        $newObject = (object) [
            'url' => $image_info[0],
            'post_title' => $post_title,
            'weekday' => $weekday,
            'start' => $start,
            'finsh' => $finsh,
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
            echo '<div class="slide"><div class="divimg" style="background-image: url(' . esc_url($path->url) . ');background-size: cover;"></div></div>';
            echo '<div class="slidestitle">'. $title .'</div>';
            echo '<div class="slideslink"><a>Visit this group</div></a>';
        }
        ?>
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
    <?php
    return ob_get_clean(); // Return and flush the buffered content
}

add_shortcode('slideshow', 'slideshow_shortcode');
