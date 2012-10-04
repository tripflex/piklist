<?php
/*
Title: Enhanced Fields
Setting: piklist_demo_fields
Tab: Advanced
Order: 10
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
  
  piklist('field', array(
    'type' => 'timepicker'
    ,'field' => 'time'
    ,'label' => __('Time')
    ,'description' => __('Choose a time')
    ,'options' => array(
      'startTime' => date('H:m A')
      ,'show24Hours' => false
      ,'separator' => ':'
      ,'step' => 15
    )
    ,'value' => date('H:m A')
    ,'position' => 'end'
  ));

