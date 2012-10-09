<?php
/*
Title: Conditional Fields
Setting: piklist_demo_fields
Tab: Advanced
Order: 40
*/

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'show_hide'
    ,'label' => __('Toggle a field')
    ,'choices' => array(
      'show' => 'Show'
      ,'hide' => 'Hide'
    )
    ,'value' => 'hide'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'show_hide_field'
    ,'label' => __('Show/Hide Field')
    ,'description' => __('This field is toggled by the field above')
    ,'conditions' => array(
      array(
        'field' => 'show_hide'
        ,'value' => 'show'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'change'
    ,'label' => __('Update a field')
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
    ,'label' => __('Update This Field')
    ,'description' => __('This field is updated by the field above')
  ));