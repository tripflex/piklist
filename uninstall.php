<?php
/**
 * Piklist Uninstall
 *
 * Removes: Options, Demo Post Type, Piklist Tables
 *
 */


  if(!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN'))
  {
    exit;
  }

    global $wpdb;

    delete_option('piklist'); //TODO: check for add-ons from other plugins.

    delete_option('piklist_demo_fields');

    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%_pik_%';");

    $cptargs = array(
      'numberposts' => 100
      ,'post_type' =>'piklist_demo'
      ,'post_status' => 'all'
    );
    $posts = get_posts($cptargs);
      if ($posts)
      {
        foreach($posts as $post)
        {
          wp_delete_post( $post->ID, true);
        }
      }


    $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->base_prefix . 'post_relationships');
    $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->base_prefix . 'termmeta');

    // Pre-0.6.7
    $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->base_prefix . 'piklist_cpt_relate');



    /** Sorry to see you go! **/


?>