<?php
/*
Width: 800
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'widget_title'
    ,'label' => __('Title')
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'editor'
    ,'field' => 'editor_content'
    ,'template' => 'field'
    ,'options' => array (
      'editor_height' => 380
      ,'dfw' => false
      ,'quicktags' => true
      ,'drag_drop_upload' => true
    )
  ));

?>