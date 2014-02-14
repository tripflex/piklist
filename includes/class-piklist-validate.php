<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Validate
{
  private static $errors = array();
  
  private static $fields = array();

  private static $id = false;
  
  private static $parameter = 'piklist_validate';
  
  public static function _construct()
  {
    add_filter('wp_redirect', array('piklist_validate', 'wp_redirect'), 10, 2);
        
    add_action('admin_notices', array('piklist_validate', 'admin_notices'));
  }

  public static function wp_redirect($location, $status)
  {
    global $pagenow;
    
    if (self::$id && $status == 302)
    {
      if ($pagenow == 'edit-tags.php')
      {
        $location = preg_replace('/&?piklist_validate=[^&]*/', '', $_SERVER['HTTP_REFERER']);
      }

      $location .= (stristr($location, '?') ? (substr($location, -1) == '&' ? '' : '&') : '?') . 'piklist_validate=' . self::$id;
    }
    else
    {
      if ($pagenow == 'edit-tags.php')
      {
        foreach (array('action', 'tag_ID', self::$parameter) as $variable)
        {
          $location = preg_replace('/&?' . $variable . '=[^&]*/', '', $location);
        }
      }
    }

    return $location;
  }
  
  public static function admin_notices()
  {
    self::get_errors();
    
    if (!empty(self::$errors))
    {
      $error_messages = array();
      foreach (self::$errors as $type => $errors)
      {
        foreach ($errors as $field => $message)
        {
          array_push($error_messages, $message);
        }
      }
      
      piklist::render('shared/admin-notice', array(
        'type' => 'error'
        ,'message' => $error_messages
      ));
    }
  }
  
  public static function check()
  {
    if (!isset($_REQUEST[piklist::$prefix]['fields_id']) || !$data = get_transient(piklist::$prefix . $_REQUEST[piklist::$prefix]['fields_id'])) 
    {
      return false;
    }
    
    foreach ($data as $type => &$fields)
    {
      foreach ($fields as &$field)
      {
        $p = isset($field['name']) ? explode('[', str_replace(']', '', $field['name'])) : false;
        
        if ($p && isset($_REQUEST[$p[0]]))
        {
          if (is_array($_REQUEST[$p[0]]))
          {
            if (isset($_REQUEST[$p[0]][$p[1]]))
            {
              $field['request_value'] = $_REQUEST[$p[0]][$p[1]];
            }
            else if (isset($_REQUEST[$p[0]][0]))
            {
              $field['request_value'] = $_REQUEST[$p[0]][0];
            }
          }
          else
          {
            $field['request_value'] = $_REQUEST[$p[0]];
          }

          if (isset($field['request_value']))
          {
            $field['request_value'] = is_array($field['request_value']) ? array_filter($field['request_value'], array('piklist', 'array_filter')) : $field['request_value'];
          }
        }
        else
        {
          // TODO: Handle Group Fields
        }
      }
    }
    
    // Validate inputs
    foreach ($data as $type => &$fields)
    {
      foreach ($fields as &$field)
      {
        $field['valid'] = true;
        $name = isset($field['label']) && !empty($field['label']) ? $field['label'] : (isset($field['field']) ? $field['field'] : __('Field'));

        // Lets check to see if its required
        if (isset($field['required']) && $field['required'] && (isset($field['request_value']) && empty($field['request_value'])))
        {
          $field['valid'] = false;

          self::$errors[$field['scope']][$field['field']] =  __('<strong>' . $name . '</strong> is a required field.');
        }
        
        // TODO: Check for filter and run it
        // TODO: Check for callback and apply it 
      }
    }
    
    self::set_errors($_REQUEST[piklist::$prefix]['fields_id']);
    
    return empty(self::$errors);
  }
  
  private static function set_errors($fields_id)
  {
    if (!empty(self::$errors))
    {
      self::$id = substr(md5($fields_id), 0, 10);
      
      $set = set_transient(piklist::$prefix . 'validation_' . self::$id, self::$errors);
    }
  }
  
  public static function get_errors()
  {
    if (isset($_REQUEST[self::$parameter]))
    {
      self::$id = $_REQUEST[self::$parameter];
      self::$errors = get_transient(piklist::$prefix . 'validation_' . self::$id);
      
      delete_transient(piklist::$prefix . 'validation_' . self::$id);      
    }
  }
  
  public static function errors($field, $scope)
  {
    return isset(self::$errors[$scope][$field]);
  }
}