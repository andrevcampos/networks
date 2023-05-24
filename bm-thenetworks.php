<?php

/*
Plugin Name: BM_Networks
Plugin URI: https://breezemarketing.co.nz
Description: Networks Group Plugin
Version: 1.0
Author URI: https://breezemarketing.co.nz
Author: Andre Campos
Text Domain: bm_networks
*/ 

//include ABSPATH . '/wp-content/plugins/thenetworks/members/new.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/members.php';

// Add button to wordpress admin menu.
add_action('admin_menu', 'my_menu_networkers');
function my_menu_networkers(){
      add_menu_page('Members', 'Members', 'manage_options', 'my_menu_networkers_members', 'my_menu_networkers_members', null, 7 );
      add_submenu_page( 'my_menu_networkers_members',  'New Members', 'New Members', 'manage_options', 'members', 'networkers_members_new' );
}

?>