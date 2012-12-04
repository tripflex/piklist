<?php

class PikList_Setting
{
  private static $setting_tabs = array();

  private static $settings;
  
  private static $active_section = null;
  
  public static function _construct()
  {    
    add_action('admin_init', array('piklist_setting', 'register_settings'));

    add_filter('piklist_admin_pages', array('piklist_setting', 'admin_pages'));
  }

  public static function admin_pages($pages) 
  {
    $pages[] = array(
      'page_title' => 'About'
      ,'menu_title' => 'Piklist'
      ,'capability' => 'manage_options'
      ,'menu_slug' => 'piklist'
      ,'single_line' => false
      ,'icon_url' => plugins_url('piklist/parts/img/piklist-icon.png') 
      ,'icon' => 'piklist-page'
      ,'default_tab' => 'Introduction'
    );
    
    $pages[] = array(
      'page_title' => 'Piklist Settings'
      ,'menu_title' => 'Settings'
      ,'capability' => 'manage_options'
      ,'sub_menu' => 'piklist'
      ,'menu_slug' => 'piklist-settings'
      ,'setting' => 'piklist'
      ,'single_line' => false
      ,'icon_url' => plugins_url('piklist/parts/img/piklist-icon.png') 
      ,'icon' => 'piklist-page'
      ,'default_tab' => 'General'
    );

    return $pages;
  }
  
  public static function get($variable)
  {
    return isset(self::$$variable) ? self::$$variable : false;
  }

  public static function register_settings()
  { 
    piklist::process_views('settings', array('piklist_setting', 'register_settings_callback'));
    
    $default_tabs = piklist_admin::get('admin_page_default_tabs');
    
    foreach (self::$settings as $setting => $sections)
    {
      add_filter('pre_update_option_' . $setting, array('piklist_setting', 'pre_update_option'), 10, 2);
      register_setting($setting, $setting, array('piklist_setting', 'validate_setting'));
      
      uasort($sections, array('piklist', 'sort_by_order'));
      
      self::$setting_tabs[$setting] = array(
        'default' => array(
          'title' => isset($default_tabs[$setting]) ? __($default_tabs[$setting]) : __('General','piklist')
          ,'page' => null
        )
      );
      
      foreach ($sections as $section) 
      {
        $tab = !empty($section['tab']) ? piklist::dashes($section['tab']) : 'default';
        if (!isset(self::$setting_tabs[$setting][$tab]) && $tab)
        {
          self::$setting_tabs[$setting][$tab] = array(
            'title' => $section['tab']
            ,'page' => $tab
          );
        }

        if ((isset($_REQUEST['tab']) && isset($section['tab']) && $_REQUEST['tab'] == $tab) || (!isset($_REQUEST['tab']) && empty($section['tab'])))
        {
          self::$active_section = $section;
          
          ob_start();

            include $section['path'] . '/parts/' . $section['folder'] . '/' . $section['part'];
            
            $output = trim(ob_get_contents());

          ob_end_clean();
        
          self::$active_section = null;
          
          add_settings_section($section['slug'], $section['title'], create_function('', !empty($output) ? 'echo "' . addslashes($output) . '";' : 'return false;'), $setting);
        }
      }
    }
  }

  public static function register_setting($field)
  {
    add_settings_field(
      $field['field']
      ,isset($field['label']) ? $field['label'] : null
      ,array('piklist_setting', 'render_setting')
      ,self::$active_section['setting']
      ,self::$active_section['slug']
      ,array(
        'field' => $field
        ,'section' => self::$active_section
        //,'label_for' => $field['field'] Change to ID
      ) 
    );
  }

  public static function register_settings_callback($arguments)
  {
    extract($arguments);
    
    $data = get_file_data($path . '/parts/' . $folder . '/' . $part, array(
              'title' => 'Title'
              ,'setting' => 'Setting'
              ,'tab' => 'Tab'
              ,'order' => 'Order'
            ));
    
    if (!isset(self::$settings[$data['setting']]))
    {
      self::$settings[$data['setting']] = array();
    }
    
    array_push(self::$settings[$data['setting']]
      ,array_merge($arguments
        ,array_merge($data
          ,array(
            'slug' => piklist::dashes("{$add_on} {$part}")
            ,'page' => piklist::dashes($add_on)
          )
        )
      )
    );
  }

  public static function pre_update_option($new, $old = false)
  {
    $fields = get_transient(piklist::$prefix . $_REQUEST['piklist']['fields_id']);
    $_old = $old;
    
    foreach (current($fields) as $field => $data)
    {
      if (!isset($new[$field]) && isset($_old[$field]))
      {
        unset($_old[$field]);
      }
    }
    
    $settings = wp_parse_args($new, $_old);

    return apply_filters('piklist_pre_update_option', $settings, $new, $old);
  }

  public static function render_setting($setting)
  { 
    piklist_form::render_field(wp_parse_args(
      array(
        'scope' => $setting['section']['setting']
        ,'disable_label' => true
        ,'position' => false
        ,'value' => piklist_form::get_field_value($setting['section']['setting'], $setting['field'], 'option')
      )
      ,$setting['field']
    ));
  }
  
  public static function validate_setting($setting)
  {
    // NOTE: Validation

    return $setting;
  }
}

?>