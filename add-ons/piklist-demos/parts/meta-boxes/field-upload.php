<?php
/*
Title: Upload Fields <span class="piklist-title-right">Order 110</span>
Post Type: piklist_demo
Order: 110
Collapse: false
*/
  
  // Any field with the scope set to the field name of the upload field will be treated as related
  // data to the upload. Below we see we are setting the post_status and post_title, where the 
  // post_status is pulled dynamically on page load, hence the current status of the content is
  // applied. Have fun! ;)
  //
  // NOTE: If the post_status of an attachment is anything but inherit or private it will NOT be
  // shown on the Media page in the admin, but it is in the database and can be found using query_posts
  // or get_posts or get_post etc....  
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'post_status'
    ,'scope' => 'upload_simple'
    ,'label' => 'Attachment Status'
    ,'value' => $post->post_status
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'post_title'
    ,'scope' => 'upload_simple'
    ,'label' => 'Attachment Title'
    ,'value' => 'This is a fancy attachment title, go fancy!'
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