<?php

function Referedby_Box($referedbyselectedd = "") {

    if(!$referedbyselectedd)
        $referedbyselectedd = "";

    $members = Get_Members();

    echo '<h3>Refered by</h3>';

    if(count($members) > 0){

        $memberdisplay = ($referedbyselectedd != "") ? "display:none" : "display:block";
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
            if($referedbyselectedd != ""){
                $member = Get_Member($referedbyselectedd);
                echo '<div class="referedbydiv" style="width:100%;max-width:500px;display:flex">';
                    echo "<input class='inputreferedby referedbyid' type='text' value='$member->ID' name='referedbyid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputreferedby' type='text' value='$member->post_title' name='referedby[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                    $onclick = "removereferedby2(this, " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div class='referedbyremove' onclick='$onclick'>X</div>";
                echo '</div>';
            }
        echo '</div>';

        //Messagem at the bottom of the referedby Box
        $referedbydisplay = ($referedbyselectedd == "") ? "display:block" : "display:none";
        echo '<p id="referedbytext01" style="' . $referedbydisplay . '">Please Search the member</p>';
        echo '<p id="referedbytext02" style="' . $referedbydisplay . '"></p><br>';
        

    }
}

// function Add_Referedby($id) {
//     $industryid = $_POST["referedbyid"];
//     foreach($industryid as $industry) {
//         add_post_meta( $id, 'industry', $industry, false );
//     }
// }

// function Update_Referedby($id) {
//     $industryid = $_POST["referedbyid"];
//     delete_post_meta( $id, 'referedby' );
//     foreach($industryid as $industry) {
//         add_post_meta( $id, 'referedby', $member, false );
//     }
// }

?>