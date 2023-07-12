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

echo '<div id="popupRemoveBox" style="display:none" class="wrap">';
    echo '<h2 id="popupRemoveTitle">Title</h2>';
    echo '<h3 id="popupRemoveName" class="messagealert">Name</h3>';
    echo '<p>Type DELETE to confirm</p>';
    echo '<input id="popupRemoveImput" type="text" name="popupRemoveImput" onKeyUp="PopupRemoveCheck()">';
    echo "<form id='popupRemoveForm' action='' method='post'>";
        echo '<input id="popupRemoveID" type="text" name="popupRemoveID" style="display:none" value="">';
        echo "<button type='submit' id='popupRemoveButton' style='display:none;cursor:pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px'>Remove</button>";
    echo '</form>';
    echo "<div id='popupRemoveGoback' onclick='PopupRemoveGoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
echo '</div>';



?>