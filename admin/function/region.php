<?php

    class region
    {
        public $ID;
        public $post_title;
    }

    function regioninput($multiple, $regionsselected) {

        if(!$multiple){
            $multiple = "true";
        }

        if(!$regionsselected){
            $regionsselected = "";
        }

        //Get Role
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
        $user_role = $roles[0];
        if ($user_role == "franchise"){
            $regions = get_user_meta( $user->ID, 'region', false );
        } 

        //Region Availables
        if($user_role == "administrator" || $user_role == "networkadmin"){
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

        if(count($regions) > 1){

            echo '<div style="position:relative">';
                echo '<input id="region" type="text" name="region" onfocusout="cleansearch()" onfocus="searchregion()" onKeyUp="searchregion()">';
                echo '<div class="hideinput" style="display:block">';
                    foreach($regions as $post) {
                        echo "<div onclick='addregion(\"$post->ID\",\"$post->post_title\", \"$multiple\" )' class='hideinputinside'>$post->post_title</div>";
                    }
                echo '</div>';
            echo '</div>';

            echo '<div id="regions">';
            foreach($regionselected as $region) {
                echo '<div class="regiondiv">';
                    echo "<input class='inputregion' type='text' value='$region->ID' name='regionid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputregion' type='text' value='$region->post_title' name='region[]' style='width:calc(100% - 250px);' readonly>";
                    echo "<div class='franchiseregionremove' onclick='removeregion(this,\"$multiple\")'>X</div>";
                echo '</div>';
            }
            echo '</div>';

            if($multiple == "false"){
            
                echo '<p id="regiontext01">Please Search the Region</p>';
            }else{
                echo '<p id="regiontext01">Please Search the Region(s)</p>';
                echo '<p id="regiontext02">You can add multiple Regions</p><br><br>';
            }

        }else{
            echo '<div id="regions">';
                foreach($regions as $post) {
                    echo '<div class="regiondiv">';
                        echo "<input class='inputregion' type='text' value='$post->ID' name='regionid[]' style='width:50px;display:none' readonly>";
                        echo "<input class='inputregion' type='text' value='$post->post_title' name='region[]' style='width:100%;' readonly>";
                    echo '</div>';
                }
            echo '</div>';
        }
    
    }
?>