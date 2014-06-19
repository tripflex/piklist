<?php
/*
Width: 400
*/


  piklist('field', array(
    'type' => 'text'
    ,'field' => 'widget_title'
    ,'label' => __('Title:')
    ,'attributes' => array(
      'class' => 'regular-text'
    )
    ,'sanitize' => array(
      'file_name' => array()
    )
  ));

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload_media'
    ,'label' => __('Add File(s)','piklist')
    ,'options' => array(
      'modal_title' => __('Add File(s)','piklist')
      ,'button' => __('Add','piklist')
    )
    ,'validate' => array(
      'limit' => array(
        'min' => 1
        ,'max' => 1
      ))
  ));

?>