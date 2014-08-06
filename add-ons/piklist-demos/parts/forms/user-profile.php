<?php
/*  
Title: User Profile
Method: post
Message: User Profile Saved.
*/

  // [piklist_form form="user-profile" add_on="piklist-demos"]
  
  $current_user = wp_get_current_user();
  $user_meta = get_user_meta($current_user->ID);

  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'user'
    ,'field' => 'ID'
    ,'value' => $current_user->ID
  ));

?>

<h3><?php _e('Name', 'piklist-demo'); ?></h3>

<?php

  piklist('field', array(
    'type' => 'html'
    ,'scope' => 'user'
    ,'field' => 'user_login'
    ,'label' => 'User login'
    ,'value' => $current_user->user_login
  ));

  piklist('field', array(
    'type' => 'password'
    ,'scope' => 'user'
    ,'field' => 'user_pass'
    ,'label' => 'Password'
    //,'value' => $current_user->user_pass
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'first_name'
    ,'label' => 'First name'
    ,'value' => $current_user->user_firstname
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'last_name'
    ,'label' => 'Last name'
    ,'value' => $current_user->user_lastname
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'nickname'
    ,'label' => 'Nickname'
    ,'value' => $current_user->user_nicename
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'display_name'
    ,'label' => 'Display name'
    ,'value' => $current_user->display_name
  ));

?>

<h3><?php _e('Contact Info', 'piklist-demo'); ?></h3>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'user_email'
    ,'label' => 'Email'
    ,'value' => $current_user->user_email
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user'
    ,'field' => 'user_url'
    ,'label' => 'Website'
    ,'value' => $current_user->user_url
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user_meta'
    ,'field' => 'user_url'
    ,'label' => 'Twitter ID'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'user_meta'
    ,'field' => 'description'
    ,'label' => 'Biographical Info'
  ));

?>

<h3><?php _e('Personal Options', 'piklist-demo'); ?></h3>

<?php

  piklist('field', array(
    'type' => 'checkbox'
    ,'scope' => 'user_meta'
    ,'field' => 'comment_shortcuts'
    ,'label' => 'Keyboard Shortcuts'
    ,'choices' => array(
      'true' => __('Enable keyboard shortcuts for comment moderation.', 'piklist-demo')
      )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'scope' => 'user_meta'
    ,'field' => 'show_admin_bar_front'
    ,'label' => 'Toolbox'
    ,'choices' => array(
      'true' => __('Show Toolbar when viewing site', 'piklist-demo')
      )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Submit'
  ));