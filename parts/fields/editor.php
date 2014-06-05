
<?php 
  
  $name = piklist_form::get_field_name($field, $scope, false, $prefix);
  
  wp_editor(
    isset($value) && !empty($value) ? $value : ''
    ,isset($id) ? $id : (piklist::unique_id() . 'piklisteditor' . preg_replace('/[^a-z0-9]+/i', '', $name))
    ,array_merge(
      array(
        'textarea_name' => $name . ($add_more ? '" data-piklist-field-addmore="true' : null)
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