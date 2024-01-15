<?php

function Referedby_Box($referedbyselectedd = [], $multiple = true) {

    if(!$referedbyselectedd)
        $referedbyselectedd = [];

    $members = Get_Members();

    echo '<h3>Refered by</h3>';

    $memberdisplay = (count($referedbyselectedd) > 0) ? "display:none" : "display:block";
    echo '<div style="position:relative">';
        echo '<input id="referedby" style="'.$memberdisplay.'" type="text" name="referedby" onfocusout="cleansearchreferedby()" onfocus="searchreferedby()" onKeyUp="searchreferedby()">';
        echo '<div class="hideinputreferedby" style="display:block">';
            foreach($members as $post) {
                $onclick = "addreferedby(\"$post->ID\",\"$post->post_title\", " . ($multiple ? 'true' : 'false') . ")";
                echo "<div onclick='$onclick' class='hideinputinsidereferedby'>$post->post_title</div>";
            }
        echo '</div>';
    echo '</div>';

    //Referedby selected
    echo '<div id="referedbys">';
        foreach($referedbyselectedd as $referedbyselected) {
            $member = Get_Group($referedbyselected);
            echo '<div class="referedbydiv" style="width:100%;max-width:500px;display:flex">';
                echo "<input class='inputreferedby referedbyid' type='text' value='$member->ID' name='referedbyid[]' style='width:50px;display:none' readonly>";
                echo "<input class='inputreferedby' type='text' value='$member->post_title' name='referedby[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                $onclick = "removereferedby2(this, " . ($multiple ? 'true' : 'false') . ")";
                echo "<div class='referedbyremove' onclick='$onclick'>X</div>";
            echo '</div>';
        }
    echo '</div>';

    //Messagem at the bottom of the referedby Box
    $referedbydisplay = (count($referedbyselectedd) > 0) ? "display:block" : "display:none";
    echo '<p id="referedbytext01" style="' . $referedbydisplay . '">Please Search the member</p>';
    echo '<p id="referedbytext02" style="' . $referedbydisplay . '"></p><br>';
    
}

function Add_Referedby($id) {
    $referedby = $_POST["referedbyid"];
    foreach($referedby as $referedbyid) {
        add_post_meta( $id, 'referedby', $referedbyid, false );
    }
}

function Update_Referedby($id) {
    $referedby = $_POST["referedbyid"];
    delete_post_meta( $id, 'referedby' );
    foreach($referedby as $referedbyid) {
        add_post_meta( $id, 'referedby', $referedbyid, false );
    }
}

?>