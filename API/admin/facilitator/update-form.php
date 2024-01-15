<?php

function networkers_facilitator_update() {

    wp_enqueue_media();
    include '../../../../../wp-load.php';
    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'update.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

    global $wpdb;

    $facilitatorid = $_GET['id'];
    $facilitator = get_post($facilitatorid);
    $title = $facilitator->post_title;
    $email = get_post_meta( $facilitatorid, 'email', true );
    $phone = get_post_meta( $facilitatorid, 'phone', true );
    $description2 = get_post_meta( $facilitator->ID, 'description', true );
    $description = base64_decode($description2);
    $imageid = get_post_meta( $facilitatorid, 'imageid', true );
    


    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
            echo '<div class="wrap">';
                echo '<h2>Edit Facilitator</h2>';
            echo '</div><br><br>';

            ?>

            <div class="memberlogobox">
    
                <h2 style="font-size:22px"><b>Profile Information</b></h2><br>

                <input style='display:none' id='orginalname' type='text' name='orginalname' value='<?php echo $title; ?>'>
                <input style='display:none' id='postid' type='text' name='postid' value="<?php echo $facilitatorid; ?>">
    
                <label>Full Name:<spam style="color:red"> *</spam></label><br>
                <input id="Name" name="Name" type="text" value="<?php echo $title; ?>"><br><br>
                
    
                <label>Email:</label><br>
                <input id="email" name="email" type="text" value="<?php echo $email; ?>"><br><br>
    
                <label>Phone:</label><br>
                <div id="memberphone">
                    <input class="phone" name="phone" type="text" value="<?php echo $phone; ?>"><br>
                </div>
                <br>
            </div><br>
    
            <div class="memberlogobox">
                <?php
                ImageBox($imageid);
                ?>
            </div><br>
            <?php
    
            echo '<label>Description:</label>';
            echo '<div style="max-width:100%">';
                wp_editor( $description , 'my_option', array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'textarea_name' => 'my_option',
                    'editor_class'  => 'my_custom_class',
                    'textarea_rows' => 10
                ) );
            echo '</div">';

            echo "<br><div class='networkersbuttom' onclick='newfacilitator()' >Update</div>";
        echo "</form>";
    echo '</div">';
   
}

?>