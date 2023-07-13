<?php

function network_region_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'new.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    
    if(!$message){
        echo '<div style="display:block" id="memberbox" class="memberbox">';
    }else{
        echo '<div style="display:none" id="memberbox" class="memberbox">';
    }
    
        echo "<form id='myForm' action='$url' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>New Region</h2>';
            echo '</div><br>';

            echo '<label>Name:</label><br>';
            echo '<input id="name" type="text" name="name"><br><br>';

            echo "<div style='margin-top:-10px' class='memberbuttom' onclick='newregion(\"$url\")' >Create</div>";
        echo "</form>";
    echo "</div>";

    if(!$message){
        echo '<div id="regionmessage" style="display:none" >';
    }else{
        echo '<div id="regionmessage" style="display:block" >';
    }
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
        echo "<h4 id='message'>$message</h4>";
        echo "<div id='buttongoback' onclick='regiongoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    echo '</div>';
   
}

?>