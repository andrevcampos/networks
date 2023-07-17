<?php

function networkers_industry_update() {


    include '../../../../../wp-load.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $editurl = $plugin_url . 'update.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );
    
    //POPUP MESSAGE BOX
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';

    $industryid = $_GET['id'];
    $industry = get_post($industryid);
    $title = $industry->post_title;

    echo '<div style="display:block" id="networkersbox" class="networkersbox">';
        echo "<form id='myForm' action='$editurl' method='post'>";
            echo '<div class="wrap">';
                echo '<h2>Edit Industry</h2>';
            echo '</div><br><br>';
            echo '<input id="editregionid" type="text" name="editregionid" readonly style="display:none" value="'.$industryid.'">';
            echo '<label>Name:</label><br>';
            echo '<input id="name" type="text" name="editregionname" value="'.$title.'">';
            echo "<br><br><div class='networkersbuttom' onclick='newregion()' >Update</div>";
        echo '</form>';
    echo '</div>';
    
}

?>