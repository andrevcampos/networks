<?php
function networkers_group() {

    

    $plugin_url = plugin_dir_url( __FILE__ );
    $removeurl = $plugin_url . 'group-remove.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    echo '<div class="wrap">';
        echo '<h2>The Networkers</h2>';
    echo '</div><br>';

    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    if(!$message){

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

    }else{
        echo '<div id="networkersmessage" style="display:block" >';
            echo "<h2>$messagetitle</h2>";
            echo "<h4>$message</h4>";
        echo '</div>';
    }
}

function networkers_group_new() {

    wp_enqueue_media();
    include '../../../../wp-load.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'group-new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    $imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    
    global $wpdb;

    if(!$message){
        echo '<div style="display:block" id="networkersbox" class="networkersbox">';
    }else{
        echo '<div style="display:none" id="networkersbox" class="networkersbox">';
    }
    
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
            wp_editor( $my_option , 'my_option', array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_name' => 'my_option',
                'editor_class'  => 'my_custom_class',
                'textarea_rows' => 10
            ) );

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

            echo '<h3>Group Image:</h3>';
            echo '<input type="file" onchange="checkimage(this)" name="image_url" id="image_url" accept="image/png, image/gif, image/jpeg">';
            echo '<div id="imagecomment" style="font-size:16px;display:none;color:red;">Success</div>';
            echo "<div id='imagebox' style='width:100%;display:none;margin-top:20px'><img id='groupimg' src='' height='150'></div>";


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
    echo "</div>";

    if(!$message){
        echo '<div id="networkersmessage" style="display:none" >';
    }else{
        echo '<div id="networkersmessage" style="display:block" >';
    }
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
        echo "<h4 id='message'>$message</h4>";
        echo "<div id='buttongoback' onclick='networkersgoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    echo '</div>';
   
}

function networkers_group_update() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'industry-update.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];

    $userid = $_GET['id'];
    $user = get_post($userid);
    $title = $user->post_title;
    
    if(!$message){
        echo '<div style="display:block" id="networkersbox" class="networkersbox">';
    }else{
        echo '<div style="display:none" id="networkersbox" class="networkersbox">';
    }
    
        echo "<form id='myForm' action='$url' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>Update Industry</h2>';
            echo '</div><br>';

            echo '<label>Name:</label><br>';
            echo "<input id='name' type='text' name='name' value='$title'><br><br>";
            echo "<input style='display:none' id='networkersid' type='text' name='networkersid' value='$userid'>";

            echo "<div style='margin-top:-10px' class='networkersbuttom' onclick='updateindustry()' >Update</div>";
        echo "</form>";
    echo "</div>";

    if(!$message){
        echo '<div id="networkersmessage" style="display:none" >';
    }else{
        echo '<div id="networkersmessage" style="display:block" >';
    }
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
        echo "<h4 id='message'>$message</h4>";
        echo "<div id='buttongoback' onclick='networkersgoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    echo '</div>';
   
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
            'edit' => sprintf('<a href="?page=networkers-industry-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
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