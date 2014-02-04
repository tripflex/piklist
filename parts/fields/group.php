<?php 

  $columns_to_render = array();

  foreach ($fields as $column)
  {
    $column['prefix'] = $prefix;
    
    if (isset($column['columns']) || !isset($column['label']))
    {
      $column['template'] = 'field';
      $column['child_field'] = true;
    }
    
    if (!isset($column['scope']) || is_null($column['scope']))
    {
      $stored_value = null;
      
      if (isset($column['save_as']) && isset($value[$column['save_as']]))
      {
        $stored_value = $value[$column['save_as']];
      }

      if (isset($value[$column['field']]))
      {
        $stored_value = $value[$column['field']];
      }
      
      if (!$stored_value && !isset($column['attributes']['placeholder']) && !in_array($column['type'], piklist_form::get('field_list_types')))
      {
        $column['attributes']['placeholder'] = htmlspecialchars($column['value']);
      }
      else if ($stored_value)
      {
        $column['value'] = $stored_value;
      }

      $column['field'] = (isset($field) ? '' : $field . ':' . ($index ? $index : '0') . ':') . $column['field'];
      $column['scope'] = $scope;
    }

    $_values = piklist_form::get_field_value($column['scope'], $column, $column['scope'], piklist_form::get_field_object_id($column));
    
    if (!is_array($_values))
    {
      $_values = array($_values);
    }
        
    if (in_array($column['type'], piklist_form::get('field_list_types')))
    {
      $column['value'] = $_values;
      $column['group_field'] = true;
      
      array_push($columns_to_render, array($column));
    }
    else
    {
      foreach ($_values as $_index => $_value)
      {
        if (!isset($columns_to_render[$_index]))
        {
          $columns_to_render[$_index] = array();
        }
    
        if (!$_value && !isset($column['attributes']['placeholder']) && !in_array($column['type'], piklist_form::get('field_list_types')))
        {
          $column['attributes']['placeholder'] = htmlspecialchars(is_array($column['value']) ? current($column['value']) : $column['value']);
        }
        else if ($_value)
        {
          $column['value'] = piklist::is_flat($_value) ? $_value : $_value; //current($_value);
        }

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
        $column['attributes']['data-piklist-field-addmore'] = 'true';
        $group_add_more = true;
      }
      
      if ($column['type'] == 'group')
      {
        foreach ($column['fields'] as &$_field)
        {
          $_field['field'] = $column['field'] . ':' . $column['index'] . ':' . $_field['field']; 
        }
      }
      
      piklist_form::render_field($column);
    }
  }
  
?>