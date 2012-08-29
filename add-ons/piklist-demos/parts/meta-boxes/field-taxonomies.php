<?php
/*
Title: Taxonomies <span class="piklist-title-right">Order 110</span>
Post Type: piklist_demo
Order: 110
Priority: default
Context: side
Collapse: false
*/

  piklist('field', array(
    'type' => 'checkbox'
    ,'scope' => 'taxonomy'
    ,'field' => 'piklist_demo_type'
    ,'label' => 'Demo Types'
    ,'choices' => array(
      'tutorial' => 'Tutorial'
      ,'video' => 'Video'
      ,'presentation' => 'Presentation'
    )
  ));

  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>