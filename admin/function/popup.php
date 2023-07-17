<?php

$message = $_GET["message"];
$messagetitle = $_GET["messagetitle"];

$display = "display:none;";
if($message){$display = "display:block;";}

echo "<div id='popupbox' style='$display'>";
    echo '<div class="wrap">';
        echo "<h2 id='messagetitle'>$messagetitle</h2>";
    echo '</div><br><br>';
    echo "<div id='message' class='messagealert'>$message</div><br>";
    echo "<br><div id='popupbutton' class='networkersbuttom' onclick='popupbutton()' >Go Back</div>";
echo '</div>';

echo '<div id="popupRemoveBox" style="display:none" class="wrap">';
    echo '<h2 id="popupRemoveTitle">Title</h2><br>';
    echo '<h3 id="popupRemoveName" class="messagealert messagealert-red">Name</h3>';
    echo '<p>Type DELETE to confirm</p>';
    echo '<input id="popupRemoveImput" type="text" name="popupRemoveImput" onKeyUp="PopupRemoveCheck()">';
    echo "<form id='popupRemoveForm' action='' method='post'>";
        echo '<input id="popupRemoveID" type="text" name="popupRemoveID" style="display:none" value="">';
        echo "<button type='submit' id='popupRemoveButton' style='display:none;cursor:pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px'>Remove</button>";
    echo '</form>';
    echo "<br><div id='popupRemoveGoback' onclick='PopupRemoveGoback()' class='networkersbuttom'>Go Back</div>";
echo '</div>';



?>