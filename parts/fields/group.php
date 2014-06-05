<?php 

  $columns_to_render = array();

  foreach ($fields as $column)
  {
    $index = $index ? $index : 0;
    $_values = null;

    $column['prefix'] = $prefix;
    
    if (isset($column['columns']) || !isset($column['label']))
    {
      $column['template'] = isset($column['template']) ? $column['template'] : 'field';
      $column['child_field'] = true;
    }
    
    if (in_array($column['type'], piklist_form::$field_list_types) || (isset($column['attributes']) && in_array('multiple', $column['attributes'])))
    {
      $column['multiple'] = true;
    }
    
    if (!isset($column['scope']) || is_null($column['scope']))
    {
      $stored_value = null;
      
      if (strrpos($column['field'], ':') > 0)
      {
        $field_name = substr($column['field'], strrpos($column['field'], ':') + 1);
      }
      else
      {
        $field_name = $column['field'];
      }

      if (isset($column['save_as']) && is_array($value) && isset($value[$column['save_as']]))
      {
        $stored_value = $value[$column['save_as']];
      }
      elseif (is_array($value) && isset($value[$field_name]))
      {
        $stored_value = $value[$field_name];
      }
      else
      {
        $stored_value = $value;
      }

      $_values = $stored_value;

      $column['field'] = (isset($field) ? '' : $field . ':' . ($index ? $index : '0') . ':') . $column['field'];
      $column['scope'] = $scope;
    }
    
    if (!$_values)
    {
      $_values = piklist_form::get_field_value($column['scope'], $column, $column['scope'], piklist_form::get_field_object_id($column));
    }

    if (!$_values && $value && is_array($value) && is_numeric(key($value)))
    {
      $_values = $value;
    }
    
    if (!is_array($_values))
    {
      $_values = array($_values);
    }    
    
    if (isset($column['multiple']) && $column['multiple'])
    {
      $column['value'] = $_values;
      $column['group_field'] = true;
      
      if (!isset($columns_to_render[$index]))
      {
        $columns_to_render[$index] = array();
      }
      
      if (!empty($field) && !stristr($column['field'], ':'))
      {
        $column['field'] = $field . (substr_count($field, ':') == 1 ? ':' . $column['index'] . ':' : ':') . $column['field'];
      }
      
      array_push($columns_to_render[$index], $column);
    }
    else
    {
      foreach ($_values as $_index => $_value)
      {
        if (!isset($columns_to_render[$_index]))
        {
          $columns_to_render[$_index] = array();
        }

        $column['value'] = $_value;      
        $column['index'] = $_index;
        $column['group_field'] = true;

        if (!empty($field) && !stristr($column['field'], ':'))
        {
          $column['field'] = $field . (substr_count($field, ':') == 1 ? ':' . $column['index'] . ':' : ':') . $column['field'];
        }
        
        array_push($columns_to_render[$_index], $column);
      }
    }
  }
  
  foreach ($columns_to_render as $column_to_render)
  {
    $group_add_more = false;
    $group_index = piklist::unique_id();
    
    foreach ($column_to_render as $column)
    {
      $column['attributes']['data-piklist-field-group'] = $group_index; 

      if ($column['type'] == 'group')
      {
        foreach ($column['fields'] as &$_field)
        {
          $_field['attributes']['data-piklist-field-sub-group'] = $group_index; 
        }
      }

      if ($column['type'] != 'group' && !$group_add_more && isset($attributes['data-piklist-field-addmore']))
      {
        $column['attributes']['data-piklist-field-addmore'] = $attributes['data-piklist-field-addmore'];
        $group_add_more = true;
        
        if (isset($attributes['data-piklist-field-addmore-actions']))
        {
          $column['attributes']['data-piklist-field-addmore-actions'] = $attributes['data-piklist-field-addmore-actions'];
        }
      }
      
      if ($column['type'] == 'group')
      {
        foreach ($column['fields'] as &$_field)
        {
          $_field['field'] = $column['field'] . ':' . $column['index'] . ':' . $_field['field']; 
        }
      }
      
      if (!empty($conditions))
      {
        $column['conditions'] = $conditions;
      }
      
      piklist_form::render_field($column);
    }
  }
  
?>