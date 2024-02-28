<?php

function regioninput($regionsselected = [], $multiple = true) {

    //Get Role
    $user_role = Get_User_Role();

    //Region Availables
    if($user_role == "administrator" || $user_role == "network-admin"){
        $args = array('post_type' => 'network-region','posts_per_page' => -1);
        $regions = get_posts($args);
    }else{
        $regions = [];
        $regionss = get_user_meta( $user->ID, 'region', false );
        foreach($regionss as $regionid) {
            $region = get_post( $regionid );
            $obj = new region();
            $obj->ID = $regionid;
            $obj->post_title = $region->post_title;
            array_push($regions, $obj);
        }
    }

    //Region Selected (If have any - updates sections)
    $regionselected = [];
    foreach($regionsselected as $regionid) {
        $region = get_post( $regionid );
        $obj = new region();
        $obj->ID = $regionid;
        $obj->post_title = $region->post_title;
        array_push($regionselected, $obj);
    }

    echo '<h3>Regions</h3>';

    //check if user have multiple region options
    if(count($regions) > 1){

        //check if needs to display in case of single region and alread selected.
        $regiondisplay = ($multiple == false && count($regionselected) > 0) ? "display:none" : "display:block";

        echo '<div style="position:relative">';
            echo '<input id="region" style="'.$regiondisplay.'" type="text" name="region" onfocusout="cleansearch()" onfocus="searchregion()" onKeyUp="searchregion()">';
            echo '<div class="hideinput" style="display:block">';
                foreach($regions as $post) {
                    $onclick = "addregion(\"$post->ID\",\"$post->post_title\", " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div onclick='$onclick' class='hideinputinside'>$post->post_title</div>";
                }
            echo '</div>';
        echo '</div>';

        //Select all region selected
        echo '<div id="regions">';
        foreach($regionselected as $region) {
            echo '<div class="regiondiv" style="width:100%;max-width:500px;display:flex">';
                echo "<input class='inputregion regionid' type='text' value='$region->ID' name='regionid[]' style='width:50px;display:none' readonly>";
                echo "<input class='inputregion' type='text' value='$region->post_title' name='region[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                $onclick = "removeregion2(this, " . ($multiple ? 'true' : 'false') . ")";
                echo "<div class='regionremove' onclick='$onclick'>X</div>";
            echo '</div>';
        }
        echo '</div>';

        //Messagem at the bottom of the Region Box
        if ($multiple == false) {
            // Single selection will check if it needs to be displayed or not.
            $regiondisplay = (count($regionselected) == 0) ? "display:block" : "display:none";
            echo '<p id="regiontext01" style="' . $regiondisplay . '">Please Search the Region</p>';
            echo '<p id="regiontext02" style="' . $regiondisplay . '"></p><br>';
        } else {
            echo '<p id="regiontext01">Please Search the Region(s)</p>';
            echo '<p id="regiontext02">You can add multiple Regions</p><br>';
        }

    }else{
        //User only have one option and select that automaticly
        echo '<div id="regions">';
            foreach($regions as $post) {
                echo '<div class="regiondiv">';
                    echo "<input class='inputregion regionid' type='text' value='$post->ID' name='regionid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputregion' type='text' value='$post->post_title' name='region[]' style='width:100%;' readonly>";
                echo '</div>';
            }
        echo '</div><br>';
    }
}
?>