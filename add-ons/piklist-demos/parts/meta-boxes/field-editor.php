<?php
/*
Title: WYSIWYG Editor <span class="piklist-title-right">Locked | Order 100</span>
Post Type: piklist_demo
Order: 100
Lock: true
*/

  piklist('field', array(
    'type' => 'editor'
    ,'field' => 'demo_editor'
    ,'label' => 'HTML Content'
    ,'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));

  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>