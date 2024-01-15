<?php
function networkers_franchise_update() {

    include '../../../../../wp-load.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $editurl = $plugin_url . 'update.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $userid = $_GET['id'];
    $user = get_user_by('id', $userid);
    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );
    $region = get_user_meta( $user->ID, 'region', true );
    $phone = get_user_meta( $user->ID, 'phone', true );
    $regions = get_user_meta( $user->ID, 'region', false );

    $login = $user->user_login;
    $email = $user->user_email;

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$editurl' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>Update Franchise</h2>';
            echo '</div><br><br>';

            echo "<input id='userid' type='text' name='userid' value='$userid' style='display:none'>";

            echo "<label>LOGIN:</label><br>";
            echo "<input id='login' type='text' name='login' value='$login' style='background-color:#b5c5e4;font-size:18px' readonly><br><br>";

            echo "<label>PASSWORD:</label><br>";
            echo "<div id='setnewpasswordbutton' style='margin-top:10px;background-color:#b5c5e4;color:black' class='networkersbuttom' onclick='setnewpassword()' >Set New Password</div>";
            echo "<input id='password' type='text' name='password' style='display:none'>";
            echo "<div id='generatepasswordbutton' style='background-color:#b5c5e4;color:black;display:none' class='networkersbuttom' onclick='generatepassword()' >Generate Password</div>";
            echo "<p id='ppassword' style='display:none;margin-top:-20px;margin-bottom:20px'>If the password field is left empty, the old password will be retained.</p>" ;
            echo "<br>";
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
            regioninput($regions, true);

            echo "<div class='networkersbuttom' onclick='updatefranchise()' >Update Franchise</div>";

        echo '</form>';
    echo '</div>';
}

?>