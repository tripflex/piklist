<?php
/*
Title: DatePicker & TimePicker Fields <span class="piklist-title-right">Order 50</span>
Post Type: piklist_demo
Order: 50
Collapse: false
*/
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'date'
    ,'label' => 'Date'
    ,'description' => 'Choose a date'
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('M d, Y', time() + 604800)
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'date_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'Choose a date'
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('M d, Y', time() + 604800)
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'timepicker'
    ,'field' => 'time'
    ,'label' => 'Time'
    ,'description' => 'Choose a time'
    ,'options' => array(
      'startTime' => date('H:m A')
      ,'show24Hours' => false
      ,'separator' => ':'
      ,'step' => 15
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('H:m A')
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'timepicker'
    ,'field' => 'time_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'Choose a time'
    ,'options' => array(
      'startTime' => date('H:m A')
      ,'show24Hours' => false
      ,'separator' => ':'
      ,'step' => 15
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('H:m A')
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
    
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>