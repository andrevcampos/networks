<?php
function member_logo($logoimageid = null) {
    ob_start();
?>
    <div id='logo_image_div'>
        <label>Company Banner Picture or Logo</label><br>
        <p style="margin-left:5px;margin-top:5px">Upload your company's logo here</p>
        <input type="file" onchange="logoimagecheck(this)" name="logo_image_url" id="logo_image_url" accept="image/png, image/gif, image/jpeg">
        <div id="logo_image_comment" style="font-size:16px;display:none;color:red;">Success</div>
        <?php if (!$imageid){ ?>
            <div id='logo_imagebox' style='width:100%;display:none;margin-top:20px'><img id='logo_img' src='' height='150'></div>
            <div id='logo_image_remove_button' onclick='logoimageremove()' class='networkersbuttom bg-danger' style='display:none;'>Remove</div>
        <?php } else{
            $logourl = get_post_meta($imageid, '_wp_attached_file', true);
        ?>
            <div id='logo_imagebox' style='width:100%;display:block;margin-top:20px'><img id='logo_img' src='/wp-content/uploads/<?php echo $logourl; ?>' height='150'></div>
            <div id='logo_image_remove_button' onclick='logoimageremove()' class='networkersbuttom bg-danger' style='display:block;'>Remove</div>
        <?php } ?>   
        <input style="display:none" id="logo_original_image" type="text" name="originalimage" value="<?php echo $logoimageid; ?>"><br>
    </div>
<?php
    return ob_get_clean();
}

function member_logo_new($post_id) {

    if(file_exists($_FILES['logo_image_url']['tmp_name'][0])) {

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents( $_FILES["logo_image_url"]['tmp_name'] );

        $filename = basename( $_FILES["logo_image_url"]["name"] );

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
        add_post_meta( $post_id, 'logo', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );

    }
}

function member_logo_update($post_id) {

    $originalimage = $_POST["originalimage"];
    if($originalimage){
        $originalurl = get_post_meta( $originalimage, '_wp_attached_file', true );
    }

    //Update image if have any change.
    if(!$originalimage){
        //Check if have Image
        if(file_exists($_FILES['logo_image_url']['tmp_name'][0])) {

            //remove the old post
            $imageid = get_post_meta( $post_id, 'imageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'imageid');

            $upload_dir = wp_upload_dir();

            $image_data = file_get_contents( $_FILES["logo_image_url"]['tmp_name'] );

            $filename = basename( $_FILES["logo_image_url"]["name"] );

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
            add_post_meta( $post_id, 'imageid', $attach_id, true );

            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            wp_update_attachment_metadata( $attach_id, $attach_data );

        }else{
            //remove image 
            $imageid = get_post_meta( $post_id, 'imageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'imageid');
        }
    }
}

?>