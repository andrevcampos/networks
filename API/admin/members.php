<?php
function my_menu_networkers_members() {

// $plugin_url = plugin_dir_url( __FILE__ );
// wp_enqueue_style( 'css', $plugin_url . '/css/admin.css' );
// wp_enqueue_script( 'js', $plugin_url . '/js/js.js' );

echo '<div class="wrap">';
    echo '<h2>Members</h2>';
echo '</div><br>';
}

function networkers_members_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    echo '
    <div class="memberbox">
        <div class="wrap">
            <h2>New Member</h2>
        </div><br>

        <label>Business Name:</label><br>
        <input id="businessName" type="text"><br><br>

        <label>First Name:</label><br>
        <input id="firstName" type="text"><br><br>

        <label>Last Name:</label><br>
        <input id="lastName" type="text"><br><br>

        <label>Email:</label><br>
        <input id="email" type="text"><br><br>

        <label>Phone:</label><br>
        <div id="memberphone">
            <input class="phone" type="text"><br>
        </div>
        <div class="memberbuttom" onclick="addnewphone()" >Add another phone</div>

        <div class="membertitles">Networking Group</div>
        <p>Please select the group(s) this member belongs to</p>
        <input class="membergroup" type="text"><br>
        <div class="membergroups"></div>

        <div class="membertitles" style="margin-top:30px">Industries</div>
        <p>Please select the Industries this member belongs to</p>
        <input class="industry" type="text"><br>
        <div class="industries"></div>

        <div class="membertitles" style="margin-top:30px">Referred by</div>
        <p>If an existing member referred this member, please enter their name here.</p>
        <input class="referred" type="text"><br>
        <div class="referredby"></div>

    </div>
    ';
}
?>