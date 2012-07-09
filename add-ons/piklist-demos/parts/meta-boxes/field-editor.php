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
    ,'label' => __('HTML Content')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'attributes' => array(
      'wpautop' => true
      ,'media_buttons' => true
      ,'tabindex' => ''
      ,'editor_css' => ''
      ,'editor_class' => ''
      ,'teeny' => false
      ,'dfw' => false
      ,'tinymce' => true
      ,'quicktags' => true
    )
    ,'position' => 'wrap'
  ));

  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>