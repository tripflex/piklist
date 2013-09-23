<?php
/*
Title: Taxonomies <span class="piklist-title-right">Order 20</span>
Post Type: piklist_demo
Order: 20
Priority: default
Context: side
Collapse: true
*/

  piklist('field', array(
    'type' => 'checkbox'
    ,'scope' => 'taxonomy'
    ,'field' => 'piklist_demo_type'
    ,'label' => 'Demo Types'
    ,'description' => 'Terms will appear when they are added to this taxonomy.'
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

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));
  
?>