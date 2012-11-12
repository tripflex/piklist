<?php

class PikList_Admin
{
  private static $admin_pages;
  
  private static $admin_page_sections = array();
  
  private static $admin_page_tabs = array();
  
  private static $admin_page_default_tabs = array();
  
  private static $redirect_post_location_allowed = array(
    'admin_hide_ui'
  );
  
  public static function _construct()
  {    
    add_action('admin_head', array('piklist_admin', 'admin_head'));
    add_action('admin_menu', array('piklist_admin', 'admin_menu'));
    add_action('admin_print_styles', array('piklist_admin', 'admin_print_styles'));
    add_action('admin_print_scripts', array('piklist_admin', 'admin_print_scripts'), 100);
    add_action('redirect_post_location', array('piklist_admin', 'redirect_post_location'), 10, 2);
    // add_action('wp_scheduled_delete', array('piklist_admin', 'clear_transients'));

    add_filter('admin_footer_text', array('piklist_admin', 'admin_footer_text'));
  }

  public static function admin_menu()
  {
    self::add_admin_pages();
  }

  public static function admin_head()
  {
    if (self::hide_ui())
    {
      piklist::render('shared/admin-hide-ui');
    }
  }
  
  public static function admin_footer_text($footer_text)
  {
    return str_replace('</a>.', sprintf(__('</a> and <a href="%s">Piklist</a>.'), 'http://piklist.com'), $footer_text);
  }
  
  public static function hide_ui()
  {
    return isset($_REQUEST['piklist']['admin_hide_ui']) && $_REQUEST['piklist']['admin_hide_ui'] == 'true';
  }
  
  public static function redirect_post_location($location, $post_id)
  {
    if (isset($_REQUEST['piklist']))
    {
      $variables = array(
        'piklist' => array()
      );
      
      foreach ($_REQUEST['piklist'] as $key => $value)
      {
        if (in_array($key, self::$redirect_post_location_allowed))
        {
          $variables['piklist'][$key] = $value;
        }
      }
      
      $location .= '&' . http_build_query($variables);
    }
    
    return $location;
  }
  
  public static function add_admin_pages() 
  {
    self::$admin_pages = apply_filters('piklist_admin_pages', array());
    
    foreach (self::$admin_pages as $page)
    {
      if (isset($page['sub_menu']))
      {
        add_submenu_page($page['sub_menu'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], array('piklist_admin', 'admin_page'));
      }
      else
      {
        add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], array('piklist_admin', 'admin_page'), isset($page['icon_url']) ? $page['icon_url'] : null, isset($page['position']) ? $page['position'] : null);
        add_submenu_page($page['menu_slug'], $page['page_title'], $page['page_title'], $page['capability'], $page['menu_slug'], array('piklist_admin', 'admin_page'));
      }
      
      if (isset($page['default_tab']))
      {
        self::$admin_page_default_tabs[isset($page['setting']) ? $page['setting'] : $page['menu_slug']] = $page['default_tab'];
      }
      
      self::$admin_page_tabs[$page['menu_slug']] = array(
        'default' => array(
          'title' => isset($page['default_tab']) ? __($page['default_tab']) : __('General')
          ,'page' => null
        )
      );
    }
    
    piklist::process_views('admin-pages', array('piklist_admin', 'admin_pages_callback'));
  }
  
  public static function admin_pages_callback($arguments)
  {
    extract($arguments);
    
    $data = get_file_data($path . '/parts/' . $folder . '/' . $part, array(
              'title' => 'Title'
              ,'page' => 'Page'
              ,'tab' => 'Tab'
              ,'order' => 'Order'
            ));

    if (!empty($data['page']))
    {
      if (!isset(self::$admin_page_sections[$data['page']]))
      {
        self::$admin_page_sections[$data['page']] = array();
      }
    
      array_push(self::$admin_page_sections[$data['page']]
        ,array_merge($arguments
          ,array_merge($data
            ,array(
              'slug' => piklist::dashes("{$add_on} {$part}")
              ,'page' => piklist::dashes($add_on)
            )
          )
        )
      );
      
      $tab = !empty($data['tab']) ? piklist::dashes($data['tab']) : 'default';
      if (!isset(self::$admin_page_tabs[$data['page']][$tab]) && $tab)
      {
        self::$admin_page_tabs[$data['page']][$tab] = array(
          'title' => $data['tab']
          ,'page' => $tab
        );
      }
    
      uasort(self::$admin_page_sections[$data['page']], array('piklist', 'sort_by_order'));
    }
  }
  
  public static function admin_page() 
  {
    $page = false;

    foreach (self::$admin_pages as $admin_page)
    {
      if ($_REQUEST['page'] === $admin_page['menu_slug'])
      {
        $page = $admin_page;
    
        break;
      }
    }

    if ($page)
    {
      $setting_tabs = piklist_setting::get('setting_tabs');

      piklist::render('shared/admin-page', array(
        'section' => $page['menu_slug']
        ,'icon' => isset($page['icon']) ? $page['icon'] : false
        ,'single_line' => isset($page['single_line']) ? $page['single_line'] : true
        ,'title' => __($page['page_title'])
        ,'setting' => isset($page['setting']) ? $page['setting'] : false
        ,'tabs' => isset($page['setting']) && isset($setting_tabs[$page['setting']]) ? $setting_tabs[$page['setting']] : self::$admin_page_tabs[$page['menu_slug']]
        ,'page_sections' => isset(self::$admin_page_sections[$page['menu_slug']]) ? self::$admin_page_sections[$page['menu_slug']] : false
        ,'save' => isset($page['save']) ? $page['save'] : true
      ));
    }
  }
  
  public static function admin_print_styles()
  {
    wp_enqueue_style('thickbox');
    wp_enqueue_style('farbtastic');
    wp_enqueue_style('wp-pointer');

    wp_enqueue_style('piklist-admin', WP_PLUGIN_URL . '/piklist/parts/css/pik-admin.css', array(), false, 'screen, projection'); 
  }
  
  public static function admin_print_scripts()
  {
    wp_enqueue_script('theme-preview');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('farbtastic');
    wp_enqueue_script('wp-pointer');
    
    wp_enqueue_script('piklist-admin', WP_PLUGIN_URL . '/piklist/parts/js/pik-admin.js', array('jquery'), '0.1', true); 
    wp_enqueue_script('piklist', WP_PLUGIN_URL . '/piklist/parts/js/pik.js', array('jquery'), '0.1', true); 
  }

  public static function clear_transients()
  {
    global $wpdb, $_wp_using_ext_object_cache;

    if ($_wp_using_ext_object_cache)
    {
      return false;
    }

    $time = isset($_SERVER['REQUEST_TIME']) ? (int) $_SERVER['REQUEST_TIME'] : time();
    $expired = $wpdb->get_col($wpdb->prepare("SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_timeout%' AND CAST(option_value as INTEGER) < %d", $time));
    foreach ($expired as $transient) 
    {
      delete_transient(str_replace('_transient_timeout_', '', $transient));
    }
  }
  
  public static function get($variable)
  {
    return isset(self::$$variable) ? self::$$variable : false;
  }
  
}

?>