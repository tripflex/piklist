
<?php if ($list): ?>
  
  <<?php echo isset($list_type) ? $list_type : 'ul'; ?> class="piklist-field-list">

<?php endif; ?>
  
  <?php 
    $values = array_keys($choices);
    for ($_index = 0; $_index < count($choices); $_index++):
  ?>

    <?php echo $list ? '<li>' : ''; ?>
    
      <?php if ($_index == 0): ?>
        
        <input 
          type="hidden"
          id="<?php echo piklist_form::get_field_id($field, $scope, $index, $prefix); ?>" 
          name="<?php echo piklist_form::get_field_name($field, $scope, $index, $prefix); ?>"
          value=""
         />
      
      <?php endif; ?>
    
      <label class="piklist-field-list-item <?php echo isset($attributes['class']) ? implode(' ', $attributes['class']) : null; ?>">
  
        <input 
          type="checkbox"
          id="<?php echo piklist_form::get_field_id($field, $scope, $_index, $prefix); ?>" 
          name="<?php echo piklist_form::get_field_name($field, $scope, $_index, $prefix); ?>"
          value="<?php echo esc_attr($values[$_index]); ?>"
          <?php echo (!is_array($value) && ($value == $values[$_index])) || (is_array($value) && (in_array($values[$_index], $value) || isset($value[$values[$_index]]))) ? 'checked="checked"' : ''; ?>
          <?php echo piklist_form::attributes_to_string($attributes); ?>
        />

        <span class="piklist-list-item-label">
          <?php echo $choices[$values[$_index]]; ?>
        </span>
    
      </label>
  
    <?php echo $list ? '</li>' : ''; ?>

  <?php endfor; ?>
  
<?php if ($list): ?>

  </<?php echo isset($list_type) ? $list_type : 'ul'; ?>>

<?php endif; ?>