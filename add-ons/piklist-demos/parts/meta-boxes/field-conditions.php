<?php
/*
Title: Conditional Fields <span class="piklist-title-right">Order 90</span>
Post Type: piklist_demo
Order: 90
Collapse: false
*/

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'show_hide'
    ,'label' => 'Toggle a field'
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
    ,'description' => 'This field is toggled by the field above'
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
    ,'label' => 'Update This Field'
    ,'description' => 'This field is updated by the field above'
  ));
  
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>