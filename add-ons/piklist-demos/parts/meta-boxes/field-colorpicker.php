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
  ));
  
  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  ));
  
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>