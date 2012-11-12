
<?php if ($list): ?>
  
  <<?php echo isset($list_type) ? $list_type : 'ul'; ?> class="piklist-field-list">

<?php endif; ?>

  <?php 
    $values = array_keys($choices);
    for ($index = 0; $index < count($choices); $index++):
  ?>

    <?php echo $list ? '<li>' : ''; ?>
    
      <label class="piklist-field-list-item <?php echo isset($attributes['class']) ? implode(' ', $attributes['class']) : null; ?>">
  
        <input 
          type="checkbox"
          id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
          name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
          value="<?php echo $values[$index]; ?>"
          <?php echo (!is_array($value) && $value == $values[$index]) || (is_array($value) && in_array($values[$index], $value)) ? 'checked="checked"' : ''; ?>
          <?php echo piklist_form::attributes_to_string($attributes); ?>
        />

        <span>
          <?php echo $choices[$values[$index]]; ?>
        </span>
    
      </label>
  
    <?php echo $list ? '</li>' : ''; ?>

  <?php endfor; ?>
  
<?php if ($list): ?>

  </<?php echo isset($list_type) ? $list_type : 'ul'; ?>>

<?php endif; ?>