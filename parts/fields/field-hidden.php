
<input 
  type="hidden"
  id="<?php echo piklist_form::get_field_id($field, $scope, $index); ?>" 
  name="<?php echo piklist_form::get_field_name($field, $scope, $index); ?>"
  value="<?php echo $value; ?>" 
  <?php echo piklist_form::attributes_to_string($attributes); ?>
/>
