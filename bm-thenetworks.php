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
include ABSPATH . '/wp-content/plugins/thenetworks/admin/facilitator/facilitator.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/facilitator/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/facilitator/update-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/email/email.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/email/email-model.php';

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
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/get-facilitators.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/admin/function/region-image.php';

//FUNCTION
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-group.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/member-logo.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/member-social-media.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-industry.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-member.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-facilitator.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/order-region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/get-member-list.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/function/webhook.php';

//CLASS
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-region.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-group.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-industry.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-member.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/class/class-facilitator.php';

//SHORTCODE
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/slide.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/pinpoint.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/pinpoint-left.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/region-dropdown-menu.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-list-box.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-hero.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-info-left.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-info-right.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-members.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/member-list.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/member-search.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/member-hero.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/member-info-left.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/member-info-right.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/group-select-form.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/searchform.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/searchlist.php';
include_once ABSPATH . '/wp-content/plugins/thenetworks/shortcode/searchbox.php';

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
      //$user_role = $roles[0];
      $user_role = current($roles);

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
            add_submenu_page( null,  'Update Member Status', 'Update Member Status', 'the_networkers', 'networkers-members-update-status', 'networkers_members_update_status' );
      }
      //Franchisees
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Franchise', 'Franchise', 'the_networkers', 'networkers-franchise', 'networkers_franchise', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-franchise',  'New Franchise', 'New Franchise', 'the_networkers', 'network-franchise-new', 'networkers_franchise_new' );
            add_submenu_page( null,  'Update Franchise', 'Update Franchise', 'the_networkers', 'networkers-franchise-update', 'networkers_franchise_update' );
      }
      //Facilitator
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Facilitator', 'Facilitator', 'the_networkers', 'networkers-facilitator', 'networkers_facilitator', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-facilitator',  'New Facilitator', 'New Facilitator', 'the_networkers', 'network-facilitator-new', 'networkers_facilitator_new' );
            add_submenu_page( null,  'Update Facilitator', 'Update Facilitator', 'the_networkers', 'networkers-facilitator-update', 'networkers_facilitator_update' );
      }
      //Email
      if ($user_role == 'administrator' || $user_role == 'network-admin'){
            add_menu_page('Email', 'Email', 'the_networkers', 'networkers-email', 'networkers_email', '/wp-content/uploads/2023/07/menu-icon.png', 7 );
            add_submenu_page( 'networkers-email',  'New Register', 'New Register', 'the_networkers', 'network-email-new-register', 'networkers_email_new_register' );
            add_submenu_page( 'networkers-email',  'Stastus Potential Member', 'Stastus Potential Member', 'the_networkers', 'network-email-status-potential-member', 'networkers_email_status_potential' );
            add_submenu_page( 'networkers-email',  'Stastus Scheduled', 'Stastus Scheduled', 'the_networkers', 'network-email-status-scheduled', 'networkers_email_status_scheduled' );
            add_submenu_page( 'networkers-email',  'Stastus Active Visitor', 'Stastus Active Visitor', 'the_networkers', 'network-email-status-active-visitor', 'networkers_email_status_active_visitor' );
            add_submenu_page( 'networkers-email',  'Stastus End Trial Visitor', 'Stastus End Trial Visitor', 'the_networkers', 'network-email-status-end-trial-visitor', 'networkers_email_status_end_trial_visitor' );
            add_submenu_page( 'networkers-email',  'Stastus Active Member', 'Stastus Active Member', 'the_networkers', 'network-email-status-active-member', 'networkers_email_status_active_member' );
            add_submenu_page( 'networkers-email',  'Stastus Past Member', 'Stastus Past Member', 'the_networkers', 'network-email-status-past-member', 'networkers_email_status_past_member' );
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


function register_member_post_type() {
      $labels = array(
          'name'               => _x('Members', 'post type general name'),
          'singular_name'      => _x('Member', 'post type singular name'),
          'add_new'            => _x('Add New', 'Member'),
          'add_new_item'       => __('Add New Member'),
          'edit_item'          => __('Edit Member'),
          'new_item'           => __('New Member'),
          'all_items'          => __('All Members'),
          'view_item'          => __('View Member'),
          'search_items'       => __('Search Members'),
          'not_found'          => __('No members found'),
          'not_found_in_trash' => __('No members found in Trash'),
          'parent_item_colon'  => '',
          'menu_name'          => 'Members'
      );
  
      $args = array(
          'labels'        => $labels,
          'public'        => true,
          'menu_icon'     => 'dashicons-businessman', // You can choose a different icon
          'menu_position' => 5,
          'supports'      => array('title', 'editor', 'thumbnail', 'page-attributes'),
          'has_archive'   => false,  // If you want to disable archives
          'rewrite'       => array('slug' => 'members'),
          'hierarchical'  => true,  // Enables page attributes like parent and child
          'show_in_menu'  => false,
      );
  
      register_post_type('network-member', $args);
  }
  
  add_action('init', 'register_member_post_type');

  function register_group_post_type() {
      $labels = array(
          'name'               => _x('Groups', 'post type general name'),
          'singular_name'      => _x('Group', 'post type singular name'),
          'add_new'            => _x('Add New', 'Group'),
          'add_new_item'       => __('Add New Group'),
          'edit_item'          => __('Edit Group'),
          'new_item'           => __('New Group'),
          'all_items'          => __('All Groups'),
          'view_item'          => __('View Group'),
          'search_items'       => __('Search Groups'),
          'not_found'          => __('No Groups found'),
          'not_found_in_trash' => __('No Groups found in Trash'),
          'parent_item_colon'  => '',
          'menu_name'          => 'Groups'
      );
  
      $args = array(
          'labels'        => $labels,
          'public'        => true,
          'menu_icon'     => 'dashicons-businessman', // You can choose a different icon
          'menu_position' => 5,
          'supports'      => array('title', 'editor', 'thumbnail', 'page-attributes'),
          'has_archive'   => false,  // If you want to disable archives
          'rewrite'       => array('slug' => 'groups'),
          'hierarchical'  => true,  // Enables page attributes like parent and child
          'show_in_menu'  => false,
      );
  
      register_post_type('network-group', $args);
  }
  
  add_action('init', 'register_group_post_type');

  //Regions
  function register_region_post_type() {
      $labels = array(
          'name'               => _x('Regions', 'post type general name'),
          'singular_name'      => _x('Region', 'post type singular name'),
          'add_new'            => _x('Add New', 'Region'),
          'add_new_item'       => __('Add New Region'),
          'edit_item'          => __('Edit Region'),
          'new_item'           => __('New Region'),
          'all_items'          => __('All Regions'),
          'view_item'          => __('View Region'),
          'search_items'       => __('Search Regions'),
          'not_found'          => __('No Region found'),
          'not_found_in_trash' => __('No regions found in Trash'),
          'parent_item_colon'  => '',
          'menu_name'          => 'Regions'
      );
  
      $args = array(
          'labels'        => $labels,
          'public'        => true,
          'menu_icon'     => 'dashicons-businessman', // You can choose a different icon
          'menu_position' => 5,
          'supports'      => array('title', 'editor', 'thumbnail', 'page-attributes'),
          'has_archive'   => false,  // If you want to disable archives
          'rewrite'       => array('slug' => 'networking-groups'),
          'hierarchical'  => true,  // Enables page attributes like parent and child
          'show_in_menu'  => false,
      );
  
      register_post_type('network-region', $args);
  }
  add_action('init', 'register_region_post_type');


  function custom_page_title($title) {
      // Check if the current page URL contains '/members/'
      if (strpos($_SERVER['REQUEST_URI'], '/members/') !== false) {

            $memberid = $_GET['id'];
            $obj = Get_Member($memberid);
            $name = $obj->businessname . " - " . $obj->firstname . " " . $obj->lastname . " | The Networkers";

            if (!empty($name)) {
                  return $name;
            }
      }
      return $title;
  }
  add_filter('pre_get_document_title', 'custom_page_title', 20);

  function custom_meta_description() {
      if (strpos($_SERVER['REQUEST_URI'], '/members/') !== false) {
            $memberid = $_GET['id'];
            $obj = Get_Member($memberid);
            $description2 = $obj->businessdescription;
            $decoded_description = base64_decode($description2);
            $escaped_description = stripslashes(html_entity_decode($decoded_description, ENT_QUOTES, 'UTF-8'));
            $escaped_description_with_line_breaks = nl2br($escaped_description);
            $content = $escaped_description_with_line_breaks;
            
          echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($content)) . '">';
      }
  }
  add_action('wp_head', 'custom_meta_description');

?>