
  <div 
    id="<?php echo piklist_form::get_field_id($field, $scope, $index); ?>" 
    <?php echo piklist_form::attributes_to_string($attributes); ?>
  >

    <?php echo wpautop($value); ?>
    
  </div>