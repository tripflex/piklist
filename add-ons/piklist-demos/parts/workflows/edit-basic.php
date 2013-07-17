<?php
/*
Title: Basic
Order: 20
Flow: Edit Demo
*/
  
  piklist('include_meta_boxes', array(
    'piklist_meta_help'
    ,'piklist_meta_field_text'
    ,'piklist_meta_field_select'
    ,'piklist_meta_field_radio'
    ,'piklist_meta_field_checkbox'
    ,'piklist_meta_field_taxonomies'
    ,'piklist_meta_field_relate'
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>