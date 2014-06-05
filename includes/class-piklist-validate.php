<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Validate
{
  private static $errors = array();
  
  private static $fields = array();

  private static $validation_rules = array(
    'url' => array(
      'rule' => "/^((((https?|ftps?|gopher|telnet|nntp)://)|(mailto:|news:))(%[0-9A-Fa-f]{2}|[-()_.!~*';/?:@&=+$,A-Za-z0-9])+)([).!';/?:,][[:blank:]])?$/"
      ,'message' => 'is not a valid url.'
    )
    ,'ip-address' => array(
      'rule' => "/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"
      ,'message' => 'is not a valid ip address.'
    )
    ,'email' => array(
      'rule' => "/^[a-zA-Z0-9+&*-]+(?:\.[a-zA-Z0-9_+&*-]+)*@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,7}$/"
      ,'message' => 'is not a valid email address.'
    )
    ,'safe-text' => array(
      'rule' => "/^[a-zA-Z0-9 .-]+$/"
      ,'message' => 'contains invalid characters. Must contain only letters and numbers.'
    )
    ,'credit-card' => array(
      'rule' => "/^((4\d{3})|(5[1-5]\d{2})|(6011)|(7\d{3}))-?\d{4}-?\d{4}-?\d{4}|3[4,7]\d{13}$/"
      ,'message' => 'is not a valid credit card number.'
    )
    ,'callback-test-by-type-number' => array(
      'callback' => array('piklist_validate', 'callback_test_by_type_number')
    )
  );

  private static $id = false;
  
  private static $parameter = 'piklist_validate';
  
  public static function _construct()
  {
    add_filter('wp_redirect', array('piklist_validate', 'wp_redirect'), 10, 2);
        
    add_action('admin_notices', array('piklist_validate', 'admin_notices'));
    add_action('piklist_widget_notices', array('piklist_validate', 'admin_notices'));
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
      $messages = array();
      foreach (self::$errors as $type => $fields)
      {
        foreach ($fields as $field => $errors)
        {
          $messages = array_merge($messages, $errors);
        }
      }
      
      piklist::render('shared/admin-notice', array(
        'type' => 'error'
        ,'messages' => $messages
      ));
    }
  }
  
  public static function check()
  {
    if (!isset($_REQUEST[piklist::$prefix]['fields_id']) || !$data = get_transient(piklist::$prefix . $_REQUEST[piklist::$prefix]['fields_id'])) 
    {
      return false;
    }

    self::$validation_rules = apply_filters('piklist_validation_rules', self::$validation_rules);
  
    foreach ($data as $type => &$fields)
    {
      foreach ($fields as &$field)
      {
        $p = isset($field['name']) ? array_filter(explode('[', str_replace(']', '', $field['name']))) : false;
        
        if ($p && isset($_REQUEST[$p[0]]) && isset($field['field']))
        {
          $value = piklist::array_path_get($_REQUEST[$p[0]], explode(':', $field['field']));
          
          $field['valid'] = true;
          $field['request_value'] = is_array($value) ? array_filter($value, array('piklist', 'array_filter')) : $value;
          
          if (isset($field['required']) && $field['required'] && (isset($field['request_value']) && empty($field['request_value'])))
          {
            self::add_error($field, __(' is a required field.', 'piklist'));
          }
          
          if (isset($field['validate']))
          {
            if (!is_array($field['validate']))
            {
              $field['validate'] = array($field['validate']);
            }
            
            foreach ($field['validate'] as $validate)
            {
              if (isset(self::$validation_rules[$validate]))
              {
                $validate = self::$validation_rules[$validate];
                
                if (isset($validate['rule']))
                {
                  foreach ($field['request_value'] as $request_value)
                  {
                    if (!preg_match($validate['rule'], $request_value))
                    {
                      self::add_error($field, $validate['message']);
                      break;
                    }
                  }
                }
            
                if (isset($validate['callback']))
                {
                  foreach ($field['request_value'] as $request_value)
                  {
                    $result = call_user_func_array($validate['callback'], array($request_value, $field));
              
                    if ($result !== true)
                    {
                      self::add_error($field, $result);
                      break;
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    
    self::set_errors($_REQUEST[piklist::$prefix]['fields_id']);
        
    return empty(self::$errors);
  }
  
  private static function add_error(&$field, $message)
  {
    $field['valid'] = false;
    
    $name = isset($field['label']) && !empty($field['label']) ? $field['label'] : (isset($field['field']) ? $field['field'] : __('Field'));
    
    if (!isset(self::$errors[$field['scope']][$field['field']]))
    {
      self::$errors[$field['scope']][$field['field']] = array();
    }
    
    array_push(self::$errors[$field['scope']][$field['field']], '<strong>' . $name . '</strong> ' . $message);
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
  
  
  // TODO: Remove as this is a temp for testing
  public static function callback_test_by_type_number($validate, $field)
  {
    if (strlen($validate) < 3)
    {
      return __('should be at least 3 charactars long.');
    }
    
    return true;
  }
}