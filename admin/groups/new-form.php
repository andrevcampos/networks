<?php
function networkers_group_new() {

wp_enqueue_media();
include '../../../../../wp-load.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/imagebox.php';

$plugin_url = plugin_dir_url( __FILE__ );
$url = $plugin_url . 'new.php';
wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

$imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

//POPUP MESSAGE BOX
include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';

global $wpdb;
echo '<div style="display:block" id="networkersbox" class="networkersbox">';
    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
        echo '<div class="wrap">';
            echo '<h2>New Group</h2>';
        echo '</div><br>';

        echo '<label>Group Name:</label><br>';
        echo '<input id="name" type="text" name="name"><br><br>';

        echo '<label>Week Day:</label><br>';
        echo '<select name="weekday" id="weekday">';
            echo '<option value="monday" selected>Monday</option>';
            echo '<option value="tuesday">Tuesday</option>';
            echo '<option value="wednesday">Wednesday</option>';
            echo '<option value="thursday">Thursday</option>';
            echo '<option value="friday">Friday</option>';
            echo '<option value="saturday">Saturday</option>';
            echo '<option value="sunday">Sunday</option>';
        echo '</select><br><br>';

        echo '<label>Start at:</label><br>';
        echo '<div><div style="float:left"><select name="starthour" id="starthour">';
            echo '<option value="00">00</option>';
            echo '<option value="01">01</option>';
            echo '<option value="02">02</option>';
            echo '<option value="03">03</option>';
            echo '<option value="04">04</option>';
            echo '<option value="05">05</option>';
            echo '<option value="06">06</option>';
            echo '<option value="07" selected>07</option>';
            echo '<option value="08">08</option>';
            echo '<option value="09">09</option>';
            echo '<option value="10">10</option>';
            echo '<option value="11">11</option>';
            echo '<option value="12">12</option>';
        echo '</select></div>';
        echo '<div style="float:left"><select name="startmin" id="startmin">';
            echo '<option value="00" selected>00</option>';
            echo '<option value="15">15</option>';
            echo '<option value="30">30</option>';
            echo '<option value="45">45</option>';
        echo '</select></div>';
        echo '<div style="float:left"><select style="float:left" name="starttime" id="starttime">';
            echo '<option value="am" selected>am</option>';
            echo '<option value="pm">pm</option>';
        echo '</select></div></div><br><br>';

        echo '<label>Finish at:</label><br>';
        echo '<div><div style="float:left"><select name="finishhour" id="finishhour">';
            echo '<option value="00">00</option>';
            echo '<option value="01">01</option>';
            echo '<option value="02">02</option>';
            echo '<option value="03">03</option>';
            echo '<option value="04">04</option>';
            echo '<option value="05">05</option>';
            echo '<option value="06">06</option>';
            echo '<option value="07">07</option>';
            echo '<option value="08" selected>08</option>';
            echo '<option value="09">09</option>';
            echo '<option value="10">10</option>';
            echo '<option value="11">11</option>';
            echo '<option value="12">12</option>';
        echo '</select></div>';
        echo '<div style="float:left"><select name="finishmin" id="finishmin">';
            echo '<option value="00">00</option>';
            echo '<option value="15">15</option>';
            echo '<option value="30" selected>30</option>';
            echo '<option value="45">45</option>';
        echo '</select></div>';
        echo '<div style="float:left"><select style="float:left" name="finishtime" id="finishtime">';
            echo '<option value="am" selected>am</option>';
            echo '<option value="pm">pm</option>';
        echo '</select></div></div><br><br><br>';

        echo '<label>Description:</label>';
        echo '<div style="max-width:500px">';
            wp_editor( $my_option , 'my_option', array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_name' => 'my_option',
                'editor_class'  => 'my_custom_class',
                'textarea_rows' => 10
            ) );
        echo '</div">';

        echo '<h3>Location:</h3>';
        echo '<label>Company:</label><br>';
        echo '<input id="lcompany" type="text" name="lcompany"><br>';
        echo '<label>Street Address:</label><br>';
        echo '<input id="laddress" type="text" name="laddress"><br>';
        echo '<label>Suburb:</label><br>';
        echo '<input id="lsuburb" type="text" name="lsuburb"><br>';
        echo '<label>City:</label><br>';
        echo '<input id="lcity" type="text" name="lcity"><br>';
        echo '<label>Postcode:</label><br>';
        echo '<input id="lpostcode" type="text" name="lpostcode"><br>';

        ImageBox();

        echo '<br><br><h3>Facilitator</h3>';
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

        echo "<br><br><br><div style='margin-top:-10px' class='networkersbuttom' onclick='newgroup()' >Create</div>";
    echo "</form>";
echo "</div>";

}

?>