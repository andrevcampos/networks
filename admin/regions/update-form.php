<?php

function networkers_region_update() {


    include '../../../../../wp-load.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $editurl = $plugin_url . 'update.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $regionid = $_GET['id'];
    $region = get_post($regionid);
    $title = $region->post_title;
    $regionDescription = base64_decode(get_post_meta( $regionid, 'description', true ));
    $regionimageid = get_post_meta( $regionid, 'regionimageid', true );

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$editurl' method='post' enctype='multipart/form-data'>";
            echo '<div class="wrap">';
                echo '<h2>Edit Region</h2>';
            echo '</div><br><br>';
            echo '<input id="editregionid" type="text" name="editregionid" readonly style="display:none" value="'.$regionid.'">';
            echo '<input id="oldregionname" type="text" name="oldregionname" readonly style="display:none" value="'.$title.'">';
            echo '<label>Name:</label><br>';
            echo '<input id="name" type="text" name="editregionname" value="'.$title.'">';
            ?>

            <br><br>
            <div class="memberlogobox">
                <?php
                $logoHtml = Region_Image_Box($regionimageid);
                echo $logoHtml;
                ?>
            </div>

            <br><br>
            <label><b>Description</b></label>
            <div style="max-width:100%;margin-top:-20px">
            <?php wp_editor( $regionDescription , 'regionDescription', array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'textarea_name' => 'regionDescription',
                    'editor_class'  => 'my_custom_class',
                    'textarea_rows' => 10
                ) ); ?>
            </div>

            <?php

            echo "<br><br><div class='networkersbuttom' onclick='newregion()' >Update</div>";
        echo '</form>';
    echo '</div>';
    
}

?>