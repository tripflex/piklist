<?php
/*  
Title: Piklist Demo Submit
Method: post
Action: /piklist-demo 
*/


// SHORTCODE FOR THIS FORM: [piklist_form form="demo-submit" add_on="piklist-demos"]


  // Set Post Type
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_type'
    ,'value' => 'piklist_demo'
  ));

  // Set Post Status after submit
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_status'
    ,'value' => 'demo' // Standard WP status or Piklist custom status
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post'
    ,'field' => 'post_title'
    ,'label' => 'Title'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post'
    ,'field' => 'post_content'
    ,'label' => 'Description'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_required'
    ,'label' => 'Text Required'
    ,'description' => "required => true"
    ,'attributes' => array(
      'class' => 'small-text'
    )
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_null'
    ,'label' => 'Text Null'
    ,'value' => 'null'
    ,'description' => "required => true"
    ,'attributes' => array(
      'class' => 'small-text'
    )
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_false'
    ,'label' => 'Text False'
    ,'value' => 'false'
    ,'description' => "required => true"
    ,'attributes' => array(
      'class' => 'small-text'
    )
    ,'required' => true
  ));
    
  piklist('field', array(
    'type' => 'textarea'
    ,'scope' => 'post_meta'
    ,'label' => 'Text Area'
    ,'field' => 'demo_textarea_large'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select'
    ,'label' => 'Select'
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
  ));

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'radio'
    ,'label' => 'Radio'
    ,'list' => false
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'taxonomy'
    ,'field' => 'piklist_demo_type'
    ,'label' => 'Demo Types (custom taxonomy)'
    ,'choices' => piklist(
      get_terms('piklist_demo_type', array(
        'hide_empty' => false
      ))
      ,array(
        'term_id'
        ,'name'
      )
    )
  ));

  // Submit Button
  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'filter'
    ,'value' => 'Submit'
    ,'attributes' => array(
      'class' => 'button'
    )
  ));
  
?>