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

//MAIN BLOCK
include ABSPATH . '/wp-content/plugins/thenetworks/admin/profile.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/groups/group.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/groups/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/groups/update-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/industry/industry.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/industry/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/industry/update-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/regions/region.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/regions/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/regions/update-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/members/member.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/members/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/members/update-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/franchise/franchise.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/franchise/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/franchise/update-form.php';

//ADMIN FUNCTION
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/user-image-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/industry-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-industrys.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-groups.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-regions.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-role.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/group-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/imagebox.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-members.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/referedby-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/facilitator-box.php';

//FUNCTION
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-group.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/member-logo.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/member-social-media.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-industry.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-member.php';

//CLASS
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-group.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-industry.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-member.php';

//SHORTCODE
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/slide.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/region-dropdown-menu.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-list-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-hero.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-info-left.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-info-right.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-members.php';

//API
include_once ABSPATH . '/wp-content/plugins/thenetworks/API/group_list.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/API/member-image-list.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/API/member-image-upload.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/API/member-logo-list.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/API/member-logo-upload.php';

//SUPER ADMIN
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/oldnetwork.php';





// Add button to wordpress admin menu.
add_action('admin_menu', 'my_menu_networkers');
function my_menu_networkers(){

      $user = wp_get_current_user();
      $roles = ( array ) $user->roles;
      $user_role = $roles[0];

      wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
      wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
      wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

      // Profile 
      if ($user_role == 'franchise' || $user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('My Profile', 'My Profile', 'network_profile', 'networkers-profile', 'my_menu_networkers_profile', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
      }
      // Group 
      if ($user_role == 'franchise' || $user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Groups', 'Groups', 'the_networkers', 'networkers-group', 'networkers_group', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-group',  'New Group', 'New Group', 'the_networkers', 'networkers-group-new', 'networkers_group_new' );
            add_submenu_page( null,  'Update Group', 'Update Group', 'the_networkers', 'networkers-group-update', 'networkers_group_update' );
      }
      // Industry 
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Industries', 'Industries', 'the_networkers', 'networkers-industry', 'networkers_industry', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-industry',  'New Industry', 'New Industry', 'the_networkers', 'networkers-industry-new', 'network_industry_new' );
            add_submenu_page( null,  'Update Industry', 'Update Industry', 'the_networkers', 'networkers-industry-update', 'networkers_industry_update' );
      }
      // Region 
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Region', 'Region', 'the_networkers', 'networkers-region', 'networkers_region', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-region',  'New Region', 'New Region', 'the_networkers', 'network-region-new', 'network_region_new' );
            add_submenu_page( null,  'Update Region', 'Update Region', 'the_networkers', 'networkers-region-update', 'networkers_region_update' );
      }
      // Member
      if ($user_role == 'franchise' || $user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Members', 'Members', 'the_networkers', 'networkers-members', 'networkers_members', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-members',  'New Member', 'New Member', 'the_networkers', 'network-members-new', 'network_members_new' );
            add_submenu_page( null,  'Update Member', 'Update Member', 'the_networkers', 'networkers-members-update', 'networkers_members_update' );
      }
      //Franchisees
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Franchise', 'Franchise', 'the_networkers', 'networkers-franchise', 'networkers_franchise', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-franchise',  'New Franchise', 'New Franchise', 'the_networkers', 'network-franchise-new', 'networkers_franchise_new' );
            add_submenu_page( null,  'Update Franchise', 'Update Franchise', 'the_networkers', 'networkers-franchise-update', 'networkers_franchise_update' );
      }

      //Super Admin
      if ($user_role == 'administrator'){
            add_menu_page('SuperAdmin', 'SuperAdmin', 'the_networkers', 'networkers-superadmin', 'networkers_superadmin', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
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
          exit( wp_safe_redirect( admin_url('admin.php?page=networkers-profile') ) );
} );


?>