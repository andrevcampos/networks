<?php
function networkers_group() {

    

    $plugin_url = plugin_dir_url( __FILE__ );
    $removeurl = $plugin_url . 'group-remove.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    //POPUP MESSAGE BOX
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';

    echo '<div class="wrap">';
        echo '<h2>The Networkers</h2>';
    echo '</div><br>';

    $exampleListTable = new Group_List_Table();
    $exampleListTable->prepare_items();
    echo '<div id="networkersbox" class="wrap">';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Group List</h2>';
        $exampleListTable->display();
    echo '</div>';

    echo '<div id="networkersmessage" style="display:none" class="wrap">';
        echo '<h2>Remove Group</h2>';
        echo '<h3 id="textremove">Group Name: </h3>';
        echo '<p>Type DELETE to remove this Group</p>';
        echo '<input id="inputremove" type="text" name="inputremove" onKeyUp="removecheck()">';
        echo "<form id='myFormRemove' action='$removeurl' method='post'>";
            echo '<input id="removeid" type="text" name="removeid" style="display:none" value="">';
            echo "<button type='submit' id='buttonremove' style='display:none;cursor:pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px'>Remove</button>";
        echo '</form>';
        echo "<div id='buttongoback' onclick='networkersgoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    echo '</div>';
    
}

function networkers_group_new() {

    wp_enqueue_media();
    include '../../../../wp-load.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/imagebox.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'group-new.php';
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
            echo '</select></div></div><br><br>';

            echo '<label>Description:</label><br>';
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

            ImageBox("blank");

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

            regioninput("false", $regions);

            echo "<br><br><br><div style='margin-top:-10px' class='networkersbuttom' onclick='newgroup()' >Create</div>";
        echo "</form>";
    echo "</div>";
    
}

function networkers_group_update() {

    wp_enqueue_media();
    include '../../../../wp-load.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/imagebox.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'group-new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    $imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

    //POPUP MESSAGE BOX
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    
    global $wpdb;

    $groupid = $_GET['id'];
    $group = get_post($groupid);
    $title = $group->post_title;
    $weekday = get_post_meta( $groupid, 'weekday', true );
    $start = get_post_meta( $groupid, 'start', true );
    $finsh = get_post_meta( $groupid, 'finsh', true );
    $description = base64_decode(get_post_meta( $groupid, 'description', true ));
    $lcompany = get_post_meta( $groupid, 'lcompany', true );
    $laddress = get_post_meta( $groupid, 'laddress', true );
    $lsuburb = get_post_meta( $groupid, 'lsuburb', true );
    $lcity = get_post_meta( $groupid, 'lcity', true );
    $lpostcode = get_post_meta( $groupid, 'lpostcode', true );
    $imageid = get_post_meta( $groupid, 'imageid', true );

    $region = get_post_meta( $groupid, 'regions', true );
    $regions = array($region);


    

    $startpieces = explode(":", $start);
    $starthour = $startpieces[0]; 
    $startmin = $startpieces[1]; 
    $starttime = $startpieces[2]; 

    $finishpieces = explode(":", $finsh);
    $finishhour = $finishpieces[0]; 
    $finishmin = $finishpieces[1]; 
    $finishtime = $finishpieces[2]; 


    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
            echo '<div class="wrap">';
                echo '<h2>Edit Group</h2>';
            echo '</div><br>';

            echo '<label>Group Name:</label><br>';
            echo "<input id='name' type='text' name='name' value='$title'><br><br>";

            echo '<label>Week Day:</label><br>';
            echo '<select name="weekday" id="weekday">';
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
            echo '<div><div style="float:left"><select name="starthour" id="starthour">';
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
            echo '</select></div>';
            echo '<div style="float:left"><select name="startmin" id="startmin">';
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
            echo '</select></div>';
            echo '<div style="float:left"><select style="float:left" name="starttime" id="starttime">';
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
            echo '</select></div></div><br><br>';

            echo '<label>Finish at:</label><br>';
            echo '<div><div style="float:left"><select name="finishhour" id="finishhour">';
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
            echo '</select></div>';
            echo '<div style="float:left"><select name="finishmin" id="finishmin">';
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
            echo '</select></div>';
            echo '<div style="float:left"><select style="float:left" name="finishtime" id="finishtime">';
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
            echo '</select></div></div><br><br>';

            echo '<label>Description:</label><br>';
            
                wp_editor( $description , 'my_option', array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'textarea_name' => 'my_option',
                    'editor_class'  => 'my_custom_class',
                    'textarea_rows' => 10
                ) );
            
            echo '<h3>Location:</h3>';
            echo '<label>Company:</label><br>';
            echo '<input id="lcompany" type="text" name="lcompany" value="'.$lcompany.'"><br>';
            echo '<label>Street Address:</label><br>';
            echo '<input id="laddress" type="text" name="laddress" value="'.$laddress.'"><br>';
            echo '<label>Suburb:</label><br>';
            echo '<input id="lsuburb" type="text" name="lsuburb" value="'.$lsuburb.'"><br>';
            echo '<label>City:</label><br>';
            echo '<input id="lcity" type="text" name="lcity" value="'.$lcity.'"><br>';
            echo '<label>Postcode:</label><br>';
            echo '<input id="lpostcode" type="text" name="lpostcode" value="'.$lpostcode.'"><br>';

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

            regioninput("false", $regions);

            echo "<br><br><br><div style='margin-top:-10px' class='networkersbuttom' onclick='newgroup()' >Create</div>";
        echo "</form>";
    echo '</div">';
   
}

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Group_List_Table extends WP_List_Table
{

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }


    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'name' => 'Name',
            'region' => 'Region',
            'time' => 'Time',
            'city' => 'City',
            'facilitator' => 'Facilitator',
        );
        return $columns;
    }

    function column_name($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=networkers-group-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<div style="display: inline-block;color:red;cursor: pointer;" onclick="networkersremovebox(%s,\'%s\')">Remove</div>',  $item['id'],  $item['name']),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );

    }

    public function get_hidden_columns()
    {
        return array();
    }

    public function get_sortable_columns()
    {
        return array('name' => array('name', false),'id' => array('id', false));
    }

  
    private function table_data()
    {
        $args = array(
            'post_type' => "network-group",
            'posts_per_page' => -1
          );
        $latest_posts = get_posts( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                
                $weekday = get_post_meta( $post->ID, 'weekday', true );
                $start = get_post_meta( $post->ID, 'start', true );
                $finsh = get_post_meta( $post->ID, 'finsh', true );
                $time = $weekday . " " . $start . " - " . $finsh;
                $city = get_post_meta( $post->ID, 'lcity', true );
                $region = get_post_meta( $post->ID, 'region', true );
                $facilitator = get_post_meta( $post->ID, 'facilitator', true );
                $data2 = array(
                    'id' => $post->ID,
                    'name' => $post->post_title,
                    'region' => $region,
                    'time' => $time,
                    'city' => $city,
                    'facilitator' => $facilitator,
                    );
                array_push($data, $data2);
            }
        }
        return $data;
    }

    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'name':
            case 'region':
            case 'time':
            case 'city':
            case 'facilitator':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'id';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}

?>