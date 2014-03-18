<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Theme
{
  private static $themes;

  private static $post_class;
    
  public static function _construct()
  {    
    self::$themes = piklist::get_directory_list(piklist::$paths['piklist'] . '/themes');
    
    add_action('init', array('piklist_theme', 'init'));
    add_action('setup_theme', array('piklist_theme', 'setup_theme'));

    add_action('wp_head', array('piklist_theme', 'conditional_scripts_start'), -1);
    add_action('wp_footer', array('piklist_theme', 'conditional_scripts_start'), -1);
    add_action('admin_head', array('piklist_theme', 'conditional_scripts_start'), -1);
    add_action('admin_footer', array('piklist_theme', 'conditional_scripts_start'), -1);

    add_action('wp_head', array('piklist_theme', 'conditional_scripts_end'), 101);
    add_action('wp_footer', array('piklist_theme', 'conditional_scripts_end'), 101);
    add_action('admin_head', array('piklist_theme', 'conditional_scripts_end'), 101);
    add_action('admin_footer', array('piklist_theme', 'conditional_scripts_end'), 1001);
    
    add_filter('body_class', array('piklist_theme', 'body_class'));
    add_filter('post_class', array('piklist_theme', 'post_class'));
    
    add_filter('piklist_assets', array('piklist_theme', 'assets'));
  }
  
  public static function init()
  {    
    self::register_assets();
    self::register_themes();
  }
  
  public static function setup_theme()
  {
    if (is_dir($path = get_stylesheet_directory() . '/piklist'))
    {
      piklist::$paths['theme'] = $path;
    }
    
    if (get_template_directory() != get_stylesheet_directory() && is_dir($path = get_template_directory() . '/piklist'))
    {
      piklist::$paths['parent-theme'] = $path;
    }   
  }
  
  public static function assets($assets)
  {
    array_push($assets['scripts'], array(
      'handle' => 'piklist'
      ,'src' => piklist::$urls['piklist'] . '/parts/js/piklist.js'
      ,'ver' => piklist::$version
      ,'deps' => 'jquery'
      ,'enqueue' => true
      ,'in_footer' => true
      ,'admin' => true
    ));
    
    array_push($assets['scripts'], array(
      'handle' => 'jquery.placeholder'
      ,'src' => piklist::$urls['piklist'] . '/parts/js/jquery.placeholder.js'
      ,'ver' => '1.0'
      ,'deps' => 'jquery'
      ,'enqueue' => true
      ,'in_footer' => true
      ,'admin' => true
    ));
    
    // TODO: Dependency
    wp_enqueue_script('jquery-ui-sortable');

    return $assets;
  }
  
  public static function conditional_scripts_start()
  {
    ob_start();
  }
  
  public static function conditional_scripts_end()
  {
    $output = ob_get_contents();
    
    ob_end_clean();

    global $wp_scripts;

    foreach ($wp_scripts->registered as $script)
    {
      if (isset($script->extra['conditional']))
      {
        $src = $script->src . '?ver=' . (!empty($script->ver) ? $script->ver : get_bloginfo('version'));
        $tag = "<script type='text/javascript' src='{$src}'></script>\n";
        $output = str_replace($tag, "<!--[if {$script->extra['conditional']}]>\n{$tag}<![endif]-->\n", $output);
      }
    }

    echo $output;
  }
  
  public static function register_themes()
  {
    foreach (piklist::$paths as $type => $path)
    {
      if (is_dir($path . '/themes') && $type != 'theme')
      {
        register_theme_directory($path . '/themes');
      }
    }
  }
  
  public static function register_assets()
  {
    global $wp_scripts, $wp_styles;
    
    $assets = apply_filters('piklist_assets', array(
      'scripts' => array()
      ,'styles' => array()
    ));
    
    $assets_to_enqueue = array(
      'scripts' => array()
      ,'styles' => array()
    );
    
    foreach ($assets as $type => $list)
    {    
      foreach ($assets[$type] as $asset)
      {
        if (!is_admin() || (isset($asset['admin']) && $asset['admin']))
        {
          if (isset($asset['deps']) && !is_array($asset['deps']))
          {
            $asset['deps'] = array($asset['deps']);
          }
          
          if ($type == 'scripts')
          {
            wp_register_script($asset['handle'], $asset['src'], isset($asset['deps']) ? $asset['deps'] : array(), isset($asset['ver']) ? $asset['ver'] : false, isset($asset['in_footer']) ? $asset['in_footer'] : true);
            
            if (isset($asset['condition']))
            {
              $wp_scripts->add_data($asset['handle'], 'conditional', $asset['condition']);
            }
          }
          else if ($type == 'styles')
          {
            wp_register_style($asset['handle'], $asset['src'], isset($asset['deps']) ? $asset['deps'] : array(), isset($asset['ver']) ? $asset['ver'] : false, isset($asset['media']) ? $asset['media'] : false);
          
            if (isset($asset['condition']))
            {
              $wp_styles->add_data($asset['handle'], 'conditional', $asset['condition']);
            }
          }
          
          if (isset($asset['enqueue']) && $asset['enqueue'])
          {
            array_push($assets_to_enqueue[$type], array(
              'handle' => $asset['handle']
              ,'admin' => isset($asset['admin']) ? $asset['admin'] : false
            ));
          }
        }
      }
    }
    
    foreach ($assets_to_enqueue as $type => $assets)
    {
      foreach ($assets as $asset)
      {
        if ((is_admin() && $asset['admin']) || (!is_admin() && !$asset['admin']))
        {
          if ($type == 'scripts')
          {
            wp_enqueue_script($asset['handle']);
          }
          else if ($type == 'styles')
          {
            wp_enqueue_style($asset['handle']);
          }
        }
      }
    } 
  }
  
  public static function body_class($classes)
  {
    if (stristr($_SERVER['HTTP_USER_AGENT'], 'ipad')) 
    {
      $device = 'ipad';
    } 
    else if (stristr($_SERVER['HTTP_USER_AGENT'], 'iphone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iphone')) 
    {
      $device = 'iphone';
    } 
    else if (stristr($_SERVER['HTTP_USER_AGENT'], 'blackberry')) 
    {
      $device = 'blackberry';
    } 
    else if (stristr($_SERVER['HTTP_USER_AGENT'], 'android')) 
    {
      $device = 'android';
    }
    
    if (!empty($device))
    {
      array_push($classes, $device);
      
      if ($device && $device != 'ipad')
      {
        array_push($classes, 'mobile');
      }
    }
    
    return $classes;
  }
  
  public static function post_class($post_class)
  {
    self::$post_class = self::$post_class == 'odd' ? 'even' : 'odd';

    $post_class[] = self::$post_class;
    
    return $post_class;
  }
}