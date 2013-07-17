<?php
/*
Page: piklist_list_table
*/

  global $wpdb;
  
  piklist('list_table', array(
    'name' => 'Piklist Demo'
    ,'data' => $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = %s", 'piklist_demo')
    ,'per_page' => 10
    ,'key' => 'ID'
    ,'column' => 'post_title'
    ,'columns' => array(
      'post_title' => 'Demo'
      ,'post_date' => 'Date'
    )
    ,'actions' => array(
      'delete' => 'Delete'
    )
  ));
  
  piklist('list_table', array(
    'name' => 'Piklist Demo'
    ,'data' => $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = %s", 'post')
    ,'per_page' => 10
    ,'key' => 'ID'
    ,'column' => 'post_title'
    ,'columns' => array(
      'post_title' => 'Demo'
      ,'post_date' => 'Date'
    )
    ,'actions' => array(
      'delete' => 'Delete'
    )
  ));
  
?>
