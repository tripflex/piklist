<?php
/*
Setting: piklist_core
Order: 20
*/


  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'multiple_user_roles'
    ,'label' => __('Muliple User Roles', 'piklist')
    ,'description' => __('Users can be assigned multiple roles.', 'piklist')
  	,'help' => __('Changes the user role dropdown to a select box.', 'piklist')
    ,'choices' => array(
      'true' => __('Allow', 'piklist')
    )
  ));

  
?>