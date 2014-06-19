<?php

global $current_user;

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'from'
    ,'label' => __('From')
    ,'value' => $current_user->data->user_nicename
  ));

?>