<?php

function networkers_email() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'updatestatus.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $user_role = Get_User_Role();

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Email Settings</h2>';
        echo '<br><br>';
        ?>
        <a style='text-decoration: none;' href='/wp-admin/admin.php?page=network-email-status-scheduled'><div style="margin-top:0px; width:300px" class='networkersbuttom'>Scheduled Status</div></a><br>
        <a style='text-decoration: none;' href='/wp-admin/admin.php?page=network-email-status-active-visitor'><div style="margin-top:0px; width:300px" class='networkersbuttom'>Active Visitor Status</div></a><br>
        <a style='text-decoration: none;' href='/wp-admin/admin.php?page=network-email-status-end-trial-visitor'><div style="margin-top:0px; width:300px" class='networkersbuttom'>End Trial Visitor Status</div></a><br>
        <a style='text-decoration: none;' href='/wp-admin/admin.php?page=network-email-status-active-member'><div style="margin-top:0px; width:300px" class='networkersbuttom'>Active Member Status</div></a><br>
        <a style='text-decoration: none;' href='/wp-admin/admin.php?page=network-email-status-past-member'><div style="margin-top:0px; width:300px" class='networkersbuttom'>Past Member Status</div></a><br>
        <?php
    echo '</div>';

}

function networkers_email_status_scheduled() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'status-update.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    
    $args = array(
        'post_type'      => 'network-statusemail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_id = $posts[0]->ID;
    $post_content = get_post_meta( $post_id, 'email', true );
    $post_title = $posts[0]->post_title;
    $statusEmail = base64_decode($post_content);

    $user_role = Get_User_Role();

    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Status Change Email</h2>';
    echo '</div>';
    echo '<br><br>';
    echo '<label >Title:</label><br>';
    echo "<input id='title' type='text' name='title' value='$post_title'>";
    echo "<input style='display:none' id='stype' type='text' name='stype' value='network-statusemail'>";
    echo '<br><br>';
    echo '<p>Use the following keys to customise your email.</p>';
    echo '<p>{{name}} {{businessname}} {{groupinfo}} {{status}}</p>';
    echo '<div style="max-width:600px;margin-top:-20px">';
        $escaped_description = html_entity_decode($statusEmail);
        $escaped_description = stripslashes($escaped_description);
        $settings =   array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false,
            'textarea_name' => 'statusEmail',
            'textarea_rows' => get_option('default_post_edit_rows', 10),
            'editor_css' => '',
            'editor_class' => '', 
        );
        wp_editor( $escaped_description, 'statusEmail', $settings );
    echo '</div>';

    echo '<br><br>';
    
    ?>

    <div style="display:flex">
        <button style="margin-right: 10px; margin-top: 0px;border-width:0px" class='networkersbuttom' type="submit">Update Email</button>
    </div>

    </form>

    
    
    <?php
    $title = $post_title;
    $message = $escaped_description;
    $name = 'XXXXXXXXX';
    $business = '';
    $status = 'Active Member';
    $emailContent = email_model($title, $message, $name, $business, $status);
    echo $emailContent;

}



function networkers_email_status_active_visitor() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'status-update.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    
    $args = array(
        'post_type'      => 'network-avmail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_id = $posts[0]->ID;
    $post_content = get_post_meta( $post_id, 'email', true );
    $post_title = $posts[0]->post_title;
    $statusEmail = base64_decode($post_content);

    $user_role = Get_User_Role();

    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Active Visitor Email</h2>';
    echo '</div>';
    echo '<br><br>';
    echo '<label >Title:</label><br>';
    echo "<input id='title' type='text' name='title' value='$post_title'>";
    echo "<input style='display:none' id='stype' type='text' name='stype' value='network-avmail'>";
    echo '<br><br>';
    echo '<p>Use the following keys to customise your email.</p>';
    echo '<p>{{name}} {{businessname}} {{groupinfo}} {{status}}</p>';
    echo '<div style="max-width:600px;margin-top:-20px">';

        $escaped_description = html_entity_decode($statusEmail);
        $escaped_description = stripslashes($escaped_description);
        $settings =   array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false,
            'textarea_name' => 'statusEmail',
            'textarea_rows' => get_option('default_post_edit_rows', 10),
            'editor_css' => '',
            'editor_class' => '', 
        );
        wp_editor( $escaped_description, 'statusEmail', $settings );
    echo '</div>';

    echo '<br><br>';
    
    ?>

    <div style="display:flex">
        <button style="margin-right: 10px; margin-top: 0px;border-width:0px" class='networkersbuttom' type="submit">Update Email</button>
    </div>

    </form>

    <?php
    $title = $post_title;
    $message = $escaped_description;
    $name = 'XXXXXXXXX';
    $business = '';
    $status = 'Active Member';
    $emailContent = email_model($title, $message, $name, $business, $status);
    echo $emailContent;

}

function networkers_email_status_end_trial_visitor() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'status-update.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    
    $args = array(
        'post_type'      => 'network-etvmail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_id = $posts[0]->ID;
    $post_content = get_post_meta( $post_id, 'email', true );
    $post_title = $posts[0]->post_title;
    $statusEmail = base64_decode($post_content);

    $user_role = Get_User_Role();

    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Active Visitor Email</h2>';
    echo '</div>';
    echo '<br><br>';
    echo '<label >Title:</label><br>';
    echo "<input id='title' type='text' name='title' value='$post_title'>";
    echo "<input style='display:none' id='stype' type='text' name='stype' value='network-etvmail'>";
    echo '<br><br>';
    echo '<p>Use the following keys to customise your email.</p>';
    echo '<p>{{name}} {{businessname}} {{groupinfo}} {{status}}</p>';
    echo '<div style="max-width:600px;margin-top:-20px">';

        $escaped_description = html_entity_decode($statusEmail);
        $escaped_description = stripslashes($escaped_description);
        $settings =   array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false,
            'textarea_name' => 'statusEmail',
            'textarea_rows' => get_option('default_post_edit_rows', 10),
            'editor_css' => '',
            'editor_class' => '', 
        );
        wp_editor( $escaped_description, 'statusEmail', $settings );
    echo '</div>';

    echo '<br><br>';
    
    ?>

    <div style="display:flex">
        <button style="margin-right: 10px; margin-top: 0px;border-width:0px" class='networkersbuttom' type="submit">Update Email</button>
    </div>

    </form>

    <?php
    $title = $post_title;
    $message = $escaped_description;
    $name = 'XXXXXXXXX';
    $business = '';
    $status = 'Active Member';
    $emailContent = email_model($title, $message, $name, $business, $status);
    echo $emailContent;

}

function networkers_email_status_active_member() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'status-update.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    
    $args = array(
        'post_type'      => 'network-ammail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_id = $posts[0]->ID;
    $post_content = get_post_meta( $post_id, 'email', true );
    $post_title = $posts[0]->post_title;
    $statusEmail = base64_decode($post_content);

    $user_role = Get_User_Role();

    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Active Visitor Email</h2>';
    echo '</div>';
    echo '<br><br>';
    echo '<label >Title:</label><br>';
    echo "<input id='title' type='text' name='title' value='$post_title'>";
    echo "<input style='display:none' id='stype' type='text' name='stype' value='network-ammail'>";
    echo '<br><br>';
    echo '<p>Use the following keys to customise your email.</p>';
    echo '<p>{{name}} {{businessname}} {{groupinfo}} {{status}}</p>';
    echo '<div style="max-width:600px;margin-top:-20px">';

        $escaped_description = html_entity_decode($statusEmail);
        $escaped_description = stripslashes($escaped_description);
        $settings =   array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false,
            'textarea_name' => 'statusEmail',
            'textarea_rows' => get_option('default_post_edit_rows', 10),
            'editor_css' => '',
            'editor_class' => '', 
        );
        wp_editor( $escaped_description, 'statusEmail', $settings );
    echo '</div>';

    echo '<br><br>';
    
    ?>

    <div style="display:flex">
        <button style="margin-right: 10px; margin-top: 0px;border-width:0px" class='networkersbuttom' type="submit">Update Email</button>
    </div>

    </form>

    <?php
    $title = $post_title;
    $message = $escaped_description;
    $name = 'XXXXXXXXX';
    $business = '';
    $status = 'Active Member';
    $emailContent = email_model($title, $message, $name, $business, $status);
    echo $emailContent;

}

function networkers_email_status_past_member() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'status-update.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    
    $args = array(
        'post_type'      => 'network-pmmail',
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_id = $posts[0]->ID;
    $post_content = get_post_meta( $post_id, 'email', true );
    $post_title = $posts[0]->post_title;
    $statusEmail = base64_decode($post_content);

    $user_role = Get_User_Role();

    echo "<form id='myForm' action='$url' method='post' enctype='multipart/form-data'>";

    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Active Visitor Email</h2>';
    echo '</div>';
    echo '<br><br>';
    echo '<label >Title:</label><br>';
    echo "<input id='title' type='text' name='title' value='$post_title'>";
    echo "<input style='display:none' id='stype' type='text' name='stype' value='network-pmmail'>";
    echo '<br><br>';
    echo '<p>Use the following keys to customise your email.</p>';
    echo '<p>{{name}} {{businessname}} {{groupinfo}} {{status}}</p>';
    echo '<div style="max-width:600px;margin-top:-20px">';

        $escaped_description = html_entity_decode($statusEmail);
        $escaped_description = stripslashes($escaped_description);
        $settings =   array(
            'wpautop' => true, // use wpautop?
            'media_buttons' => false,
            'textarea_name' => 'statusEmail',
            'textarea_rows' => get_option('default_post_edit_rows', 10),
            'editor_css' => '',
            'editor_class' => '', 
        );
        wp_editor( $escaped_description, 'statusEmail', $settings );
    echo '</div>';

    echo '<br><br>';
    
    ?>

    <div style="display:flex">
        <button style="margin-right: 10px; margin-top: 0px;border-width:0px" class='networkersbuttom' type="submit">Update Email</button>
    </div>

    </form>

    <?php
    $title = $post_title;
    $message = $escaped_description;
    $name = 'XXXXXXXXX';
    $business = '';
    $status = 'Active Member';
    $emailContent = email_model($title, $message, $name, $business, $status);
    echo $emailContent;

}

function networkers_email_status_content($post_id, $status) {

    $firstName = get_post_meta( $post_id, 'firstName', true );
    $lastName = get_post_meta( $post_id, 'lastName', true );
    $name = $firstName . " " . $lastName;
    $businessname = get_the_title($post_id);
    $groups = get_post_meta( $post_id, 'group', false );
    $groupstring = "";
    foreach($groups as $groupid) {
        $obj = Get_Group($groupid);
        $pieces = explode(":", $obj->start);
        $time = ucfirst($obj->weekday) . " " . $pieces[0] . ":" . $pieces[1] . "" . $pieces[2];
        $address1 = $obj->address1;
        $address2 = $obj->address2;
        $suburb = $obj->suburb;
        $city = $obj->city;
        $postcode = $obj->postcode;
        $facilitatorid = $obj->facilitator;
        $objfacilitator = Get_Facilitator($facilitatorid);
        $region = $obj->regions;
        $robj = Get_Region($region);
        $region = $robj->post_title;

        $groupstring = $groupstring . "
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Group Name</strong></p>
        <p style='margin:0px;padding:0px;'>$obj->post_title</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Meeting day & time</strong></p>
        <p style='margin:0px;padding:0px;'>$time</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Location</strong></p>
        <p style='margin:0px;padding:0px;'>$address1</p>
        <p style='margin:0px;padding:0px;'>$address2</p>
        <p style='margin:0px;padding:0px;'>$suburb</p>
        <p style='margin:0px;padding:0px;'>$city</p>
        <p style='margin:0px;padding:0px;margin-top:5px'><strong>Facilitator</strong></p>
        <p style='margin:0px;padding:0px;'>$objfacilitator->name</p>
        <p style='margin:0px;padding:0px;'>$objfacilitator->phone</p>
        <p style='margin:0px;padding:0px;'>$objfacilitator->email</p>
        ";
    }

    if($status == "Scheduled Visitor"){$post_type = "network-statusemail";}
    if($status == "Active Visitor"){$post_type = "network-avmail";}
    if($status == "End Trial Visitor"){$post_type = "network-etvmail";}
    if($status == "Active Member"){$post_type = "network-ammail";}
    if($status == "Past Member"){$post_type = "network-pmmail";}

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => 1,  // Limit to only one post
    );
    $posts = get_posts($args);
    $post_idd = $posts[0]->ID;
    $title = $posts[0]->post_title;
    $post_content = get_post_meta( $post_idd, 'email', true );

    $statusEmail = base64_decode($post_content);
    $statusEmail = html_entity_decode($statusEmail);
    $statusEmail = stripslashes($statusEmail);

    $statusEmail = str_replace('{{name}}', $name, $statusEmail);
    $statusEmail = str_replace('{{businessname}}', $businessname, $statusEmail);
    $statusEmail = str_replace('{{status}}', $status, $statusEmail);
    $statusEmail = str_replace('{{groupinfo}}', $groupstring, $statusEmail);

    return array($statusEmail, $title);

}

?>