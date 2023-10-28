<?php
function group_members_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $groupid = $_GET['id'];
    $args = array('post_type' => 'network-member','posts_per_page' => -1);
    $members = get_posts($args);
    $memberarray = [];
    foreach($members as $memberr) {
        //group info
        $memberid = $memberr->ID;
        $membertitle = $memberr->post_title;
        $obj = Get_Member($memberid);

        $status = $obj->status;
        $firstname = $obj->firstname;
        $lastname = $obj->lastname;
        $logoid = $obj->logourl;
        //$logo_url = wp_get_attachment_image_src($logoid, 'large');
        $groups = $obj->group;

        foreach ($groups as $group) {

            if($group == $groupid){
                
                $newObject = (object) [
                    'id' => $memberid,
                    'title' => $membertitle,
                    'logourl' => $logoid,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                ];
                array_push($memberarray, $newObject);
            }
        }
    }

    // Define a custom sorting function
    function sortByMemberTitle($a, $b) {
        return strcmp($a->title, $b->title);
    }

    // Sort the array by regiontitle
    usort($memberarray, 'sortByMemberTitle');

    foreach ($memberarray as $member) {

        echo "<div class='group-list-container'>";
            echo "<div class='group-list-single-box'>";

                    echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($member->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                    echo '<div class="group-list-single-box-text">';
                        echo "<h6 style='color:black'><strong> $member->title</strong></h6>";
                        echo "<h6 style='color:black'> $member->firstname $member->lastname</h6>";
                    echo '</div>';  

            echo "</div>";
        echo "</div>";

    }

    return ob_get_clean();
}
add_shortcode('groupmembers', 'group_members_shortcode');
?>