<?php
/*
Plugin Name: Piklist
Plugin URI: http://piklist.com
Description: A Framework for Building Powerful Websites.
Version: 0.3.5
Author: The Piklist Community
Author URI: http://piklist.com/
*/

// TODO: Add filters to save_post_meta and anywhere else we need them prefix piklist_
// TODO: Add filter settings to register post
// TODO: Drop in Relationships
// TODO: register_comment_type
// TODO: Setters and Getters
// TODO: Widget Select in Thickbox
// TODO: Add Options page for plugin and each addon
// TODO: Add theme options page
// TODO: Add CPT Picker Popup for Widgets and anything else
// TODO: Cache all file & directory parsing with expire & is_admin() check
// TODO: Custom Publish box for CPT trigger() with jquery
// TODO: Stop any meta boxes from being added to CPT by default and allow this to be changed in an options page
// TODO: Options pages for any cpt/taxonomy/etc
// TODO: Add js/css to parts directory for load of assets?
// TODO: Builder
// TODO: All displays as shortcodes
// TODO: For meta add function to do this: echo $type; _facebook piklist::get_field_id('facebook')
// TODO: Make builder support all widgets and sidebars as well

// ------------------- MINIMAL (Peewee's word of the day!) -------------------

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

include_once('includes/pik.php');

piklist::load();

  // function remove_admin_style() 
  // {
  //   global $wp_styles;
  //   
  //   foreach ($wp_styles->registered as $style => $config)
  //   {
  //     if (strstr($style, 'colors-'))
  //     {
  //       unset($wp_styles->registered[$style]);
  //     }
  //   }
  // }
  // add_action('admin_init','remove_admin_style');

?>