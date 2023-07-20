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

function Add_User_Image($id) {
    //Check if have User Image
    if(file_exists($_FILES['userimage_url']['tmp_name'][0])) {
        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["userimage_url"]['tmp_name'] );

        $filename = basename( $_FILES["userimage_url"]["name"] );

        if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
        }
        else {
        $file = $upload_dir['basedir'] . '/' . $filename;
        }

        file_put_contents( $file, $image_data );

        $wp_filetype = wp_check_filetype( $filename, null );

        $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment, $file );

        //Add image ulr to postmeta
        add_post_meta( $id, 'userimageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }
}


?>