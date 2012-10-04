<?php
/*
Title: WYSIWYG Editor
Setting: piklist_demo_fields
Tab: Advanced
Order: 20
*/

  piklist('field', array(
    'type' => 'editor'
    ,'field' => 'editor'
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
  ));
  
