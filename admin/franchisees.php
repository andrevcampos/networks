<?php
function my_menu_networkers_franchisees() {

// $plugin_url = plugin_dir_url( __FILE__ );
// wp_enqueue_style( 'css', $plugin_url . '/css/admin.css' );
// wp_enqueue_script( 'js', $plugin_url . '/js/js.js' );

echo '<div class="wrap">';
    echo '<h2>Franchise</h2>';
echo '</div><br>';
}

function networkers_franchisees_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'franchisees-new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    

    echo "<form id='myForm' action='$url' method='post'>";
    echo '
    <div class="memberbox">
        <div class="wrap">
            <h2>New Franchise</h2>
        </div><br>

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

        <label>Regions:</label><br>
        <input id="region" type="text" name="region">
        <p>Please select the region(s) this franchise have permition</p><br><br>
    ';

    echo "<div style='margin-top:-10px' class='memberbuttom' onclick='newfranchise(\"$url\")' >Register</div>";
    echo "
        </div>
        </form>
    ";
    
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
?>