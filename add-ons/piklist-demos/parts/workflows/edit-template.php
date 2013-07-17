<?php
/*
Title: Templates
Order: 40
Flow: Edit Demo
*/
  
  piklist('include_meta_boxes', array(
    'piklist_meta_help'
    ,'piklist_meta_field_template'
    ,'piklist_meta_field_taxonomies'
    ,'piklist_meta_field_relate'
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>