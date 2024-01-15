<?php


function Region_Image_Box($regionimageid = null) {
    echo "<div id='regionimagediv'>";
        echo '<h3>Region Image:</h3>';
        echo '<input type="file" onchange="checkregionimage(this)" name="regionimage_url" id="regionimage_url" accept="image/png, image/gif, image/jpeg">';
        echo '<div id="regionimagecomment" style="font-size:16px;display:none;color:red;">Success</div>';
    if ( ! $regionimageid ) {
        echo "<div id='regionimagebox' style='width:100%;display:none;margin-top:20px'><img id='regionimg' src='' height='150'></div>";
        echo "<div id='regionimageremovebutton' onclick='removeregionimage()' class='smallbuttom' style='display:none;'>Remove</div>";
    }else{
        $regionurl = get_post_meta( $regionimageid, '_wp_attached_file', true );
        echo "<div id='regionimagebox' style='width:100%;display:block;margin-top:20px'><img id='regionimg' src='/wp-content/uploads/$regionurl' height='150'></div>";
        echo "<div id='regionimageremovebutton' onclick='removeregionimage()' class='smallbuttom' style='display:block;'>Remove</div>";
    }
        echo '<input style="display:none" id="originalregionimage" type="text" name="originalregionimage" value="'.$regionimageid.'"><br>';
    echo "</div>";
}

function Add_Region_Image($id) {
    //Check if have User Image
    if(file_exists($_FILES['regionimage_url']['tmp_name'][0])) {
        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["regionimage_url"]['tmp_name'] );

        $filename = basename( $_FILES["regionimage_url"]["name"] );

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
        add_post_meta( $id, 'regionimageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }
}

function Update_Region_Image($post_id) {

    $originaluserimage = $_POST["originalregionimage"];
    //if member made any changes to the image, it will change the orginal value to empty.
    //Update image if member made any changes.
    if(!$originaluserimage){
        //Check if have Image
        if(file_exists($_FILES['regionimage_url']['tmp_name'][0])) {
            //remove the old post
            $imageid = get_post_meta( $post_id, 'regionimageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'regionimageid');

            $upload_dir = wp_upload_dir();

            $image_data = file_get_contents( $_FILES["regionimage_url"]['tmp_name'] );

            $filename = basename( $_FILES["regionimage_url"]["name"] );

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
            add_post_meta( $post_id, 'regionimageid', $attach_id, true );

            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            wp_update_attachment_metadata( $attach_id, $attach_data );

        }else{
            //remove image 
            $imageid = get_post_meta( $post_id, 'regionimageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'regionimageid');
        }
    }
}

function Delete_Region_Image($post_id) {
    $imageid = get_post_meta( $post_id, 'regionimageid', true );
    if($imageid){
        wp_delete_attachment( $imageid );
    }
}

?>