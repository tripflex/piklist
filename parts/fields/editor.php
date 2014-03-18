
<?php 
  wp_editor(
    isset($value) && !empty($value) ? $value : ''
    ,isset($id) ? $id : ('piklisteditor' . piklist::unique_id())
    ,array_merge(
      array(
        'textarea_name' => piklist_form::get_field_name($field, $scope, false, $prefix) . ($add_more ? '" data-piklist-field-addmore="true' : null)
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
      ,isset($options) && is_array($options) ? $options : array()
    )
  );
?>