<?php
/*
Title: Groups
Order: 30
Flow: Edit Demo
*/
  
  piklist('include_meta_boxes', array(
    'piklist_meta_help'
    ,'piklist_meta_field_group'
    ,'piklist_meta_field_group_test'
    ,'piklist_meta_field_taxonomies'
    ,'piklist_meta_field_featured_image'
    ,'piklist_meta_field_relate'
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>