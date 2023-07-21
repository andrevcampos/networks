<?php
function member_logo($logoimageid = null) {
    ob_start();
?>
    <div id='logo_image_div'>
        <label><b>Company Banner Picture or Logo</b></label><br>
        <p style="margin-left:5px;margin-top:5px">Allowed types: png gif jpg jpeg. 20 MB limit</p>
        <input type="file" onchange="logoimagecheck(this)" name="logo_image_url" id="logo_image_url" accept="image/png, image/gif, image/jpeg">
        <div id="logo_image_comment" style="font-size:16px;display:none;color:red;">Success</div>
        <?php if (!$logoimageid){ ?>
            <div id='logo_imagebox' style='width:100%;display:none;margin-top:20px'><img id='logo_img' src='' height='150'></div>
            <div id='logo_image_remove_button' onclick='logoimageremove()' class='networkersbuttom bg-danger' style='display:none;'>Remove</div>
        <?php } else{
            $logourl = get_post_meta($logoimageid, '_wp_attached_file', true);
        ?>
            <div id='logo_imagebox' style='width:100%;display:block;margin-top:20px'><img id='logo_img' src='/wp-content/uploads/<?php echo $logourl; ?>' height='150'></div>
            <div id='logo_image_remove_button' onclick='logoimageremove()' class='networkersbuttom bg-danger' style='display:block;'>Remove</div>
        <?php } ?>   
        <input style="display:none" id="logo_original_image" type="text" name="logo_original_image" value="<?php echo $logoimageid; ?>"><br>
    </div>
<?php
    return ob_get_clean();
}

function Add_User_Logo($post_id) {

    //Check if have Logo Image
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
        add_post_meta( $post_id, 'logoimageid', $attach_id, true );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }
}

function Update_User_Logo($post_id) {

    $logo_original_image = $_POST["logo_original_image"];

    //Update image if have any change.
    if(!$logo_original_image){
        //Check if have Image
        if(file_exists($_FILES['logo_image_url']['tmp_name'][0])) {

            //remove the old post
            $imageid = get_post_meta( $post_id, 'logoimageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'logoimageid');

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
            add_post_meta( $post_id, 'logoimageid', $attach_id, true );

            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            wp_update_attachment_metadata( $attach_id, $attach_data );

        }else{
            //remove image 
            $imageid = get_post_meta( $post_id, 'logoimageid', true );
            wp_delete_attachment( $imageid );
            delete_post_meta($post_id, 'logoimageid');
        }
    }
}

?>