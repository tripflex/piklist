<?php
/*
Title: Checkbox Fields <span class="piklist-title-right">Order 40</span>
Post Type: piklist_demo
Order: 40
Collapse: true
*/

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'checkbox'
    ,'label' => __('Normal')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'checkbox_inline'
    ,'label' => __('Single Line')
    ,'value' => 'that'
    ,'list' => false
    ,'choices' => array(
      'this' => 'This'
      ,'that' => 'That'
    )
  ));
 
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'checkbox_list'
    ,'label' => __('Group Lists')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'fields' => array(
      array(
        'type' => 'checkbox'
        ,'field' => 'checkbox_list_1'
        ,'label' => __('List #1')
        ,'label_position' => 'before'
        ,'value' => 'third'
        ,'choices' => array(
          'first' => 'First Choice'
          ,'third' => 'Third Choice'
        )
        ,'columns' => 6
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'checkbox_list_2'
        ,'label' => __('List #2')
        ,'label_position' => 'before'
        ,'value' => 'second'
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
        ,'columns' => 6
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'checkbox_nested'
    ,'label' => __('Nested Field')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => array(
      'first'
      ,'third'
    )
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice with a nested [field=checkbox_nested_text] input.'
      ,'third' => 'Third Choice'
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'checkbox_nested_text'
        ,'value' => '12345'
        ,'embed' => true
        ,'attributes' => array(
          'class' => 'small-text'
        )
      )
    )
    ,'position' => 'end'
  ));

  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>