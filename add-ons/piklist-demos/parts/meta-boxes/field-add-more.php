<?php
/*
Title: Add More Fields <span class="piklist-title-right">Order 1</span>
Post Type: piklist_demo
Order: 1
Collapse: false
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'test_add_more'
    ,'label' => __('Text')
    ,'add_more' => true
    ,'value' => 'single'
  ));

  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'test_add_more_textarea'
    ,'label' => __('Text Area')
    ,'add_more' => true
    ,'value' => 'This is some default text.'
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
  ));
 
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'test_add_more_grouped'
    ,'label' => __('Test ~ Add More Group (Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_1'
        ,'value' => 'one'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_2'
        ,'value' => 'two'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_3'
        ,'value' => 'three'
      )
    )
  ));
   
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'test_add_more_group_nested'
    ,'label' => __('Test ~ Add More Group Nested')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'test_add_more_group_1'
        ,'value' => 'one'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'test_add_more_group_2'
        ,'value' => 'first'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
      ,array(
        'type' => 'group'
        ,'field' => 'test_add_more_nested_group'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_2'
            ,'value' => 'two'
          )
          ,array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_3'
            ,'value' => 'three'
          )
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'test_add_more_group_nested_4'
    ,'label' => __('Test ~ Add More Group Nested - 3 LEVELS')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'test_add_more_group_4_1'
        ,'value' => 'one'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'test_add_more_group_4_2'
        ,'value' => 'first'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
      ,array(
        'type' => 'group'
        ,'field' => 'test_add_more_nested_group_4_1'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_4_2'
            ,'value' => 'First Name'
          )
          ,array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_4_3'
            ,'value' => 'Last Name'
          )
          ,array(
            'type' => 'group'
            ,'field' => 'test_add_more_nested_group_5_1'
            ,'add_more' => true
            ,'fields' => array(
              array(
                'type' => 'select'
                ,'field' => 'test_add_more_nested_group_5_2'
                ,'value' => 'Home'
                ,'choices' => array(
                  'home' => 'Home'
                  ,'work' => 'Work'
                  ,'mobile' => 'Mobile'
                )
              )
              ,array(
                'type' => 'text'
                ,'field' => 'test_add_more_nested_group_5_3'
              )
            )
          )
        )
      )
    )
  ));

?>