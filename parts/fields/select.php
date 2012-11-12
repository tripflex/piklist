
<select 
  id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
  name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
  <?php echo piklist_form::attributes_to_string($attributes); ?>
>
  <?php foreach ($choices as $choice_value => $choice): ?>
    <option value="<?php echo $choice_value; ?>" <?php echo $value == $choice_value ? 'selected="selected"' : ''; ?>><?php echo $choice; ?></option>
  <?php endforeach; ?>
</select>