<?php
/*  
Title: Login Form
Description: Fully configurable login form.
*/

$args = array(
	'echo'           => true
	,'redirect'       => $settings['redirect']
	,'form_id'        => $settings['form_id']
	,'label_username' => $settings['label_username']
	,'label_password' => $settings['label_password']
	,'label_remember' => $settings['label_remember']
	,'label_log_in'   => $settings['label_log_in']
	,'id_username'    => $settings['id_username']
	,'id_password'    => $settings['id_password']
	,'id_remember'    => $settings['id_remember']
	,'id_submit'      => $settings['id_submit']
	,'remember'       => $settings['remember']
	,'value_username' => NULL
	,'value_remember' => $settings['value_remember']
);


?>


<?php echo $before_widget; ?>

  <?php echo $before_title; ?>
  
  <?php echo $after_title; ?>
    
	<?php wp_login_form($args); ?>
    
<?php echo $after_widget; ?>
