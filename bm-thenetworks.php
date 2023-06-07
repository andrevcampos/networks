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
include ABSPATH . '/wp-content/plugins/thenetworks/admin/profile.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/members.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/franchisees.php';

// Add button to wordpress admin menu.
add_action('admin_menu', 'my_menu_networkers');
function my_menu_networkers(){

      $user = wp_get_current_user();
      $roles = ( array ) $user->roles;
      $user_role = $roles[0];
      
      // Profile 
      if ($user_role == 'franchise' || $user_role == 'administrator'){
            add_menu_page('My Profile', 'My Profile', 'network_profile', 'my_menu_networkers_profiles', 'my_menu_networkers_profile', null, 7 );
      }

      // Member
      if ($user_role == 'franchise' || $user_role == 'administrator'){
            add_menu_page('Members', 'Members', 'network_members', 'my_menu_networkers_members', 'my_menu_networkers_members', null, 7 );
            add_submenu_page( 'my_menu_networkers_members',  'New Members', 'New Members', 'network_members', 'network_members', 'networkers_members_new' );
      }
      
      //Franchisees
      if ($user_role == 'administrator'){
            add_menu_page('Franchisees', 'Franchisees', 'network_franchise', 'networkers-franchisees', 'networkers_franchisees', null, 7 );
            add_submenu_page( 'networkers-franchisees',  'New Franchise', 'New Franchise', 'network_franchise', 'networkers-franchisees-new', 'networkers_franchisees_new' );
            add_submenu_page( 'networkers-franchisees',  'Update Franchise', 'Update Franchise', 'network_franchise', 'networkers-franchisees-update', 'networkers_franchisees_update');
      }
}

// Remove Profile from Franchise from left menu
function remove_profile_menu() {
      if (current_user_can('administrator')) {
            return;
      }
      remove_submenu_page('users.php', 'profile.php');
      remove_menu_page('profile.php');
}
add_action('admin_menu', 'remove_profile_menu');
// Remove Profile from Franchise from top menu
function ya_do_it_admin_bar_remove() {
      global $wp_admin_bar;
      /* **edit-profile is the ID** */
      $wp_admin_bar->remove_menu('edit-profile');
}
add_action('wp_before_admin_bar_render', 'ya_do_it_admin_bar_remove', 0);
// Redirect the profile page
add_action( 'load-profile.php', function() {
      if( ! current_user_can( 'manage_options' ) )
          exit( wp_safe_redirect( admin_url('admin.php?page=my_menu_networkers_members') ) );
} );


?>