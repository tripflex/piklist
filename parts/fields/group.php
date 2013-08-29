<?php 
  $group_add_more = false;
  $group_index = substr(md5(rand()), 0, 7);
  foreach ($fields as $column)
  {
    if (isset($column['columns']) || !isset($column['label']))
    {
      $column['template'] = 'field';
      $column['child_field'] = true;
    }
    
    if (!isset($column['scope']) || is_null($column['scope']))
    {
      if (isset($column['save_as']) && isset($value[$column['save_as']]))
      {
        $column['value'] = $value[$column['save_as']];
      }
      
      if (isset($value[$column['field']]))
      {
        $column['value'] = $value[$column['field']];
      }

      $column['field'] = (isset($field) ? '' : $field . ':' . ($index ? $index : '0') . ':') . $column['field'];
      $column['scope'] = $scope;
    }

    $column['attributes']['data-piklist-field-group'] = $group_index; 
    
    if ($column['type'] != 'group' && !$group_add_more && isset($attributes['data-piklist-field-addmore']))
    {
      $column['attributes']['data-piklist-field-addmore'] = 'true';
      $group_add_more = true;
    }
    
    if ($column['type'] == 'group')
    {
      foreach ($column['fields'] as &$_field)
      {
        $_field['attributes']['data-piklist-field-sub-group'] = $group_index; 
      }
    }
    
    piklist('field', $column);
  }
?>