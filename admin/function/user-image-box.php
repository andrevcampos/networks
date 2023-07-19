<?php
    function User_Image_Box($userimageid = null) {
        echo "<div id='userimagediv'>";
            echo '<h3>Member Image:</h3>';
            echo '<input type="file" onchange="checkuserimage(this)" name="userimage_url" id="userimage_url" accept="image/png, image/gif, image/jpeg">';
            echo '<div id="userimagecomment" style="font-size:16px;display:none;color:red;">Success</div>';
        if ( ! $userimageid ) {
            echo "<div id='userimagebox' style='width:100%;display:none;margin-top:20px'><img id='userimg' src='' height='150'></div>";
            echo "<div id='userimageremovebutton' onclick='removeuserimage()' class='smallbuttom' style='display:none;'>Remove</div>";
        }else{
            $userurl = get_post_meta( $userimageid, '_wp_attached_file', true );
            echo "<div id='userimagebox' style='width:100%;display:block;margin-top:20px'><img id='userimg' src='/wp-content/uploads/$userurl' height='150'></div>";
            echo "<div id='userimageremovebutton' onclick='removeuserimage()' class='smallbuttom' style='display:block;'>Remove</div>";
        }
            echo '<input style="display:none" id="originaluserimage" type="text" name="originaluserimage" value="'.$userimageid.'"><br>';
        echo "</div>";
    }
?>