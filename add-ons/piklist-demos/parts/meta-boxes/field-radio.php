<?php
/*
Title: Radio Fields <span class="piklist-title-right">Order 30</span>
Post Type: piklist_demo
Order: 30
Collapse: true
*/

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'radio'
    ,'scope' => 'post_meta'
    ,'label' => __('Normal')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice with a nested input.'
      ,'third' => 'Third Choice'
    )
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'radio_inline'
    ,'scope' => 'post_meta'
    ,'label' => __('Single Line')
    ,'value' => 'no'
    ,'list' => false
    ,'choices' => array(
      'yes' => 'Yes'
      ,'no' => 'No'
    )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'radio_list'
    ,'scope' => 'post_meta'
    ,'label' => __('Group Lists')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'fields' => array(
      array(
        'type' => 'radio'
        ,'field' => 'radio_list_1'
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
        'type' => 'radio'
        ,'field' => 'radio_list_2'
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
    'type' => 'radio'
    ,'field' => 'radio_nested'
    ,'scope' => 'post_meta'
    ,'label' => __('Nested Field')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice with a nested [field=radio_nested_text] input.'
      ,'third' => 'Third Choice'
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'radio_nested_text'
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