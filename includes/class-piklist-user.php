<?php

class PikList_User
{
  private static $meta_boxes = array();
  
  private static $meta_box_nonce = false;
  
  public static function _construct()
  {    
    add_action('init', array('piklist_user', 'init'));
    add_action('show_user_profile', array('piklist_user', 'meta_box'), 10);
    add_action('edit_user_profile', array('piklist_user', 'meta_box'), 10);
    add_action('personal_options_update', array('piklist_user', 'process_form'), 10);
    add_action('edit_user_profile_update', array('piklist_user', 'process_form'), 10);
  }
  
  public static function init()
  {   
    self::register_meta_boxes();
  }

  public static function register_meta_boxes()
  {
    piklist::process_views('users', array('piklist_user', 'register_meta_boxes_callback'));
  }

  public static function register_meta_boxes_callback($arguments)
  {
    extract($arguments);
    
    $current_user = wp_get_current_user();
    
    $data = get_file_data($path . '/parts/' . $folder . '/' . $part, array(
              'name' => 'Title'
              ,'description' => 'Description'
              ,'capability' => 'Capability'
              ,'order' => 'Order'
              ,'role' => 'Role'
              ,'new' => 'New'
            ));
    
    $meta_box = array(
      'config' => $data
      ,'part' => $path . '/parts/' . $folder . '/' . $part
    );
    
    if ((!$data['capability'] || ($data['capability'] && current_user_can(strtolower($data['capability']))))
      && (!$data['role'] || in_array(strtolower($data['role']), $current_user->roles))
      && (!$data['new'] || ($data['new'] && $pagenow != 'user-new.php'))
    )
    {
      if (isset($order))
      {
        self::$meta_boxes[$order] = $meta_box;
      }
      else
      {
        array_push(self::$meta_boxes, $meta_box);
      }
    }
  }

  public static function meta_box($user_id)
  {
    if (!empty(self::$meta_boxes))
    {
      if (!self::$meta_box_nonce)
      {
        piklist_form::render_field(array(
          'type' => 'hidden'
          ,'field' => 'nonce'
          ,'value' => wp_create_nonce('piklist/piklist.php')
          ,'scope' => 'piklist'
        ));
      
        self::$meta_box_nonce = true;
      }
  
      foreach (self::$meta_boxes as $meta_box)
      {
        piklist::render('shared/meta-box-start', array(
          'meta_box' => $meta_box
          ,'wrapper' => 'user_meta'
        ), false);
  
        piklist::render($meta_box['part'], array(
          'user_id' => $user_id
          ,'prefix' => 'piklist'
          ,'plugin' => 'piklist'
        ), false);
        
        piklist::render('shared/meta-box-end', array(
          'meta_box' => $meta_box
          ,'wrapper' => 'user_meta'
        ), false);
      }
    }
  }
  
  public static function process_form($user_id)
  {
    piklist_form::process_form(array(
      'user' => $user_id
    ));
  }
}

?>