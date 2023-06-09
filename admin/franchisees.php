<?php
function networkers_franchisees() {

$plugin_url = plugin_dir_url( __FILE__ );
wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

$message = $_GET["message"];
$messagetitle = $_GET["messagetitle"];

if(!$message){
    echo '<div id="memberbox">';
}else{
    echo '<div id="memberbox" style="display:none">';
}
    echo '<div class="wrap">';
        echo '<h2>The Networkers</h2>';
    echo '</div><br>';

    $exampleListTable = new Example_List_Table();
    $exampleListTable->prepare_items();
    echo '<div class="wrap">';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Franchisees List</h2>';
        $exampleListTable->display();
    echo '</div>';
echo '</div>';

if(!$message){
    echo '<div id="regionmessage" style="display:none" >';
}else{
    echo '<div id="regionmessage" style="display:block" >';
}
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
        echo "<h4 id='message'>$message</h4>";
        echo "<div id='buttongoback' onclick='franchisegoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    echo '</div>';

}

function networkers_franchisees_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'franchisees-new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
    
    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    
        if(!$message){
            echo '<div id="memberbox" class="memberbox">';
        }else{
            echo '<div id="memberbox" style="display:none" class="memberbox">';
        }
            echo '<div class="wrap">';
                echo '<h2>New Franchise</h2>';
            echo '</div><br>';
            echo "<form id='myForm' action='$url' method='post' autocomplete='off'>";
            echo '
            <label>login:</label><br>
            <input id="login" type="text" name="login"><br><br>

            <label>Password:</label><br>
            <input id="password" type="text" name="password"><br><br>
            <div style="margin-top:-10px;background-color:#b5c5e4;color:black" class="memberbuttom" onclick="generatepassword()" >Generate Password</div>

            <label>First Name:</label><br>
            <input id="firstName" type="text" name="firstName"><br><br>

            <label>Last Name:</label><br>
            <input id="lastName" type="text" name="lastName"><br><br>

            <label>Email:</label><br>
            <input id="email" type="text" name="email"><br><br>

            <label>Phone:</label><br>
            <input id="phone" type="text" name="phone"><br><br>
            ';

            // Multiple selection and nothing selected.
            regioninput();
            
            
        echo "<div style='margin-top:-10px' class='memberbuttom' onclick='newfranchise(\"$url\")' >Register</div>";
        echo "
        </div>
        </form>
        ";

    if(!$message){
        echo '<div id="regionmessage" style="display:none" >';
    }else{
        echo '<div id="regionmessage" style="display:block" >';
    }
            echo "<h2 id='messagetitle'>$messagetitle</h2>";
            echo "<h4 id='message'>$message</h4>";
            echo "<div id='buttongoback' onclick='franchisegoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
        echo '</div>';
    
}

function networkers_franchisees_update() {

    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
    include '../../../../wp-load.php';
    global $wpdb;

    $userid = $_GET['id'];
    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];

    if(!$userid && !$message){
        echo "<div class='wrap'>";
            echo "<h2>You must select the franchise from the franchise table.</h2>";
        echo "</div><br>";
        exit();
    }

    $user = get_user_by('id', $userid);
    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );
    $region = get_user_meta( $user->ID, 'region', true );
    $phone = get_user_meta( $user->ID, 'phone', true );
    $regions = get_user_meta( $user->ID, 'region', false );
    $login = $user->user_login;
    $email = $user->user_email;

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'franchisees-update.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    

    echo "<form id='myForm' action='$url' method='post'>";
    echo "<input id='userid' type='text' name='userid' value='$userid' style='display:none'>";

        if(!$message){
            echo '<div id="memberbox" class="memberbox">';
        }else{
            echo '<div id="memberbox" style="display:none" class="memberbox">';
        }
        echo "<div class='wrap'>";
            echo "<h2>Update Franchise</h2>";
        echo "</div><br>";

        echo "<label>LOGIN:</label><br>";
        echo "<input id='login' type='text' name='login' value='$login' style='background-color:#b5c5e4;font-size:18px' readonly><br><br>";

        echo "<label>PASSWORD:</label><br>";
        echo "<div id='setnewpasswordbutton' style='margin-top:10px;background-color:#b5c5e4;color:black' class='memberbuttom' onclick='setnewpassword()' >Set New Password</div>";
        echo "<input id='password' type='text' name='password' style='display:none'>";
        echo "<div id='generatepasswordbutton' style='background-color:#b5c5e4;color:black;display:none' class='memberbuttom' onclick='generatepassword()' >Generate Password</div>";
        echo "<p id='ppassword' style='display:none;margin-top:-20px;margin-bottom:20px'>If the password field is left empty, the old password will be retained.</p>" ;

        echo "<label>First Name:</label><br>";
        echo "<input id='firstName' type='text' name='firstName' value='$first_name'><br><br>";

        echo "<label>Last Name:</label><br>";
        echo "<input id='lastName' type='text' name='lastName' value='$last_name'><br><br>";

        echo "<label>Email:</label><br>";
        echo "<input id='oldemail' type='text' name='oldemail' value='$email' style='display:none'>";
        echo "<input id='email' type='text' name='email' value='$email'><br><br>";

        echo "<label>Phone:</label><br>";
        echo "<input id='phone' type='text' name='phone' value='$phone'><br><br>";

        // Multiple selection and array with regions.
        regioninput($regions);
    

    echo "<div style='margin-top:-10px' class='memberbuttom' onclick='updatefranchise(\"$url\")' >Update</div>";
    echo "
        </div>
        </form>
    ";

    if(!$message){
        echo '<div id="regionmessage" style="display:none" >';
    }else{
        echo '<div id="regionmessage" style="display:block" >';
    }
            echo "<h2 id='messagetitle'>$messagetitle</h2>";
            echo "<h4 id='message'>$message</h4>";
            echo "<div id='buttongoback' onclick='franchisegoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
        echo '</div>';

}

function networkers_franchisees_add() {

    $user = 'hiran';
    $pass = '123456';
    $email = 'example@yourdomain.com';
    $user_url = 'https://wordpress.org';
    $first_name = 'Wxyz';
    $last_name = 'Abcd';
    $description = 'I am a developer';

    if( !username_exists( $user )  && !email_exists( $email ) ){ 
    $user_id = wp_create_user( $user, $pass, $email ); 
    $user = new WP_User( $user_id ); 
    $user->set_role( 'administrator' ); 
    // subscriber | contributor | author | editor | administrator

    $user_id = wp_update_user( array( 'ID' => $user_id, 'user_url' => $user_url, 'first_name' => $first_name, 'last_name' => $last_name, 'description' => $description ) );
    
    if ( is_wp_error( $user_id ) ) { 
        //There was an error, probably that user doesn't exist. 
    } else { 
        // Success! 
    }
    }else{ 
    echo "The email or username alrady exist";
    }
}

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
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

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'login' => 'Login',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
        );

        return $columns;
    }

    function column_login($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &dathangnhanh=2
        $actions = array(
            'edit' => sprintf('<a href="?page=networkers-franchisees-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<a href="?page=networkers-franchisees-delete&id=%s">%s</a>',  $item['id'], __('Delete', 'cltd_example')),
        );

        return sprintf('%s %s',
            $item['login'],
            $this->row_actions($actions)
        );

    }

    

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false));
    }

  
    private function table_data()
    {
        $args = array(
            'role' => "franchise",
            'orderby' => "display_name",
            'order' => "ASC"
          );
        $latest_posts = get_users( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                $first_name = get_user_meta( $post->ID, 'first_name', true );
                $last_name = get_user_meta( $post->ID, 'last_name', true );
                $phone = get_user_meta( $post->ID, 'phone', true );
                $data2 = array(
                    'id' => $post->ID,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'login' => $post->user_login,
                    'email' => $post->user_email,
                    'phone' => $phone,
                    );
                array_push($data, $data2);
            }
            
        }

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'login':
            case 'first_name':
            case 'last_name':
            case 'email':
            case 'phone':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
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