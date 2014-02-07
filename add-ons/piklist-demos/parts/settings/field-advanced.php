<?php
/*
Title: Enhanced Fields
Setting: piklist_demo_fields
Tab: Advanced
Order: 40
*/

  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'color'
    ,'label' => __('Color Picker')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
  ));

  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'date'
    ,'label' => __('Date')
    ,'description' => __('Choose a date')
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'value' => date('M d, Y', time() + 604800)
  ));
  

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Settings Section'
  ));

?>