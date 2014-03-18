<?php
/*
Title: File Upload
Setting: piklist_demo_fields
Tab: Upload
Order: 30
*/

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload'
    ,'label' => 'File'
    ,'options' => array(
      'title' => 'Add Media'
      ,'button' => 'Add Media'
    )
  ));
  
  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload_basic'
    ,'label' => 'File ~ Basic'
    ,'options' => array(
      'basic' => true
    )
  ));