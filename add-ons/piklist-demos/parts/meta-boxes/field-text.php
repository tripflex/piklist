<?php
/*
Title: Text Fields <span class="piklist-title-right">Order 10</span>
Post Type: piklist_demo
Order: 10
Collapse: false
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_class_small'
    ,'label' => 'Small'
    ,'description' => 'class="small-text"'
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'small-text'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_columns_element'
    ,'label' => 'Columns Element'
    ,'description' => 'columns="6"'
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'columns' => 6
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'add_more="true" columns="8"'
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'columns' => 8
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'number'
    ,'field' => 'number'
    ,'label' => 'Number'
    ,'description' => 'ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'value' => 5
    ,'attributes' => array(
      'class' => 'small-text'
      ,'step' => 5
      ,'min' => 5
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'demo_textarea_large'
    ,'label' => 'Large Code'
    ,'description' => 'class="large-text code" rows="10" columns="50"'
    ,'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>