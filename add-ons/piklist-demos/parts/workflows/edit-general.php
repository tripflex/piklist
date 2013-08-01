<?php
/*
Title: General
Order: 10
Flow: Edit Demo
Default: true
*/
  
  piklist('include_meta_boxes', array(
    'piklist_meta_help'
    ,'piklist_meta_field_editor'
    ,'piklist_meta_field_taxonomies'
    ,'piklist_meta_field_featured_image'
    ,'piklist_meta_field_relate'
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));
  
?>