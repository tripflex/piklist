<?php
/*  
Title: Piklist Demo Search
Method: Get
Action: /piklist-demo
Filter: true
*/

  // SHORTCODE FOR THIS FORM: [piklist_form form="demo-search" add_on="piklist-demos"]


  // Hidden field: Which post type to search
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => false
    ,'field' => 'post_type'
    ,'value' => 'piklist_demo'
  ));

  // Hidden field: relationship for search  
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post_meta'
    ,'field' => 'relation'
    ,'value' => 'OR'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post_meta'
    ,'field' => 'text_class_small'
    ,'template' => 'theme_tight'
    ,'attributes' => array(
      'class' => 'search-filter'
      ,'placeholder' => 'Search by keyword'
    )
    ,'include_fields' => array(
      'demo_textarea_large'
      ,'select'
      ,'radio'
      ,'s'
    )
    ,'meta_query' => array(
      'compare' => 'LIKE'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'taxonomy'
    ,'field' => 'piklist_demo_type'
    ,'template' => 'theme_tight'
    ,'attributes' => array(
      'class' => 'search-filter'
    )
    ,'choices' => array('' => 'All Demo Types') + piklist(
      get_terms('piklist_demo_type', array(
        'hide_empty' => false
      ))
      ,array(
        'term_id'
        ,'name'
      )
    )
  ));
    
  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'filter'
    ,'value' => 'Search'
    ,'attributes' => array(
      'class' => 'button'
    )
  ));
  
?>