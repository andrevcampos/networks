<?php

function networkers_group_update() {

    wp_enqueue_media();
    include '../../../../../wp-load.php';
    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'update.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

    global $wpdb;

    $groupid = $_GET['id'];
    $group = get_post($groupid);
    $title = $group->post_title;
    $weekday = get_post_meta( $groupid, 'weekday', true );
    $start = get_post_meta( $groupid, 'start', true );
    $finish = get_post_meta( $groupid, 'finish', true );
    $description = base64_decode(get_post_meta( $groupid, 'description', true ));
    $lcompany = get_post_meta( $groupid, 'company', true );
    $laddress = get_post_meta( $groupid, 'address', true );
    $lsuburb = get_post_meta( $groupid, 'suburb', true );
    $lcity = get_post_meta( $groupid, 'city', true );
    $lpostcode = get_post_meta( $groupid, 'postcode', true );
    $imageid = get_post_meta( $groupid, 'imageid', true );

    $region = get_post_meta( $groupid, 'regions', true );
    $regions = array($region);

    $startpieces = explode(":", $start);
    $starthour = $startpieces[0]; 
    $startmin = $startpieces[1]; 
    $starttime = $startpieces[2]; 

    $finishpieces = explode(":", $finish);
    $finishhour = $finishpieces[0]; 
    $finishmin = $finishpieces[1]; 
    $finishtime = $finishpieces[2]; 


    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
            echo '<div class="wrap">';
                echo '<h2>Edit Group</h2>';
            echo '</div><br><br>';

            echo '<label>Group Name:</label><br>';
            echo "<input id='name' type='text' name='name' value='$title'><br><br>";
            echo "<input style='display:none' id='orginalname' type='text' name='orginalname' value='$title'>";
            echo "<input style='display:none' id='postid' type='text' name='postid' value='$groupid'>";

            echo '<label>Week Day:</label><br>';
            echo '<select name="weekday" id="weekday" class="select">';
                if($weekday == "monday"){
                    echo '<option value="monday" selected>Monday</option>';
                }else{
                    echo '<option value="monday">Monday</option>';
                }
                if($weekday == "tuesday"){
                    echo '<option value="tuesday" selected>Tuesday</option>';
                }else{
                    echo '<option value="tuesday">Tuesday</option>';
                }
                if($weekday == "wednesday"){
                    echo '<option value="wednesday" selected>Wednesday</option>';
                }else{
                    echo '<option value="wednesday">Wednesday</option>';
                }
                if($weekday == "thursday"){
                    echo '<option value="thursday" selected>Thursday</option>';
                }else{
                    echo '<option value="thursday">Thursday</option>';
                }
                if($weekday == "friday"){
                    echo '<option value="friday" selected>Friday</option>';
                }else{
                    echo '<option value="friday">Friday</option>';
                }
                if($weekday == "saturday"){
                    echo '<option value="saturday" selected>Saturday</option>';
                }else{
                    echo '<option value="saturday">Saturday</option>';
                }
                if($weekday == "sunday"){
                    echo '<option value="sunday" selected>Sunday</option>';
                }else{
                    echo '<option value="sunday">Sunday</option>';
                }
            echo '</select><br><br>';

            echo '<label>Start at:</label><br>';
            echo '<div style="display:flex"><select name="starthour" id="starthour" class="select">';
            for ($i = 0; $i < 13; $i++){
                if($i > 9){
                    if($starthour == "$i"){
                        echo "<option value='$i' selected>$i</option>";
                    }else{
                        echo "<option value='$i'>$i</option>";
                    }
                }else{
                    if($starthour == "0$i"){
                        echo "<option value='0$i' selected>0$i</option>";
                    }else{
                        echo "<option value='0$i'>0$i</option>";
                    }
                }
                
            }
            echo '</select>';
            echo '<select name="startmin" id="startmin" class="select">';
                if($startmin == "00"){
                    echo '<option value="00" selected>00</option>';
                }else{
                    echo '<option value="00">00</option>';
                }
                if($startmin == "15"){
                    echo '<option value="15" selected>15</option>';
                }else{
                    echo '<option value="15">15</option>';
                }
                if($startmin == "30"){
                    echo '<option value="30" selected>30</option>';
                }else{
                    echo '<option value="30">30</option>';
                }
                if($startmin == "45"){
                    echo '<option value="45" selected>45</option>';
                }else{
                    echo '<option value="45">45</option>';
                }
            echo '</select>';
            echo '<select style="float:left" name="starttime" id="starttime" class="select">';
                if($starttime == "am"){
                    echo '<option value="am" selected>am</option>';
                }else{
                    echo '<option value="am">am</option>';
                }
                if($starttime == "pm"){
                    echo '<option value="pm" selected>pm</option>';
                }else{
                    echo '<option value="pm">pm</option>';
                }
            echo '</select></div><br>';

            echo '<label>Finish at:</label><br>';
            echo '<div style="display:flex"><select name="finishhour" id="finishhour" class="select">';
                for ($i = 0; $i < 13; $i++){
                    if($i > 9){
                        if($finishhour == "$i"){
                            echo "<option value='$i' selected>$i</option>";
                        }else{
                            echo "<option value='$i'>$i</option>";
                        }
                    }else{
                        if($finishhour == "0$i"){
                            echo "<option value='0$i' selected>0$i</option>";
                        }else{
                            echo "<option value='0$i'>0$i</option>";
                        }
                    }
                    
                }
            echo '</select>';
            echo '<select name="finishmin" id="finishmin" class="select">';
                if($finishmin == "00"){
                    echo '<option value="00" selected>00</option>';
                }else{
                    echo '<option value="00">00</option>';
                }
                if($finishmin == "15"){
                    echo '<option value="15" selected>15</option>';
                }else{
                    echo '<option value="15">15</option>';
                }
                if($finishmin == "30"){
                    echo '<option value="30" selected>30</option>';
                }else{
                    echo '<option value="30">30</option>';
                }
                if($finishmin == "45"){
                    echo '<option value="45" selected>45</option>';
                }else{
                    echo '<option value="45">45</option>';
                }
            echo '</select>';
            echo '<select style="float:left" name="finishtime" id="finishtime" class="select">';
                if($finishtime == "am"){
                    echo '<option value="am" selected>am</option>';
                }else{
                    echo '<option value="am">am</option>';
                }
                if($finishtime == "pm"){
                    echo '<option value="pm" selected>pm</option>';
                }else{
                    echo '<option value="pm">pm</option>';
                }
            echo '</select></div><br><br>';

            echo '<label>Description:</label>';
            echo '<div style="max-width:100%">';
                wp_editor( $description , 'my_option', array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'textarea_name' => 'my_option',
                    'editor_class'  => 'my_custom_class',
                    'textarea_rows' => 10
                ) );
            echo '</div">';
            
            echo '<h3>Location:</h3>';
            echo '<div><label>Company:</label><br>';
            echo '<input id="lcompany" type="text" name="lcompany" value="'.$lcompany.'"></div><br>';
            echo '<div><label>Street Address:</label><br>';
            echo '<input id="laddress" type="text" name="laddress" value="'.$laddress.'"></div><br>';
            echo '<div><label>Suburb:</label><br>';
            echo '<input id="lsuburb" type="text" name="lsuburb" value="'.$lsuburb.'"></div><br>';
            echo '<div><label>City:</label><br>';
            echo '<input id="lcity" type="text" name="lcity" value="'.$lcity.'"></div><br>';
            echo '<div><label>Postcode:</label><br>';
            echo '<input id="lpostcode" type="text" name="lpostcode" value="'.$lpostcode.'"></div><br>';

            ImageBox($imageid);
  
            echo '<h3>Facilitator</h3>';
            echo '<div id="facilitatorbox" style="position:relative">';
                echo '<input id="facilitator" type="text" name="facilitator" onKeyUp="franchiseinputsearch()">';
                echo '<div class="hideinput">';
                    $args = array('post_type' => 'network-member','posts_per_page' => -1);
                    $posts = get_posts($args);
                    foreach($posts as $post) {
                        $facilitator = get_post_meta( $post->ID, 'facilitator', true );
                        if($facilitator == "yes"){
                            $firstName = get_post_meta( $post->ID, 'firstName', true );
                            $lastName = get_post_meta( $post->ID, 'lastName', true );
                            $fullName = $firstName . " " . $lastName; 
                            echo "<div onclick='franchiseaddsearch(\"$post->ID\",\"$fullName\")' class='hideinputinside'>$post->post_title</div>";
                        }
                    }
                echo '</div>';
            echo '</div>';
            echo '<div id="facilitators">';
            echo '</div>';
            echo '<p id="pfacilitator01">Please select the facilitator</p>';
            echo '<p id="pfacilitator02">Start typing to view facilitator names. Type "all" to view all.</p>';

            regioninput($regions, false);

            echo "<br><div class='networkersbuttom' onclick='newgroup()' >Update</div>";
        echo "</form>";
    echo '</div">';
   
}

?>