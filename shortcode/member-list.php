<?php
function members_list_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $search = $_GET['search'];
    $category = $_GET['category'];
    $sinduntry = $_GET['industry'];
    $sregion = $_GET['region'];
    if($sregion == "all"){$sregion = null;}
    if($sinduntry == "all"){$sinduntry = null;}
    if($category == "business"){$businessname = $search;}else{$businessname = null;}
    if($category == "member"){$membername = $search;}else{$membername = null;}

    // Gets all industry in order ASC
    $industrys = Get_Industrys();
    // Gets all Regions and order by order
    $regions = Get_Regions();
    $regionarray = Order_Region($regions, "order");
    // Get Member List
    $members = Get_Member_List($membername, $businessname, $sregion, $sinduntry);
    // Order by title
    function sortByMemberTitleee($a, $b) {
        return strcmp($a->post_title, $b->post_title);
    }
    usort($members, 'sortByMemberTitleee');

    echo '<div class="group-info-left">';
        echo "<div class='group-info-left-text-title'><strong>Members</strong></div>";
    echo '</div>';
    echo "<br>";

    if(Count($members) > 0){
        echo "<div class='group-list-container'>";
        foreach($members as $member) {
            $memberid = $member->ID;
            $membertitle = $member->post_title;
            $slug = $member->post_name;
            
            $obj = Get_Member($memberid);
            echo "<div class='group-list-single-box hoverorange'>";
                echo "<a href='/members/$member->post_name' style=''>";
                    echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($obj->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
                    echo '<div class="group-list-single-box-text">';
                        echo "<h6 style=''>$member->post_title</h6>";
                    echo '</div>';
                echo '</a>';
            echo "</div>";
        }
        echo "</div>";
    }else{
        echo "<spam style='font-size:17px'>We couldn't find any results matching your search criteria. Please try again with different keywords or refine your search.</spam><br><br>";
    }

    

    return ob_get_clean();
}
add_shortcode('memberlist', 'members_list_shortcode');
?>