<?php
    function ImageBox($imageid = null) {
        echo "<div id='imagediv'>";
            echo '<h3>Image:</h3>';
            echo '<input type="file" onchange="checkimage(this)" name="image_url" id="image_url" accept="image/png, image/gif, image/jpeg">';
            echo '<div id="imagecomment" style="font-size:16px;display:none;color:red;">Success</div>';
        if ( ! $imageid ) {
            echo "<div id='imagebox' style='width:100%;display:none;margin-top:20px'><img id='groupimg' src='' height='150'></div>";
            echo "<div id='imageremovebutton' onclick='removeimage()' class='smallbuttom' style='display:none;'>Remove</div>";
        }else{
            $url = get_post_meta( $imageid, '_wp_attached_file', true );
            echo "<div id='imagebox' style='width:100%;display:block;margin-top:20px'><img id='groupimg' src='/wp-content/uploads/$url' height='150'></div>";
            echo "<div id='imageremovebutton' onclick='removeimage()' class='smallbuttom' style='display:block;'>Remove</div>";
        }
        echo "</div>";
    }
?>