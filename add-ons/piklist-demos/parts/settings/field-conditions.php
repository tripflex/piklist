<?php
/*
Title: Conditional Fields
Setting: piklist_demo_fields
Tab: Advanced
Order: 40
*/

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'show_hide_select'
    ,'label' => 'Select: toggle a field'
    ,'choices' => array(
      'show' => 'Show'
      ,'hide' => 'Hide'
    )
    ,'value' => 'hide'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'show_hide_field_select'
    ,'label' => 'Show/Hide Field 1' 
    ,'description' => 'This field is toggled by the Select field above'
    ,'conditions' => array(
      array(
        'field' => 'show_hide_select'
        ,'value' => 'show'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'show_hide_field_select_2'
    ,'label' => 'Show/Hide Field 2'
    ,'description' => 'This field is toggled by the Select field above'
    ,'conditions' => array(
      array(
        'field' => 'show_hide_select'
        ,'value' => 'show'
      )
    )
  ));

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'show_hide'
    ,'label' => 'Radio: toggle a field'
    ,'choices' => array(
      'show' => 'Show'
      ,'hide' => 'Hide'
    )
    ,'value' => 'hide'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'show_hide_field'
    ,'label' => 'Show/Hide Field'
    ,'description' => 'This field is toggled by the Radio field above'
    ,'conditions' => array(
      array(
        'field' => 'show_hide'
        ,'value' => 'show'
      )
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'show_hide_checkbox'
    ,'label' => 'Checkbox: toggle a field'
    ,'choices' => array(
      'show' => 'Show'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'show_hide_field_checkbox'
    ,'label' => 'Show/Hide Field'
    ,'description' => 'This field is toggled by the Checkbox field above'
    ,'conditions' => array(
      array(
        'field' => 'show_hide_checkbox'
        ,'value' => 'show'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'change'
    ,'label' => 'Update a field'
    ,'choices' => array(
      'hello-world' => 'Hello World'
      ,'clear' => 'Clear'
    )
    ,'value' => 'hello-world'
    ,'conditions' => array(
      array(
        'field' => 'update_field'
        ,'value' => 'hello-world' 
        ,'update' => 'Hello World!' 
        ,'type' => 'update'
      )
      ,array(
        'field' => 'update_field'
        ,'value' => 'clear' 
        ,'update' => '' 
        ,'type' => 'update'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'update_field'
    ,'value' => 'Hello World!' 
    ,'label' => 'Update This Field'
    ,'description' => 'This field is updated by the field above'
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'enable_field_below'
    ,'label' => 'Auto Enable Example'
    ,'description' => 'This field is updated by using the field below'
    ,'choices' => array(
      'enable' => 'Enable'
    )
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'enable_description'
    ,'label' => 'Description'
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
    ,'conditions' => array(
      array(
        'field' => 'enable_field_below_0'
        ,'value' => ':any' 
        ,'update' => 'enable' 
        ,'type' => 'update'
      )
      ,array(
        'field' => 'enable_field_below_0'
        ,'value' => ''
        ,'update' => null 
        ,'type' => 'update'
      )
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Settings Section'
  ));

?>