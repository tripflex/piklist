
<?php 
  wp_editor(
    isset($value) && !empty($value) ? $value : ''
    ,str_replace('_', '', $scope . $field)
    ,array_merge(
      isset($attributes) ? $attributes : array()
      ,array(
        'textarea_name' => piklist_form::get_field_name($field, $scope, false, $prefix)
        ,'wpautop' => true
        ,'media_buttons' => true
        ,'tabindex' => ''
        ,'editor_css' => ''
        ,'editor_class' => ''
        ,'teeny' => false
        ,'dfw' => false
        ,'tinymce' => true
        ,'quicktags' => true
      )
    )
  );
?>