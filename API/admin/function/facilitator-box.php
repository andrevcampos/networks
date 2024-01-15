<?php

function Facilitator_Box($facilitatorselectedd = "") {

    if(!$facilitatorselectedd)
        $facilitatorselectedd = "";

    $facilitators = Get_Facilitators();

    echo '<h3>Facilitator</h3>';

    if(count($facilitators) > 0){

        $facilitatordisplay = ($facilitatorselectedd != "") ? "display:none" : "display:block";
        echo '<div style="position:relative">';
            echo '<input id="facilitator" style="'.$facilitatordisplay.'" type="text" name="facilitator" onfocusout="cleansearchfacilitator()" onfocus="searchfacilitator()" onKeyUp="searchfacilitator()">';
            echo '<div class="hideinputfacilitator" style="display:block">';
                foreach($facilitators as $post) {
                    $facilitator = Get_Facilitator($post);
                    $fullname = $facilitator->name;
                    $onclick = "addfacilitator(\"$facilitator->ID\",\"$fullname\", " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div onclick='$onclick' class='hideinputinsidefacilitator'>$fullname</div>";
                }
            echo '</div>';
        echo '</div>';

        //facilitator selected
        echo '<div id="facilitators">';
            if($facilitatorselectedd != ""){
                $facilitator = Get_Facilitator($facilitatorselectedd);
                echo '<div class="facilitatordiv" style="width:100%;max-width:500px;display:flex">';
                    echo "<input class='inputfacilitator facilitatorid' type='text' value='$facilitator->ID' name='facilitatorid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputfacilitator' type='text' value='$facilitator->name' name='facilitator[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                    $onclick = "removefacilitator2(this, " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div class='facilitatorremove' onclick='$onclick'>X</div>";
                echo '</div>';
            }
        echo '</div>';

        //Messagem at the bottom of the facilitator Box
        $facilitatordisplay = ($facilitatorselectedd == "") ? "display:block" : "display:none";
        echo '<p id="facilitatortext01" style="' . $facilitatordisplay . '">Please Search the member</p>';
        echo '<p id="facilitatortext02" style="' . $facilitatordisplay . '"></p><br>';
        

    }
}

function Add_Facilitator($id) {
    $facilitatorid = $_POST["facilitatorid"];
    add_post_meta( $id, 'facilitator', $facilitatorid, true );
}

function Update_Facilitator($id) {
    $facilitatorid = $_POST["facilitatorid"];
    delete_post_meta( $id, 'facilitator' );
    add_post_meta( $id, 'facilitator', $facilitatorid, true );
}

?>