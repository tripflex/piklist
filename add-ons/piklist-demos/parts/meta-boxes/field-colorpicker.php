<?php
/*
Title: ColorPicker Fields <span class="piklist-title-right">Order 60</span>
Post Type: piklist_demo
Order: 60
Collapse: true
*/
    
  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color'
    ,'scope' => 'post_meta'
    ,'label' => __('Color Picker')
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color_add_more'
    ,'scope' => 'post_meta'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'position' => 'end'
  ));
  
  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>