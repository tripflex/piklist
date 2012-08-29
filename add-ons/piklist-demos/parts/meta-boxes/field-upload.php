<?php
/*
Title: Upload Fields <span class="piklist-title-right">Order 110</span>
Post Type: piklist_demo
Order: 110
Collapse: false
*/
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'post_status'
    ,'scope' => 'upload_simple'
    ,'label' => 'Attachment Status'
    ,'value' => $post->post_status
  ));
  
  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload_simple'
    ,'scope' => 'post'
    ,'label' => 'Attach File(s)'
    ,'value' => 'Upload'
  ));
  
  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>