<?php
/*
Width: 400
*/
?>


	<?php

	  piklist('field', array(
	    'type' => 'text'
	    ,'field' => 'widget_title'
	    ,'label' => __('Title:')
	    ,'attributes' => array(
	      'class' => 'regular-text'
	    )
	  ));

	?>


<ul class="wp-tab-bar">
  <li class="wp-tab-active"><a href="#"><?php _e('Basic'); ?></a></li>
  <li><a href="#"><?php _e('HTML ID\'s'); ?></a></li>
</ul>


<div class="wp-tab-panel">

	<?php

		piklist('field', array(
			'type' => 'text'
			,'field' => 'label_username'
			,'label' => __('"Username" label')
			,'value' => 'Username'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

		piklist('field', array(
			'type' => 'text'
			,'field' => 'label_password'
			,'label' => __('"Password" label')
			,'value' => 'Password'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

		piklist('field', array(
			'type' => 'text'
			,'field' => 'label_log_in'
			,'label' => __('"Log in" button label')
			,'value' => 'Log In'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

		piklist('field', array(
		  'type' => 'checkbox'
		  ,'field' => 'remember'
		  ,'value' => 'false'
		  ,'choices' => array(
		    'true' => 'Enable "Remember Me"'
		  )
		));

		piklist('field', array(
			'type' => 'text'
			,'field' => 'label_remember'
			,'label' => __('"Remember Me" label')
			,'value' => 'Remember Me'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
      ,'conditions' => array(
        array(
          'field' => 'remember'
          ,'value' => 'true'
        )
      )
		));

		piklist('field', array(
			'type' => 'select'
			,'field' => 'value_remember'
			,'label' => __('"Remember Me" status')
			,'value' => 'Remember Me'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
			,'choices' => array(
				'true' => __('Default On','piklist')
				,'false' => __('Default Off','piklist')
				)
      ,'conditions' => array(
        array(
          'field' => 'remember'
          ,'value' => 'true'
        )
      )
		));

		piklist('field', array(
			'type' => 'text'
			,'field' => 'redirect'
			,'label' => __('Redirect after login')
			,'description' => sprintf(__('URL to redirect to.%sMust be absolute (i.e. http://example.com/mypage/).%sRecommended: site_url(\'/mypage/\')','piklist'), '<br>', '<br>')
			,'value' => 'site_url( $_SERVER[\'REQUEST_URI\'] )'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));


	 ?>


</div>

<div class="wp-tab-panel">

	<?php

			piklist('field', array(
			'type' => 'text'
			,'field' => 'form_id'
			,'label' => __('Form ID')
			,'value' => 'loginform'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

			piklist('field', array(
			'type' => 'text'
			,'field' => 'id_username'
			,'label' => __('Username ID')
			,'value' => 'user_login'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

			piklist('field', array(
			'type' => 'text'
			,'field' => 'id_password'
			,'label' => __('Password ID')
			,'value' => 'user_pass'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

			piklist('field', array(
			'type' => 'text'
			,'field' => 'id_remember'
			,'label' => __('Remember Me ID')
			,'value' => 'rememberme'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

			piklist('field', array(
			'type' => 'text'
			,'field' => 'id_submit'
			,'label' => __('Submit Button ID')
			,'value' => 'wp-submit'
			,'attributes' => array(
			  'class' => 'regular-text'
			)
		));

	?>


</div>

<?php




// 	$args = array(
// 	'echo'           => true
// 	,'redirect'       => site_url( $_SERVER['REQUEST_URI'] ) //
// 	,'form_id'        => 'loginform' //
// 	,'label_username' => __( 'username' ) //
// 	,'label_password' => __( 'Password' )//
// 	,'label_remember' => __( 'Remember Me' )//
// 	,'label_log_in'   => __( 'Log In' )//
// 	,'id_username'    => 'user_login' //
// 	,'id_password'    => 'user_pass' //
// 	,'id_remember'    => 'rememberme' //
// 	,'id_submit'      => 'wp-submit' //
// 	,'remember'       => true //
// 	,'value_username' => NULL
// 	,'value_remember' => false //
// );


// wp_login_form($args);



?>