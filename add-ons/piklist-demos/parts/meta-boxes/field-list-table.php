<?php
/*
Title: List Table
Post Type: piklist_demo
Order: 100
Collapse: true
Meta box: false
*/


//You can construct your object and pass it in, this is handy when you need to do complex adjustments. //However try to be aware of how many records you work with and pass in as it will effect page load.
//If you are only showing 10 records at a time then all you need is to pass 10.


  global $wpdb;

  $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = %s AND post_status = %s", 'post', 'publish'));
  
  foreach ($data as &$row)
  {
    $user_data = get_userdata($row->post_author);
    $row->post_author = $user_data->user_login;
  }
  
  piklist('list_table', array(
    'name' => 'Object Example'
    ,'data' => $data
    ,'per_page' => 10
    ,'key' => 'ID'
    ,'column' => 'post_title'
    ,'columns' => array(
      'post_title' => 'Post title'
      ,'post_date' => 'Date'
      ,'post_author' => 'Author'
      ,'comment_count' => 'Comments'
    )
  ));

  

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta box'
  ));
  
?>