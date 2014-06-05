<?php

if (!defined('ABSPATH'))
{
  exit;
}

class PikList_Meta
{
  private static $reset_meta = array(
    'post.php' => array(
      'id' => 'post'
      ,'group' => 'post_meta'
    )
    ,'user-edit.php' => array(
      'id' => 'user_id'
      ,'group' => 'user_meta'
    )
    ,'comment.php' => array(
      'id' => 'c'
      ,'group' => 'comment_meta'
    )
  );
  
  public static function _construct()
  {    
    add_action('init', array('piklist_meta', 'meta_reset'));
    add_action('query', array('piklist_meta', 'meta_sort'));
  }
  
  public static function meta_reset()
  {
    global $pagenow;

    self::$reset_meta = apply_filters('piklist_reset_meta_admin_pages', self::$reset_meta);
    
    if (in_array($pagenow, self::$reset_meta))
    {
      foreach (self::$reset_meta as $page => $data)
      {
        if (isset($_REQUEST[$data['id']]))
        {
          wp_cache_replace($_REQUEST[$data['id']], false, $data['group']);
          break;
        }
      }
    }
  }
  
  public static function meta_sort($query) 
  {
    global $wpdb;
    
    if (stristr($query, ', meta_key, meta_value FROM'))
    {
      $meta_tables = apply_filters('piklist_meta_tables', array(
        'post_id' => $wpdb->postmeta
        ,'comment_id' => $wpdb->commentmeta
        // ,'user_id' => $wpdb->usermeta // NOTE: if we sort by usermeta is breaks permissions...
      ));

      foreach ($meta_tables as $id => $meta_table)
      {
        if (stristr($query, "SELECT {$id}, meta_key, meta_value FROM {$meta_table} WHERE {$id} IN") && !stristr($query, ' ORDER BY '))
        {
          return $query . ' ORDER BY meta_id ASC';
        }
      }
    }
    
    return $query;
  }
}