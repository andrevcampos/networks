<?php

function Group_Box($groupselectedd = [], $multiple = true) {

    if(!$groupselectedd)
        $groupselectedd = [];

    $groups = Get_Groups();

    echo '<h3>Groups</h3>';

    //check if user have multiple group options
    if(count($groups) > 1){
        //check if needs to display in case of single group and alread selected.
        $groupdisplay = ($multiple == false && count($groupselectedd) > 0) ? "display:none" : "display:block";
        echo '<div style="position:relative">';
            echo '<input id="group" style="'.$groupdisplay.'" type="text" name="group" onfocusout="cleansearchgroup()" onfocus="searchgroup()" onKeyUp="searchgroup()">';
            echo '<div class="hideinputgroup" style="display:block">';
                foreach($groups as $post) {
                    $onclick = "addgroup(\"$post->ID\",\"$post->post_title\", " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div onclick='$onclick' class='hideinputinsidegroup'>$post->post_title</div>";
                }
            echo '</div>';
        echo '</div>';

        //Select all group selected
        echo '<div id="groups">';
        foreach($groupselectedd as $groupid) {
            $group = Get_Group($groupid);
            echo '<div class="groupdiv" style="width:100%;max-width:500px;display:flex">';
                echo "<input class='inputgroup groupid' type='text' value='$group->ID' name='groupid[]' style='width:50px;display:none' readonly>";
                echo "<input class='inputgroup' type='text' value='$group->post_title' name='group[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                $onclick = "removegroup2(this, " . ($multiple ? 'true' : 'false') . ")";
                echo "<div class='groupremove' onclick='$onclick'>X</div>";
            echo '</div>';
        }
        echo '</div>';

        //Messagem at the bottom of the group Box
        if ($multiple == false) {
            // Single selection will check if it needs to be displayed or not.
            $groupdisplay = (count($groupselectedd) == 0) ? "display:block" : "display:none";
            echo '<p id="grouptext01" style="' . $groupdisplay . '">Please Search the group</p>';
            echo '<p id="grouptext02" style="' . $groupdisplay . '"></p><br>';
        } else {
            echo '<p id="grouptext01">Please Search the group(s)</p>';
            echo '<p id="grouptext02">You can add multiple groups</p><br>';
        }

    }else{
        //User only have one option and select that automaticly
        echo '<div id="groups">';
            foreach($groups as $group) {
                echo '<div class="groupdiv">';
                    echo "<input class='inputgroup groupid' type='text' value='$group->ID' name='groupid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputgroup' type='text' value='$group->post_title' name='group[]' style='width:100%;' readonly>";
                echo '</div>';
            }
        echo '</div><br>';
    }



}

function Add_Group($id) {
    $groupid = $_POST["groupid"];
    foreach($groupid as $group) {
        add_post_meta( $id, 'group', $group, false);
    }
}

function Update_Group($id) {
    $groupid = $_POST["groupid"];
    delete_post_meta( $id, 'group' );
    foreach($groupid as $group) {
        add_post_meta( $id, 'group', $group, false);
    }
}

?>