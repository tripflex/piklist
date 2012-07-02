
<?php

  $attributes['class'] = empty($attributes['class']) ? array('large-text', 'code') : $attributes['class']; 

?>

<textarea
  id="<?php echo piklist_form::get_field_id($field, $scope, $index); ?>" 
  name="<?php echo piklist_form::get_field_name($field, $scope, $index); ?>"
  <?php echo piklist_form::attributes_to_string($attributes); ?>
><?php echo $value; ?></textarea>
