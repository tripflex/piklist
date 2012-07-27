
<?php 
  wp_editor(
    isset($value) && !empty($value) ? $value : ''
    ,str_replace('_', '', $scope . $field)
    ,array_merge(
      isset($attributes) ? $attributes : array()
      ,array(
        'textarea_name' => piklist_form::get_field_name($field, $scope)
      )
    )
  );
?>