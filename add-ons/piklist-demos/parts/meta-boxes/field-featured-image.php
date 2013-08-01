<?php
/*
Title: Featured Image(s) <span class="piklist-title-right">Order 30</span>
Post Type: piklist_demo
Order: 30
Priority: default
Context: side
Collapse: false
*/
  
  piklist('field', array(
    'type' => 'file'
    ,'field' => '_thumbnail_id'
    ,'scope' => 'post_meta'
    ,'options' => array(
      'title' => 'Set featured image(s)'
      ,'button' => 'Set featured image(s)'
    )
  ));
  
  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));