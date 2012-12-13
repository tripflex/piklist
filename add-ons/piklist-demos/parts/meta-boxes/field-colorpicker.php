<?php
/*
Title: ColorPicker Fields <span class="piklist-title-right">Order 60</span>
Post Type: piklist_demo
Order: 60
Collapse: false
*/
    
  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color'
    ,'label' => 'Color Picker'
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>