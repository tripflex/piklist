<?php
/*
Title: Select Fields <span class="piklist-title-right">Order 20</span>
Post Type: piklist_demo
Order: 20
Collapse: true
*/

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select'
    ,'label' => __('Select')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_add_more'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
    ,'position' => 'end'
  ));

  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>
