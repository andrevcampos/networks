<?php

function networkers_facilitator_new() {

wp_enqueue_media();
include '../../../../../wp-load.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

$plugin_url = plugin_dir_url( __FILE__ );
$url = $plugin_url . 'new.php';

$imagesearch = plugins_url() . '/thenetworks/public/img/searchbutton.png';

global $wpdb;
echo '<div style="display:block" id="networkersbox" class="networkersbox">';
    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
        echo '<div class="wrap">';
            echo '<h2>New Facilitator</h2>';
        echo '</div><br><br>';

        ?>

        <div class="memberlogobox">

            <h2 style="font-size:22px"><b>Profile Information</b></h2><br>

            <label>Full Name:<spam style="color:red"> *</spam></label><br>
            <input id="Name" name="Name" type="text"><br><br>

            <label>Email:</label><br>
            <input id="email" name="email" type="text"><br><br>

            <label>Phone:</label><br>
            <div id="memberphone">
                <input class="phone" name="phone" type="text"><br>
            </div>
            <br>
        </div><br>

        <div class="memberlogobox">
            <?php
            ImageBox();
            ?>
        </div><br>
        <?php

        echo '<label>Description:</label>';
        echo '<div style="max-width:100%">';
            wp_editor( $my_option , 'my_option', array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_name' => 'my_option',
                'editor_class'  => 'my_custom_class',
                'textarea_rows' => 10
            ) );
        echo '</div">';

        

        echo "<br><div class='networkersbuttom' onclick='newfacilitator()' >Create</div>";
    echo "</form>";
echo "</div>";
echo "<div style='height:200px'></div>";
}

?>