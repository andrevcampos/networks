<?php

function networkers_franchise_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'new.php'; 
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>New Franchise</h2>';
            echo '</div><br><br>';

            echo'
            <label>login:</label><br>
            <input id="login" type="text" name="login"><br><br>

            <label>Password:</label><br>
            <input id="password" type="text" name="password"><br><br>
            <div style="margin-top:-10px;background-color:#b5c5e4;color:black" class="networkersbuttom" onclick="generatepassword()" >Generate Password</div><br>

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
            regioninput($regions, true);

            echo "<div class='networkersbuttom' onclick='newfranchise()' >Create</div>";
        echo "</form>";
    echo "</div>";
   
}

?>