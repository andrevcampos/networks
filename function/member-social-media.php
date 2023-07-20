<?php
function member_social_media($socialmedias = []) {
    ob_start();
?>
    <div id='div_social_media'>
        <label><b>Social Media</b></label><br>
        <p style="margin-left:5px;margin-top:5px">Link all your company social media here.</p>
    
        <div id='social_media_box'>
            <?php if ($socialmedias){ 
                foreach($socialmedias as $socialmedia) {    
            ?>
                <div class="socialmediaseciton">
                    <input class='d-block socialmediatitle' placeholder='Title: (Ex: Website, Facebook, Instagram)' value='<?php echo $socialmedia->title;?>' type='text' name='socialmediatitle[]' style='width:calc(100% - 50px);margin-top:5px'>
                    <input class='d-block socialmedialink' placeholder="Link: (Ex: https://your-website-here)" value='<?php echo $socialmedia->link;?>' type='text' name='socialmedialink[]' style='width:calc(100% - 50px);margin-top:5px'>
                    <div class="smremovebutton" onclick="socialmediaremove(this)"><spam>X</spam></div>
                </div>
            <?php }
            }
            ?> 
        </div>
        <div class='networkersbuttom' onclick='newsocialmediainput()' >New Social Media</div>
    </div>
<?php
    return ob_get_clean();
}

function Add_Social_Media($id) {
    $socialmediatitle = $_POST["socialmediatitle"];
    $socialmedialink = $_POST["socialmedialink"];
    if($socialmediatitle){
        for ($x = 0; $x < count($socialmediatitle); $x++) {
            if($socialmediatitle[$x] && $socialmedialink[$x]){
                $array = array("$socialmediatitle[$x]","$socialmedialink[$x]");
                $socialmedia = json_encode($array); 
                add_post_meta( $id, 'socialmedia', $socialmedia, false);
            }
        }
    }
}

function Update_Social_Media($id) {
    $socialmediatitle = $_POST["socialmediatitle"];
    $socialmedialink = $_POST["socialmedialink"];
    delete_user_meta( $id, 'socialmedia' );
    if($socialmediatitle){
        for ($x = 0; $x < count($socialmediatitle); $x++) {
            if($socialmediatitle[$x] && $socialmedialink[$x]){
                $array = array("$socialmediatitle[$x]","$socialmedialink[$x]");
                $socialmedia = json_encode($array); 
                add_post_meta( $id, 'socialmedia', $socialmedia, false);
            }
        }
    }
}