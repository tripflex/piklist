<?php
/*
Title: Conditional Fields <span class="piklist-title-right">Order 90</span>
Post Type: piklist_demo
Order: 90
Collapse: false
*/

  piklist('field', array(
    'type' => 'radio'
    ,'scope' => 'post_meta'
    ,'field' => 'show_hide'
    ,'label' => __('Toggle a field')
    ,'choices' => array(
      'show' => 'Show'
      ,'hide' => 'Hide'
    )
    ,'value' => 'hide'
    ,'position' => 'start'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'show_hide_field'
    ,'label' => __('Show/Hide Field')
    ,'description' => __('This field is toggled by the field above')
    ,'conditions' => array(
      array(
        'field' => 'show_hide'
        ,'scope' => 'post_meta'
        ,'value' => 'show'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'radio'
    ,'scope' => 'post_meta'
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
        ,'scope' => 'post_meta'
        ,'value' => 'hello-world' 
        ,'update' => 'Hello World!' 
        ,'type' => 'update'
      )
      ,array(
        'field' => 'update_field'
        ,'scope' => 'post_meta'
        ,'value' => 'clear' 
        ,'update' => '' 
        ,'type' => 'update'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'update_field'
    ,'label' => __('Update This Field')
    ,'description' => __('This field is updated by the field above')
    ,'position' => 'end'
  ));
  
?>