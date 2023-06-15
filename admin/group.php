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

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'industry-new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    
    global $wpdb;

    if(!$message){
        echo '<div style="display:block" id="networkersbox" class="networkersbox">';
    }else{
        echo '<div style="display:none" id="networkersbox" class="networkersbox">';
    }
    
        echo "<form id='myForm' action='$url' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>New Group</h2>';
            echo '</div><br>';

            echo '<label>Name:</label><br>';
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
                echo '<option value="01">15</option>';
                echo '<option value="02">30</option>';
                echo '<option value="03">45</option>';
            echo '</select></div>';
            echo '<div style="float:left"><select style="float:left" name="starttime" id="starttime">';
                echo '<option value="00" selected>am</option>';
                echo '<option value="01">pm</option>';
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
                echo '<option value="01">15</option>';
                echo '<option value="02" selected>30</option>';
                echo '<option value="03">45</option>';
            echo '</select></div>';
            echo '<div style="float:left"><select style="float:left" name="finishtime" id="finishtime">';
                echo '<option value="00" selected>am</option>';
                echo '<option value="01">pm</option>';
            echo '</select></div></div><br><br>';

            echo '<label>Description:</label><br>';
            echo '<textarea id="description" name="description" rows="4" cols="57"></textarea><br>';

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

            echo '<input type="text" name="image_url" id="image_url" class="regular-text">';

            echo '<input type="button" style="width:150px;" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload PDF"><br><br>';


            

            echo "<br><div style='margin-top:-10px' class='networkersbuttom' onclick='newindustry()' >Create</div>";
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


    echo '
    <script type="text/javascript">

    jQuery(document).ready(function($){

        $("#upload-btn").click(function(e) {

            e.preventDefault();

            var image = wp.media({ 

                title: "Upload PDF",

                multiple: false

            }).open()

            .on("select", function(e){

                var uploaded_image = image.state().get("selection").first();

                console.log(uploaded_image);

                var image_url = uploaded_image.toJSON().url;

                $("#image_url").val(image_url);

            });

        });

    });

    jQuery(document).ready(function($){

        $("#uploadd-btn").click(function(e) {

            e.preventDefault();

            var image = wp.media({ 

                title: "Upload Image",

                multiple: false

            }).open()

            .on("select", function(e){

                var uploaded_image = image.state().get("selection").first();

                console.log(uploaded_image);

                var image_urll2 = uploaded_image.toJSON().url;

                $("#image_urll2").val(image_urll2);

            });

        });

    });

    </script>
    ';
   
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
            'facilitator' => 'Facilitator',
            'weekday' => 'Week Day',
            'city' => 'City',
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
                $facilitator = get_user_meta( $post->ID, 'facilitator', true );
                $weekday = get_user_meta( $post->ID, 'weekday', true );
                $city = get_user_meta( $post->ID, 'city', true );
                $data2 = array(
                    'id' => $post->ID,
                    'name' => $post->post_title,
                    'facilitator' => $facilitator,
                    'weekday' => $city,
                    'city' => $city,
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
            case 'facilitator':
            case 'weekday':
            case 'city':
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