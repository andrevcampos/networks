<?php
function members_list_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $industrys = Get_Industrys();
    $groupid = $_GET['id'];
    $args = array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => 'Active Member', 
                'compare' => '=',
            ),
        ),
    );
    $members = get_posts($args);
    $memberarray = [];
    foreach($members as $memberr) {
        //group info
        $memberid = $memberr->ID;
        $membertitle = $memberr->post_title;
        $slug = $memberr->post_name;
        $obj = Get_Member($memberid);
        $status = $obj->status;
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        $logoid = $obj->logoid;
        $industrys = $obj->industry;
        $industry = "";
        foreach($industrys as $industryid) {
            if ($industry == ""){
                $industry = $industryid;
            }else{
                $industry = $industry . " " . $industryid;
            }
        }
        //$image_info = get_site_url()."/wp-content/uploads/".get_post_meta( $logoid, '_wp_attached_file', true );
        $image = "https://netdev.breeze.marketing/wp-content/uploads/";
        if($logoid){
            $image_info = wp_get_attachment_image_src($logoid, 'large');
            $image = $image_info[0];
        }
        if($image == "https://netdev.breeze.marketing/wp-content/uploads/"){
            $image = "https://netdev.breeze.marketing/wp-content/uploads/2023/10/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not.jpg";
        }
        //$logo_url = wp_get_attachment_image_src($logoid, 'large');
        $groups = $obj->group;

        foreach ($groups as $group) {
            $newObject = (object) [
                'id' => $memberid,
                'title' => $membertitle,
                'logourl' => $image,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'slug' =>  $slug,
                'industry' => $industry
            ];
            array_push($memberarray, $newObject);
        }
    }

    // Define a custom sorting function
    function sortByMemberTitle($a, $b) {
        return strcmp($a->title, $b->title);
    }

    // Sort the array by regiontitle
    usort($memberarray, 'sortByMemberTitle');

    echo '<div class="group-info-left">';
        echo '<div class="group-info-left-icon">
            <span class="material-symbols-outlined">collections_bookmark</span>
        </div>';
        echo "<div class='group-info-left-text-title'><strong>Members</strong></div>";
    echo '</div>';
    echo "<br>";

    echo "<div class='group-list-container'>";

    
    foreach ($memberarray as $member) {
        echo "<div class='group-list-single-box allindustrys $member->industry hoverorange'>";
            echo "<a href='/members/$member->slug' style=''>";
                echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($member->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                echo '<div class="group-list-single-box-text">';
                    echo "<h6 style=''>$member->title</h6>";
                    // echo "<h6 style='color:black'> $member->firstname $member->lastname</h6>";
                echo '</div>';
            echo '</a>';
        echo "</div>";
    }
    echo "</div>";

    return ob_get_clean();
}
add_shortcode('memberlist', 'members_list_shortcode');
?>