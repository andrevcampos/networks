<?php

function network_industry_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'new.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>New Industry</h2>';
            echo '</div><br><br>';

            echo '<label>Name:</label><br>';
            echo '<input id="name" type="text" name="name"><br><br>';

            echo "<div class='networkersbuttom' onclick='newindustry()' >Create</div>";
        echo "</form>";
    echo "</div>";
   
}

?>