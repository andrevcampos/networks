<?php

function network_region_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'new.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";
            echo '<div class="wrap">';
                echo '<h2>New Region</h2>';
            echo '</div><br><br>';

            echo '<label>Name:</label><br>';
            echo '<input id="name" type="text" name="name"><br><br>';
            ?>

            <br><br>
            <div class="memberlogobox">
                <?php
                Region_Image_Box();
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
            echo "<div class='networkersbuttom' onclick='newregion()' >Create</div>";
        echo "</form>";
    echo "</div>";
   
}

?>