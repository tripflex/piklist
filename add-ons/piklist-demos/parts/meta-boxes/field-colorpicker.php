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
    ,'label' => 'Color Picker'
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));
  
?>