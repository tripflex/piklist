<?php
/*
Title: DatePicker & TimePicker Fields <span class="piklist-title-right">Order 50</span>
Post Type: piklist_demo
Order: 50
Collapse: true
*/
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'date'
    ,'label' => __('Date')
    ,'description' => __('Choose a date')
    ,'options' => array(
      'dateFormat' => 'd M, y'
    )
    ,'attributes' => array(
      'size' => 6
    )
    ,'value' => date('d M, y', time() + 604800)
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'date_add_more'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('Choose a date')
    ,'options' => array(
      'dateFormat' => 'd M, y'
    )
    ,'attributes' => array(
      'size' => 6
    )
    ,'value' => date('d M, y', time() + 604800)
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
    ,'attributes' => array(
      'size' => 6
    )
    ,'value' => date('H:m A')
  ));
  
  piklist('field', array(
    'type' => 'timepicker'
    ,'field' => 'time_add_more'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('Choose a time')
    ,'options' => array(
      'startTime' => date('H:m A')
      ,'show24Hours' => false
      ,'separator' => ':'
      ,'step' => 15
    )
    ,'attributes' => array(
      'size' => 6
    )
    ,'value' => date('H:m A')
    ,'position' => 'end'
  ));
    
  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>