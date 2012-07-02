<?php

class PikList_Add_On
{
  public static $available_add_ons = array();
  
  public static function _construct()
  {    
    add_action('init', array('piklist_add_on', 'init'), 0);
  }

  public static function init()
  {    
    self::include_add_ons();
  }
  
  public static function include_add_ons()
  { 
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
       
    $active_add_ons = piklist::get_settings('piklist', 'add-ons');
    
    piklist::$paths = apply_filters('piklist_register', piklist::$paths);

    $paths = array(
      piklist::$paths['plugin'] . '/add-ons'
    );

    $paths = apply_filters('piklist_add_on_paths', $paths);
    
    foreach ($paths as $path)
    {
      if (is_dir($path))
      {
        $add_ons = piklist::get_directory_list($path);
                
        foreach ($add_ons as $add_on)
        {
          $include = file_exists($path . '/' . $add_on . '/' . $add_on . '.php') ? $path . '/' . $add_on . '/' . $add_on . '.php' : $path . '/' . $add_on . '/plugin.php';
     
          if (file_exists($include))
          {
            $add_on_data = get_plugin_data($include);
            
            self::$available_add_ons[$add_on] = $add_on_data;

            if (in_array($add_on, is_array($active_add_ons) ? $active_add_ons : array($active_add_ons)))
            {
              include_once($include);

              $class_name = str_replace('pik_', 'piklist_', piklist::slug($add_on));

              if (class_exists($class_name) && method_exists($class_name, '_construct') && !is_subclass_of($class_name, 'WP_Widget'))
              {
                call_user_func(array($class_name, '_construct'));
              }
        
              piklist::$paths[$add_on] = $path . '/' . $add_on;
            }
          }
        }
      }
    }
    
    do_action('piklist_activate_add_on');
  }
}