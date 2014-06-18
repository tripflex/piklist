
<?php if ($list): ?>
  
  <<?php echo isset($list_type) ? $list_type : 'ul'; ?> class="piklist-field-list">

<?php endif; ?>

  <?php 
    $_index = 0;
    $value = is_array($value) && count($value) == 1 && !empty($value[0]) ? $value[0] : $value;
    foreach ($choices as $_value => $choice): 
  ?>
  
    <?php echo $list ? '<li>' : ''; ?>
  
      <label class="piklist-field-list-item <?php echo isset($attributes['class']) ? implode(' ', $attributes['class']) : null; ?>">
  
        <input 
          type="radio"
          id="<?php echo piklist_form::get_field_id($field, $scope, $_index, $prefix); ?>" 
          name="<?php echo piklist_form::get_field_name($field, $scope, false, $prefix);; ?>"
          value="<?php echo esc_attr($_value); ?>"
          <?php echo $value == $_value ? 'checked="checked"' : ''; ?>
          <?php echo piklist_form::attributes_to_string($attributes); ?>
        />
  
        <span class="piklist-list-item-label">
          <?php echo $choice; ?>
        </span>
    
      </label>

    <?php echo $list ? '</li>' : ''; ?>
  
    <?php $_index++; ?>
  
  <?php endforeach; ?>

<?php if ($list): ?>
  
  </<?php echo isset($list_type) ? $list_type : 'ul'; ?>>

<?php endif; ?>
