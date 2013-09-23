<?php
/*
Post Type: piklist_demo
Order: 100
Lock: true
Meta box: false
*/

  piklist('field', array(
    'type' => 'editor'
    ,'field' => 'post_content'
    ,'scope' => 'post'
    ,'label' => 'Post Content'
    ,'description' => 'This is the standard post box, now placed in a Piklist WorkFlow.'
    ,'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'attributes' => array (
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
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));
  
?>