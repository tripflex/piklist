<?php
/*
Title: Radio, Checkbox and Nested Fields
Setting: piklist_demo_fields
Tab: Lists
Order: 20
*/

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'radio'
    ,'label' => __('Radio')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice with a nested [field=radio_text_small] input.'
      ,'third' => 'Third Choice'
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'radio_text_small'
        ,'value' => '12345'
        ,'embed' => true
        ,'attributes' => array(
          'class' => 'small-text'
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'radio_inline'
    ,'label' => 'Single Line'
    ,'value' => 'no'
    ,'list' => false
    ,'choices' => array(
      'yes' => 'Yes'
      ,'no' => 'No'
    )
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'checkbox'
    ,'label' => __('Checkbox')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'second'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice with a nested [field=checkbox_select] input.'
    )
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'checkbox_select'
        ,'value' => 'third'
        ,'embed' => true
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Settings Section'
  ));

?>