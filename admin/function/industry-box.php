<?php

function Industry_Box($industryselectedd = [], $multiple = true) {$industrys = Get_Industrys();

    if(!$industryselectedd)
        $industryselectedd = [];

    

    echo '<h3>Industry</h3>';

    if(count($industrys) > 1){

        $industrydisplay = ($multiple == false && count($industryselectedd) > 0) ? "display:none" : "display:block";
        echo '<div style="position:relative">';
            echo '<input id="industry" style="'.$industrydisplay.'" type="text" name="industry" onfocusout="cleansearchindustry()" onfocus="searchindustry()" onKeyUp="searchindustry()">';
            echo '<div class="hideinputindustry" style="display:block">';
                foreach($industrys as $post) {
                    $onclick = "addindustry(\"$post->ID\",\"$post->post_title\", " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div onclick='$onclick' class='hideinputinsideindustry'>$post->post_title</div>";
                }
            echo '</div>';
        echo '</div>';

        //Select all industry selected
        echo '<div id="industrys">';
            foreach($industryselectedd as $industryid) {
                $industry = Get_Industry($industryid);
                echo '<div class="industrydiv" style="width:100%;max-width:500px;display:flex">';
                    echo "<input class='inputindustry industryid' type='text' value='$industry->ID' name='industryid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputindustry' type='text' value='$industry->post_title' name='industry[]' style='width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;' readonly>";
                    $onclick = "removeindustry2(this, " . ($multiple ? 'true' : 'false') . ")";
                    echo "<div class='industryremove' onclick='$onclick'>X</div>";
                echo '</div>';
            }
        echo '</div>';

        //Messagem at the bottom of the industry Box
        if ($multiple == false) {
            // Single selection will check if it needs to be displayed or not.
            $industrydisplay = (count($industryselectedd) == 0) ? "display:block" : "display:none";
            echo '<p id="industrytext01" style="' . $industrydisplay . '">Please Search the industry</p>';
            echo '<p id="industrytext02" style="' . $industrydisplay . '"></p><br>';
        } else {
            echo '<p id="industrytext01">Please Search the industry(s)</p>';
            echo '<p id="industrytext02">You can add multiple industrys</p><br>';
        }

    }else{
        //User only have one option and select that automaticly
        echo '<div id="industrys">';
            foreach($industrys as $industry) {
                echo '<div class="industrydiv">';
                    echo "<input class='inputindustry industryid' type='text' value='$industry->ID' name='industryid[]' style='width:50px;display:none' readonly>";
                    echo "<input class='inputindustry' type='text' value='$industry->post_title' name='industry[]' style='width:100%;' readonly>";
                echo '</div>';
            }
        echo '</div><br>';
    }
}

function Add_Industry($id) {
    $industryid = $_POST["industryid"];
    foreach($industryid as $industry) {
        add_post_meta( $id, 'industry', $industry, false );
    }
}

function Update_Industry($id) {
    $industryid = $_POST["industryid"];
    delete_post_meta( $id, 'industry' );
    foreach($industryid as $industry) {
        add_post_meta( $id, 'industry', $industry, false );
    }
}
?>