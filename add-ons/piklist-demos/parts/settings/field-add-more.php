<?php
/*
Title: Add More Fields
Setting: piklist_demo_fields
Tab: Advanced
Order: 30
*/

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'demo_group_add_more'
    ,'add_more' => true
    ,'label' => __('Group ~ List Example')
    ,'description' => __('This is an example of how to build a list with multiple element types.')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'text_add_more'
        ,'value' => 'Lorem'
        ,'columns' => 4
      )
      ,array(
        'type' => 'datepicker'
        ,'field' => 'date_add_more'
        ,'options' => array(
          'dateFormat' => 'M d, yy'
        )
        ,'value' => date('M d, Y', time() + 604800)
        ,'columns' => 2
      )
      ,array(
        'type' => 'select'
        ,'field' => 'select_add_more'
        ,'value' => 'third'
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
        ,'columns' => 3
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text_small_add_more'
    ,'add_more' => true
    ,'label' => __('Text')
    ,'description' => __('class="small-text"')
    ,'value' => 'Lorem'
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'demo_select_add_more'
    ,'add_more' => true
    ,'label' => __('Select')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
  ));

  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'demo_color_add_more'
    ,'add_more' => true
    ,'label' => __('Color Picker')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
  ));
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'demo_date_add_more'
    ,'add_more' => true
    ,'label' => __('Date')
    ,'description' => __('Choose a date')
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'value' => date('M d, Y', time() + 604800)
  ));

