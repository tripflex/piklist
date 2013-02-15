<?php

class PikList_Admin
{
  private static $admin_pages;
  
  private static $admin_page_sections = array();
  
  private static $admin_page_tabs = array();
  
  private static $admin_page_default_tabs = array();
  
  private static $locked_plugins = array();
  
  private static $redirect_post_location_allowed = array(
    'admin_hide_ui'
  );
  
  public static function _construct()
  {  
    add_action('admin_init', array('piklist_admin', 'admin_init'));
    add_action('admin_head', array('piklist_admin', 'admin_head'));
    add_action('admin_menu', array('piklist_admin', 'admin_menu'));
    add_action('admin_print_styles', array('piklist_admin', 'admin_print_styles'));
    add_action('admin_print_scripts', array('piklist_admin', 'admin_print_scripts'), 100);
    add_action('redirect_post_location', array('piklist_admin', 'redirect_post_location'), 10, 2);
    add_action('load-plugins.php', array('piklist_admin', 'deactivation_link'));
    
    // add_action('wp_scheduled_delete', array('piklist_admin', 'clear_transients'));

    add_filter('admin_footer_text', array('piklist_admin', 'admin_footer_text'));
  }

  public static function admin_init()
  {
    $path = WP_CONTENT_DIR . '/plugins/piklist/piklist.php';
    $data = get_file_data($path, array(
              'version' => 'Version'
            ));

    if ($data['version'])
    {
      self::check_update('piklist/piklist.php', $data['version']);
    }
 
    self::$locked_plugins = apply_filters('piklist_locked_plugins', array('piklist/piklist.php'));

    add_action('in_plugin_update_message-piklist/piklist.php', array('piklist_admin', 'update_available'), null, 2);
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

  public static function update_available($pluginData, $newPluginData)
  {
    require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

    $plugin = plugins_api('plugin_information', array( 'slug' => $newPluginData->slug));

    if (!$plugin || is_wp_error($plugin) || empty($plugin->sections['changelog']))
    {
      return;
    }

    $changes = $plugin->sections['changelog'];

    $pos = strpos($changes, '<h4>' . preg_replace('/[^\d\.]/', '', $pluginData['Version']));
    
    if ($pos !== false)
    {
      $changes = trim( substr( $changes, 0, $pos ) );
    }

    $replace_header = '<h4 style="color:red; margin-bottom:0;">' . __('Updating is recommended, here\'s why:','piklist') . '</h4>';

    $start_pos = strrpos($changes, "<h4>");
    $end_pos = strrpos($changes, "</h4>");
    $string_length = $end_pos - $start_pos;

    $changes = substr_replace($changes, $replace_header, $start_pos, $string_length);

    $replace = array(
                  '<ul>' => '<ul style="list-style: disc inside; padding-left: 15px; font-weight: normal;">'
                );

    echo str_replace(array_keys($replace), $replace, $changes);
  }
  
  public static function admin_footer_text($footer_text)
  {
    return str_replace('</a>.', sprintf(__('%1$s and %2$sPiklist%1$s.','piklist'), '</a>', '<a href="http://piklist.com">'), $footer_text);
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

  public static function deactivation_link()
  {
    $deactivation_link = piklist::get_settings('piklist', 'deactivation_link');

    if ($deactivation_link !== 'lock')
    {
      return;
    }

    foreach (self::$locked_plugins as $locked)
    {
      add_filter('plugin_action_links_' . plugin_basename($locked), array('piklist_admin', 'replace_deactivation_link'));
    }
    
    add_filter('option_active_plugins', array('piklist_admin', 'active_plugins')); 
  }

  public static function replace_deactivation_link($actions)
  {
    unset($actions['deactivate']);
    
    array_unshift($actions, '<a href="' . admin_url('admin.php?page=piklist-settings&referer=plugins.php') . '">' . __('Settings') . '</a>'); 

    return $actions;
  }

  public static function active_plugins($plugins)
  {
    foreach (self::$locked_plugins as $locked_plugin)
    {
      if (!array_search($locked_plugin, $plugins))
      {
        array_push($plugins, $locked_plugin);
      }
    }
    
    return $plugins;
  }

  /**
   * Check Update
   *
   * Run update script if plugin version is greater than stored version.
   *
   * @Credit Scribu for inspiration
   * http://core.trac.wordpress.org/ticket/14912
   *
   * @param string $file plugin directory and file name.
   * @param string $version version of plugin.
   */
  public static function check_update($file, $version)
  {
    global $pagenow;

    if (!in_array($pagenow, array('plugins.php', 'update-core.php', 'update.php', 'index.php')) || !is_admin() || !current_user_can('manage_options'))
    {
      return;
    }
     
    $plugin = plugin_basename($file);

    if (is_plugin_active_for_network($plugin))
    {
      $versions = get_site_option('piklist_active_plugin_versions', array());
      $network_wide = true;
    }
    else if (is_plugin_active($plugin))
    {
      $versions = get_option('piklist_active_plugin_versions', array());
      $network_wide = false;
    }
    else
    {
      return;
    }

    // $operator param is temporary fix for this first install.
    // will be removed in next version of Piklist
    if (!isset($versions[$plugin]))
    {
      $operator = '>=';
      $versions[$plugin] = array($version);
    }
    else
    {
      $operator = '>';
    }

    $current_version = current($versions[$plugin]);

    if (version_compare($version, $current_version, $operator))
    {
      self::get_update($file, $version, $current_version);
      
      array_unshift($versions[$plugin], $version);
    }

    if ($network_wide)
    { 
      update_site_option('piklist_active_plugin_versions', $versions);
    }
    else
    { 
      update_option('piklist_active_plugin_versions', $versions);
    }
  }

  public static function get_update($file, $version, $current_version)
  {
    $updates_url = WP_CONTENT_DIR . '/plugins/' . dirname($file) . '/parts/updates/';
    $updates = piklist::get_directory_list($updates_url);

    if ($updates)
    {
      array_multisort($updates);
    }
    else
    {
      return;
    }

    $operator = $current_version ? '=' : '>='; // Upgrade : Install
    $valid_updates = array();
    foreach ($updates as $update)
    {
      $update_version_number = rtrim($update, '.php');

      if (version_compare($version, $update_version_number, $operator))
      {
        $update_code = file_get_contents($updates_url . $update);      
        $stripped_update_code = str_ireplace(array('<?php', '<?', '?>'), '', $update_code);
        $update_function = create_function('', $stripped_update_code);
        $valid_updates[$update] = $update_function;
      }
    }

    if ($valid_updates)
    {
      piklist::check_network_propagate(array('piklist_admin', 'run_update'), $valid_updates);
    }
  }

  public static function run_update($valid_updates)
  {
    piklist::performance();
    
    foreach ($valid_updates as $valid_update)
    {
      $function = $valid_update;
      $function();
    }
  }

}

?>