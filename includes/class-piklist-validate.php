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

  private static $validation_rules = array();

  private static $sanitization_rules = array();
    
  public static function _construct()
  {
    add_action('admin_notices', array('piklist_validate', 'admin_notices'));
    add_action('piklist_widget_notices', array('piklist_validate', 'admin_notices'));

    add_filter('wp_redirect', array('piklist_validate', 'wp_redirect'), 10, 2);
    add_filter('piklist_validation_rules', array('piklist_validate','validation_rules'));
    add_filter('piklist_sanitization_rules', array('piklist_validate','sanitation_rules'));
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
  
  public static function check(&$stored_data = null)
  {
    if (!isset($_REQUEST[piklist::$prefix]['fields_id']) || !$data = get_transient(piklist::$prefix . $_REQUEST[piklist::$prefix]['fields_id'])) 
    {
      return false;
    }
    
    self::$validation_rules = apply_filters('piklist_validation_rules', self::$validation_rules);
    self::$sanitization_rules = apply_filters('piklist_sanitization_rules', self::$sanitization_rules);
  
    foreach ($data as $type => &$fields)
    {
      foreach ($fields as &$field)
      {
        $p = isset($field['name']) ? array_filter(explode('[', str_replace(']', '', $field['name']))) : false;
        
        if ($p)
        {
          if (!is_null($stored_data))
          {
            $request_data = &$stored_data;
          }
          else
          {
            if (isset($_REQUEST['widget-id']) && isset($_REQUEST['multi_number']) && isset($_REQUEST['widget_number']) && isset($_REQUEST[$p[0]]))
            {
              $widget_index = !empty($_REQUEST['multi_number']) ? $_REQUEST['multi_number'] : $_REQUEST['widget_number'];
              $request_data = &$_REQUEST[$p[0]][$widget_index];
            }
            else if (isset($_REQUEST[$p[0]]))
            {
              $request_data = &$_REQUEST[$p[0]];
            }
          }
          
          if (isset($request_data) && isset($field['field']))
          {
            $value = piklist::array_path_get($request_data, explode(':', $field['field']));

            $field['valid'] = true;
            $field['request_value'] = is_array($value) ? array_filter($value, array('piklist', 'array_filter')) : $value;
                   
            if (isset($field['required']) && $field['required'] && (isset($field['request_value']) && empty($field['request_value'])))
            {
              self::add_error($field, "&nbsp;" . __('is a required field.', 'piklist'));
            }

            if (isset($field['sanitize']))
            {
              foreach ($field['sanitize'] as $sanitize)
              {
                if (isset(self::$sanitization_rules[$sanitize['type']]))
                {
                  $sanitization = array_merge(self::$sanitization_rules[$sanitize['type']], $sanitize);
                  
                  if (isset($sanitization['callback']))
                  {
                    foreach ($field['request_value'] as &$request_value)
                    {
                      $request_value = call_user_func_array($sanitization['callback'], array($request_value, $field, isset($sanitize['options']) ? $sanitize['options'] : array()));
                      $request_value = is_array($request_value) ? $request_value : array($request_value);
                      
                      piklist::array_path_set($request_data, explode(':', $field['field']), $request_value);
                    }
                  }
                }
              }
            }
          
            if (isset($field['validate']))
            {
              foreach ($field['validate'] as $validate)
              {
                if (isset(self::$validation_rules[$validate['type']]))
                {
                  $validation = array_merge(self::$validation_rules[$validate['type']], $validate);
                  
                  if (isset($validation['rule']))
                  {
                    foreach ($field['request_value'] as $request_value)
                    {
                      if (!preg_match($validation['rule'], $request_value))
                      {
                        self::add_error($field, $validation['message']);
                        
                        break;
                      }
                    }
                  }
            
                  if (isset($validation['callback']))
                  {
                    foreach ($field['request_value'] as $request_value)
                    {
                      $validation_result = call_user_func_array($validation['callback'], array($request_value, $field, isset($validate['options']) ? $validate['options'] : array()));
              
                      if ($validation_result !== true)
                      {
                        self::add_error($field, isset($validation['message']) ? $validation['message'] : (is_string($validation_result) ? $validation_result : __('is not valid input', 'piklist')));
                        
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
    
    array_push(self::$errors[$field['scope']][$field['field']], '<strong>' . $name . '</strong>' . "&nbsp;" . $message);
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

  
  

  /**
   * Included Validation Callbacks
   */
  
  public static function validation_rules()
  {
    $validation_rules = array(
      'email' => array(
        'callback' => array('piklist_validate', 'validate_email')
      )
      ,'email_domain' => array(
        'callback' => array('piklist_validate', 'validate_email_domain')
      )
      ,'file_exists' => array(
        'callback' => array('piklist_validate', 'validate_file_exists')
      )
      ,'html' => array(
        'rule' => "/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/"
        ,'message' => __('is not valid HTML', 'piklist')
      )
      ,'image' => array(
        'callback' => array('piklist_validate', 'validate_image')
      )
      ,'ip_address' => array(
        'rule' => "/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"
        ,'message' => __('is not a valid ip address.', 'piklist')
      )
      ,'limit' => array(
        'callback' => array('piklist_validate', 'validate_limit')
      )
      ,'range' => array(
        'callback' => array('piklist_validate', 'validate_range')
      )
      ,'safe_text' => array(
        'rule' => "/^[a-zA-Z0-9 .-]+$/"
        ,'message' => __('contains invalid characters. Must contain only letters and numbers.', 'piklist')
      )
      ,'url' => array(
        'rule' => "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/"
        ,'message' => __('is not a valid url.', 'piklist')
      )
    );

    return $validation_rules;
  }


  /**
   * Validate email address
   * @param  $email
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_email($email, $field, $arguments)
  {
    return is_email($email) ? true : __('does not contain a valid Email Address.', 'piklist');
  }

  /**
   * Validate email address domain
   *
   * When checkdnsrr() returns false, it also returns a php warning.
   * The warning is being suppressed, since it will return a validation message.
   * 
   * @param  $email
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_email_domain($email, $field, $arguments)
  {
    return (bool) @checkdnsrr(preg_replace('/^[^@]++@/', '', $email), 'MX') ? true : __('does not contain a valid Email Domain.', 'piklist');
  }

  /**
   * Validate a file exists
   *
   * When file_get_contents() returns false, it also returns a php warning.
   * The warning is being suppressed, since it will return a validation message.
   * 
   * @param  $file
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_file_exists($file, $field, $arguments)
  {
    return @file_get_contents($file) ? true : __('contains a file that does not exist.', 'piklist');
  }

  /**
   * Validate an image file exists
   *
   * When exif_imagetype() returns false, it also returns a php warning.
   * The warning is being suppressed, since it will return a validation message.
   * 
   * @param  $file
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_image($file, $field, $arguments)
  {
    return @exif_imagetype($file) ? true : __('contains a file that is not an image.', 'piklist');
  }

  /**
   * Validate how many items are in request value
   *
   * Request value can be any Piklist field.
   * 
   * @param  $value
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_limit($value, $field, $arguments)
  {
    extract($arguments);

    $min = isset($min) ? $min : 1;
    $count = count($field['request_value']);

    $grammar = $field['type'] == 'file' || $field['add_more'] == 1 ? __('added','piklist') : __('selected','piklist');

    if ($count < $min)
    {
      return sprintf(__('must have at least %1$s %2$s.', 'piklist'), $min, $grammar);
    }

    if (isset($max))
    {
      if ($count > $max)
      {
        return sprintf(__('cannot have more than %1$s %2$s.', 'piklist'), $max, $grammar);
      }
    }

    return true;
  }

  /**
   * Validate if a numbered value is within a range.
   * 
   * @param  $value
   * @param  $field 
   * @param  $arguments
   * @return bool true if string is email, message otherwise.
   */
  public static function validate_range($value, $field, $arguments)
  {
    extract($arguments);

    $min = isset($arguments['min']) ? $arguments['min'] : 1;
    $max = isset($arguments['max']) ? $arguments['max'] : 10;

    if (($field['request_value'][0] >= $min) && ($field['request_value'][0] <= $max))
    {
      return true;
    }
    else
    {
      return sprintf(__('contains a value that is not between %s and %s', 'piklist'), $min, $max);
    }
  }
  
  
  
  /**
   * Included Sanitation Callbacks
   */
  
  public static function sanitation_rules()
  {
    $sanitization_rules = array(
      'email' => array(
        'callback' => array('piklist_validate', 'sanitize_email')
      )
      ,'file_name' => array(
        'callback' => array('piklist_validate', 'sanitize_file_name')
      )
      ,'html_class' => array(
        'callback' => array('piklist_validate', 'sanitize_html_class')
      )
      ,'text_field' => array(
        'callback' => array('piklist_validate', 'sanitize_text_field')
      )
      ,'title' => array(
        'callback' => array('piklist_validate', 'sanitize_title')
      )
      ,'user' => array(
        'callback' => array('piklist_validate', 'sanitize_user')
      )
      ,'wp_kses' => array(
        'callback' => array('piklist_validate', 'sanitize_wp_kses')
      )
      ,'wp_kses_data' => array(
        'callback' => array('piklist_validate', 'sanitize_wp_kses_data')
      )
      ,'wp_kses_post' => array(
        'callback' => array('piklist_validate', 'sanitize_wp_kses_post')
      )
    );

    return $sanitization_rules;
  }

  public static function sanitize_email($value, $field)
  {   
    return sanitize_email($value);
  }

  public static function sanitize_file_name($value, $field)
  {
    return sanitize_file_name($value);
  }

  public static function sanitize_html_class($class, $field, $arguments)
  {
    extract($arguments);
    
    return sanitize_html_class($class, isset($fallback) ? $fallback : null);
  }
  

  public static function sanitize_text_field($value, $field)
  {
    return sanitize_text_field($value);
  }

  public static function sanitize_title($value, $field, $arguments)
  {
    extract($arguments);
    
    return sanitize_title($value, isset($fallback_title) ? $fallback_title : null, isset($context) ? $context : null);
  }

  public static function sanitize_user($username, $field, $arguments)
  {
    extract($arguments);
    
    return sanitize_user($username, isset($strict) ? $strict : null);
  }

  public static function sanitize_wp_kses($value, $field, $arguments)
  {
    extract($arguments);
    
    return wp_kses($value, isset($allowed_html) ? $allowed_html : null, isset($allowed_protocols) ? $allowed_protocols : null);
  }

  public static function sanitize_wp_kses_post($value, $field)
  {
    return wp_kses_post($value);
  }

  public static function sanitize_wp_kses_data($value, $field)
  {
    return wp_kses_data($value);
  }

}