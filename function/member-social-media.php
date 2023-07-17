<?php
function member_social_media($socialmedia = []) {
    ob_start();
?>
    <div id='div_social_media'>
        <label>Social Media</label><br>
        <p style="margin-left:5px;margin-top:5px">Link all your company social media here.</p>
    
        <div id='social_media_box'>
            <?php if (!$socialmedia){ ?>
                <div class="socialmediaseciton">
                    <label class="d-block" style="margin:0px !important">Title</label>
                    <input class='d-block inputsocialmedia' type='text' name='socialmedia[]' style='width:calc(100% - 50px);margin-top:-5px'>
                    <label class="d-block">Link</label>
                    <input class='d-block inputsocialmedia' type='text' name='socialmedia[]' style='width:calc(100% - 50px);margin-top:-5px'>
                </div>
            <?php } else{
                $logourl = get_post_meta($imageid, '_wp_attached_file', true);
            ?>

            <?php } ?> 
            
        </div>
        <div class='networkersbuttom' onclick='newsocialmediainput()' >New Social Media</div>
    </div>
<?php
    return ob_get_clean();
}