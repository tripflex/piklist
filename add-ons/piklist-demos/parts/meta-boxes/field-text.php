<?php
/*
Title: Text Fields <span class="piklist-title-right">Order 10</span>
Post Type: piklist_demo
Order: 10
Collapse: true
*/

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_class_small'
    ,'label' => __('Small')
    ,'description' => __('class="small-text"')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'small-text'
    )
    ,'position' => 'start'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_columns_element'
    ,'label' => __('Columns Element')
    ,'description' => __('columns="6"')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'columns' => 6
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_add_more'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('add_more="true" columns="8"')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'columns' => 8
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_nested'
    ,'label' => __('Nested Field')
    ,'description' => __('This [field=text_nested_select] is nested in the description.')
    ,'value' => 'Lorem'
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'text_nested_select'
        ,'value' => 'second'
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'number'
    ,'field' => 'number'
    ,'scope' => 'post_meta'
    ,'label' => __('Number')
    ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 5
    ,'attributes' => array(
      'class' => 'small-text'
      ,'step' => 5
      ,'min' => 5
    )
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'scope' => 'post_meta'
    ,'field' => 'demo_textarea_large'
    ,'label' => __('Large Code')
    ,'description' => __('class="large-text code" rows="10" columns="50"')
    ,'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
    ,'position' => 'end'
  ));

  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>