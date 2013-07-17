<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Dashboard
{
  private static $widgets = array();
  
  public static function _construct()
  { 
    add_action('wp_dashboard_setup', array('piklist_dashboard', 'register_dashboard_widgets'));
    add_action('wp_network_dashboard_setup', array('piklist_dashboard', 'register_dashboard_widgets'));
  }

  public static function register_dashboard_widgets()
  {
    piklist::process_views('dashboard', array('piklist_dashboard', 'register_dashboard_widgets_callback'));
  }

  public static function register_dashboard_widgets_callback($arguments)
  {
    global $current_screen;

    extract($arguments);
    
    $file = $path . '/parts/' . $folder . '/' . $part;
    
    $data = get_file_data($file, array(
              'title' => 'Title'
              ,'capability' => 'Capability'
              ,'network' => 'Network'
            ));

    if (($data['network'] == 'only') && ($current_screen->id != 'dashboard-network'))
    {
      return;
    }

    if ((empty($data['network']) || $data['network'] == 'false') && $current_screen->id == 'dashboard-network')
    {
      return;
    }

    if ((isset($data['capability']) && current_user_can($data['capability'])) || empty($data['capability']))
    {
      $id = piklist::dashes($add_on . '-' . $part);

      self::$widgets[$id] = array(
        'id' => $id
        ,'file' => $file
        ,'data' => $data
      );

      wp_add_dashboard_widget(
        $id
        ,self::$widgets[$id]['data']['title']
        ,array('piklist_dashboard', 'render_widget')
      );
    }
  }

  public static function render_widget($null, $data)
  {
    piklist::render(self::$widgets[$data['id']]['file']);
  }
}