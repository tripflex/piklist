<?php

  $attributes['class'] = array_filter($attributes['class']) ? array_filter($attributes['class'],'trim') : array('large-text', 'code');
  $scope = 'comment';
  $field = !empty($field) ? $field : 'comment_content';

?>

<textarea
  id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
  name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
  <?php echo piklist_form::attributes_to_string($attributes); ?>
><?php echo esc_textarea($value); ?></textarea>


<?php

    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'comment_type'
      ,'value' => $post->post_status
    ));

    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'user_id'
      ,'value' => $current_user->ID
    ));
  
    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'comment_author'
      ,'value' => $current_user->display_name
    ));
  
    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'comment_author_email'
      ,'value' => $current_user->user_email
    ));
  
    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'comment_author_url'
      ,'value' => $current_user->user_url
    ));
  
    // TODO: This should be pulled from MASTER not post as post is not on front end...
    piklist('field', array(
      'type' => 'hidden'
      ,'scope' => 'comment'
      ,'field' => 'comment_post_ID'
      ,'value' => $post->ID
    ));

?>  