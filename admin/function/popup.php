<?php

$message = $_GET["message"];
$messagetitle = $_GET["messagetitle"];

$display = "display:none;";
if($message){$display = "display:block;";}

echo "<div id='popupbox' style='$display'>";

    echo '<div class="wrap">';
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
    echo '</div><br>';

    echo "<div id='message' class='messagealert'>$message</div><br>";

    echo "<div id='popupbutton' style='margin-top:20px' class='memberbuttom' onclick='popupbutton()' >Go Back</div>";

echo '</div>';
?>