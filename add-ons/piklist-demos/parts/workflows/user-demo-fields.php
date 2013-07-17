<?php
/*
Title: Custom
Order: 20
Flow: User Demo
*/
   
  piklist('include_user_profile_fields', array(
    'sections' => array(
      'piklist_usermeta_box'
      )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>