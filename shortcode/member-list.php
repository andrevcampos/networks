<?php
function members_list_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');
    wp_enqueue_script( 'functionsjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $search = $_GET['search'];
    $sinduntry = $_GET['industry'];
    $sregion = $_GET['region'];
    $page = $_GET['pg'];

    $currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($currentUrl, '?') !== false) {
        $msg = "We couldn't find any results matching your search criteria. Please try again with different keywords or refine your search.";
    } else {
        $msg = "Use the search bar above to find specific members or explore our member directory.";
    }


    if(!$page){$page = 1;}
    if(!$sregion || $sregion == "all"){$sregion = null;}
    if(!$sinduntry || $sinduntry == "all"){$sinduntry = null;}
    if($region == null){$region = "";}
    if($industry == null){$industry = "";}
    if($search == null){$search = "";}

    $industrys = Get_Industrys(); // Gets all industry in order ASC
    $regions = Get_Regions(); // Gets all Regions and order by order
    $regionarray = Order_Region($regions, "order"); // Get Member List
    $members = Get_Member_List($search, $sregion, $sinduntry); // Order by title
    
    function sortByMemberTitleee($a, $b) {
        return strcmp($a->post_title, $b->post_title);
    }
    usort($members, 'sortByMemberTitleee');

    $totalmembers = Count($members);
    $totalpages = Count($members) / 10;
    $rounded_up = (int) ceil($totalpages);

    if($rounded_up > 1){ //SO DISPLAY SE TIVER MAIS QUE UMA PAGINA

        echo "<div style='text-align:left;margin-bottom:20px'>";
            $maxPages = 5;

            if ($page > 1) {
                echo '<button onclick="paginationmember(1, \'' . $search . '\', \'' . $sinduntry . '\', \'' . $sregion . '\')" class="search-box-submit"><<</button>';
                echo '<button onclick="paginationmember(' . ($page - 1) . ', \'' . $search . '\', \'' . $sinduntry . '\', \'' . $sregion . '\')" class="search-box-submit"><</button>';
            }

            $startPage = max(1, $page - 2);
            $endPage = min($startPage + $maxPages - 1, $rounded_up);

            for ($i = $startPage; $i <= $endPage; $i++) {
                $buttonClass = ($page == $i) ? 'style="background-color:#5F259F;color:white;"' : '';
                echo '<button onclick="paginationmember(' . $i . ', \'' . $search . '\', \'' . $sinduntry . '\', \'' . $sregion . '\')" class="search-box-submit" ' . $buttonClass . '>' . $i . '</button>';
            }

            if ($page < $rounded_up) {
                echo '<button onclick="paginationmember(' . ($page + 1) . ', \'' . $search . '\', \'' . $sinduntry . '\', \'' . $sregion . '\')" class="search-box-submit">></button>';
                echo '<button onclick="paginationmember(' . $rounded_up . ', \'' . $search . '\', \'' . $sinduntry . '\', \'' . $sregion . '\')" class="search-box-submit">>></button>';
            }
            echo "<spam style='margin-left:10px'>$totalmembers members found</spam>";
        echo '</div>';
    }
    

    echo '<div class="group-info-left">';
        echo "<div class='group-info-left-text-title'><strong>Members</strong></div>";
    echo '</div>';

    $per_page = 10; // Number of members per page

if (count($members) > 0) {
    echo "<div class='group-list-container'>";

    $counter = 0; // Initialize the counter

    foreach ($members as $member) {
        if ($counter >= ($page - 1) * $per_page && $counter < $page * $per_page) {
            // Display member details
            $memberid = $member->ID;
            $membertitle = $member->post_title;
            $slug = $member->post_name;

            $obj = Get_Member($memberid);
            $firstname = $obj->firstname;
            $lastname = $obj->lastname;
            $industrys = $obj->industry;
            $industry = "";

            foreach ($industrys as $industryid) {
                $industryname = get_the_title($industryid);
                if ($industry == "") {
                    $industry = $industryname;
                } else {
                    $industry = $industry . " " . $industryname;
                }
            }

            echo "<div class='group-list-single-box hoverorange'>";
            echo "<a href='/members/$member->post_name' style=''>";
            echo '<div class="group-list-single-box-image" style="background-image: url(' . esc_url($obj->logourl) . ');background-size: contain;background-position: center center;background-position: center center;background-repeat: no-repeat;"></div>';
            echo '<div class="group-list-single-box-text">';
            echo "<h3 style='margin:0px;padding:0px;padding-top:10px;font-size:18px'>$membertitle</h3>";
            echo "<h3 class='fontroboto' style='color:black;margin:0px;padding-top:5px;padding:0px;font-size:16px;'>$firstname $lastname</h3>";
            if ($industry) {
                echo "<h3 class='fontroboto' style='color:black;margin:0px;padding-top:5px;padding:0px;font-size:16px;'>[$industry]</h3>";
            }
            echo '</div>';
            echo '</a>';
            echo "</div>";
        }

        $counter++;

        // Break the loop if we have displayed 10 members
        if ($counter >= $page * $per_page) {
            break;
        }
    }

    echo "</div>";

} else {
    echo "<spam style='font-size:17px'>$msg</spam><br><br>";
}

    

    return ob_get_clean();
}
add_shortcode('memberlist', 'members_list_shortcode');
?>