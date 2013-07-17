<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Shortcode
{
  public static function _construct()
  {    
    add_action('init', array('piklist_shortcode', 'init'));
  }

  public static function init()
  {
    self::widget_shortcode();
  }
  
  public static function widget_shortcode()
  {
    if (get_user_option('rich_editing') == 'true') 
    {
      add_filter('mce_external_plugins', array('piklist_shortcode', 'mce_external_plugins'));
      add_filter('mce_buttons', array('piklist_shortcode', 'mce_buttons'));
    }
  }
  
  public static function mce_buttons($buttons) 
  {
    array_push($buttons, 'separator', 'piklist_shortcode');
    return $buttons;
  }

  public static function mce_external_plugins($plugins) 
  {
    $plugins['piklist_shortcode'] = content_url() . '/plugins/piklist/parts/js/piklist-tinymce-shortcode.js';
    return $plugins;
  }
}