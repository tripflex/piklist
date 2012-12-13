<?php
/*
Title: Field Templates <span class="piklist-title-right">Order 70</span>
Post Type: piklist_demo
Order: 70
Collapse: false
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'template'
    ,'label' => 'Text'
    ,'description' => 'ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'value' => 'Lorem'
    ,'template' => 'piklist_demo'
    ,'columns' => 12
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'template_add_more'
    ,'add_more' => true
    ,'label' => 'Text'
    ,'description' => 'ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'value' => 'Lorem'
    ,'template' => 'piklist_demo'
    ,'columns' => 8
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>