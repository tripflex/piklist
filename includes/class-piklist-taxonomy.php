<?php

class PikList_Taxonomy
{
  private static $meta_boxes;
  
  private static $meta_box_nonce = false;
  
  public static function _construct()
  {    
    add_action('init', array('piklist_taxonomy', 'init'));
    add_action('piklist_activate', array('piklist_taxonomy', 'activate'));
  }
  
  public static function init()
  {   
    self::register_tables();
    self::register_meta_boxes();
  }
  
  public static function register_tables()
  {
    global $wpdb;
    
    array_push($wpdb->tables, 'termmeta');
    
    $wpdb->termmeta = $wpdb->prefix . 'termmeta';
  }
  
  public static function register_meta_boxes()
  {
    piklist::process_views('terms', array('piklist_taxonomy', 'register_meta_boxes_callback'));
  }

  public static function register_meta_boxes_callback($arguments)
  {
    extract($arguments);
    
    $data = get_file_data($path . '/parts/' . $folder . '/' . $part, array(
              'name' => 'Title'
              ,'description' => 'Description'
              ,'capability' => 'Capability'
              ,'order' => 'Order'
              ,'taxonomy' => 'Taxonomy'
              ,'new' => 'New'
            ));
    
    if (!isset($data['taxonomy']))
    {
      return null;
    }        

    if (!isset(self::$meta_boxes[$data['taxonomy']]))
    {
      self::$meta_boxes[$data['taxonomy']] = array();

      add_action($data['taxonomy'] . '_edit_form_fields', array('piklist_taxonomy', 'meta_box'), 10, 2);
      add_action('edited_' . $data['taxonomy'], array('piklist_taxonomy', 'process_form'), 10, 2);

      if (!$data['new'])
      {
        add_action($data['taxonomy'] . '_add_form_fields', array('piklist_taxonomy', 'meta_box_add'), 10, 2);
        add_action('created_' . $data['taxonomy'], array('piklist_taxonomy', 'process_form'), 10, 2);
      }
    }
    
    $meta_box = array(
      'config' => $data
      ,'part' => $path . '/parts/' . $folder . '/' . $part
    );
    
    if (isset($order))
    {
      self::$meta_boxes[$data['taxonomy']][$order] = $meta_box;
    }
    else
    {
      array_push(self::$meta_boxes[$data['taxonomy']], $meta_box);
    }
  }
  
  public static function meta_box_add($taxonomy)
  {
    self::meta_box(null, $taxonomy);
  }
  
  public static function meta_box($tag = null, $taxonomy)
  {
    if ($taxonomy)
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
    
      foreach (self::$meta_boxes[$taxonomy] as $taxonomy => $meta_box)
      {
        piklist::render('shared/meta-box-seperator', array(
          'meta_box' => $meta_box
          ,'wrapper' => isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ? 'term_meta' : 'term_meta_new'
        ), false);

        piklist::render($meta_box['part'], array(
          'taxonomy' => $taxonomy
          ,'prefix' => 'piklist'
          ,'plugin' => 'piklist'
        ), false);
      }
    }
  }
  
  public static function process_form($term_id, $taxonomy_id)
  {
    piklist_form::process_form(array(
      'term' => $term_id
    ));
  }
  
  public static function activate($network_wide)
  {
    $table = piklist::create_table(
      'termmeta'
      ,'meta_id bigint(20) unsigned NOT NULL auto_increment
        ,term_id bigint(20) unsigned NOT NULL default "0"
        ,meta_key varchar(255) default NULL
        ,meta_value longtext
        ,PRIMARY KEY (meta_id)
        ,KEY term_id (term_id)
        ,KEY meta_key (meta_key)'
      ,$network_wide
   );
  }
}

if (!function_exists('add_term_meta'))
{
  /**
   * Add meta data field to a term.
   *
   * post meta data is called "Custom Fields" on the Administration Screen.
   *
   * @param int $term_id post ID.
   * @param string $meta_key Metadata name.
   * @param mixed $meta_value Metadata value.
   * @param bool $unique Optional, default is false. Whether the same key should not be added.
   * @return bool False for failure. True for success.
   */
  function add_term_meta($term_id, $meta_key, $meta_value, $unique = false) 
  {
    return add_metadata('term', $term_id, $meta_key, $meta_value, $unique);
  }
}

if (!function_exists('delete_term_meta'))
{
  /**
   * Remove metadata matching criteria from a term.
   *
   * You can match based on the key, or key and value. Removing based on key and
   * value, will keep from removing duplicate metadata with the same key. It also
   * allows removing all metadata matching key, if needed.
   *
   * @param int $term_id term ID
   * @param string $meta_key Metadata name.
   * @param mixed $meta_value Optional. Metadata value.
   * @return bool False for failure. True for success.
   */
  function delete_term_meta($term_id, $meta_key, $meta_value = '') 
  {
    return delete_metadata('term', $term_id, $meta_key, $meta_value);
  }
}  

if (!function_exists('get_term_meta'))
{
  /**
   * Retrieve term meta field for a term.
   *
   * @param int $term_id post ID.
   * @param string $key Optional. The meta key to retrieve. By default, returns data for all keys.
   * @param bool $single Whether to return a single value.
   * @return mixed Will be an array if $single is false. Will be value of meta data field if $single is true.
   */
  function get_term_meta($term_id, $key = '', $single = false) 
  {
    return get_metadata('term', $term_id, $key, $single);
  }
}

if (!function_exists('update_term_meta'))
{
  /**
   * Update term meta field based on term ID.
   *
   * Use the $prev_value parameter to differentiate between meta fields with the
   * same key and term ID.
   *
   * If the meta field for the term does not exist, it will be added.
   *
   * @param int $term_id post ID.
   * @param string $meta_key Metadata key.
   * @param mixed $meta_value Metadata value.
   * @param mixed $prev_value Optional. Previous value to check before removing.
   * @return bool False on failure, true if success.
   */
  function update_term_meta($term_id, $meta_key, $meta_value, $prev_value = '') 
  {
    return update_metadata('term', $term_id, $meta_key, $meta_value, $prev_value);
  }
}

if (!function_exists('delete_term_meta_by_key'))
{
  /**
   * Delete everything from term meta matching meta key.
   *
   * @param string $term_meta_key Key to search for when deleting.
   * @return bool Whether the term meta key was deleted from the database
   */
  function delete_term_meta_by_key($term_meta_key) 
  {
    return delete_metadata('term', null, $term_meta_key, '', true);
  }
}

if (!function_exists('get_term_custom'))
{
  /**
   * Retrieve term meta fields, based on term ID.
   *
   * The term meta fields are retrieved from the cache where possible,
   * so the function is optimized to be called more than once.
   *
   * @param int $term_id post ID.
   * @return array
   */
  function get_term_custom($term_id = 0) 
  {
    $term_id = absint($term_id);

    return !$term_id ? null : get_term_meta($term_id);
  }
}

if (!function_exists('get_term_custom_keys'))
{
  /**
   * Retrieve meta field names for a term.
   *
   * If there are no meta fields, then nothing (null) will be returned.
   *
   * @param int $term_id term ID
   * @return array|null Either array of the keys, or null if keys could not be retrieved.
   */
  function get_term_custom_keys($term_id = 0) 
  {
    $custom = get_term_custom($term_id);

    if (!is_array($custom))
    {
      return;
    }
  
    if ($keys = array_keys($custom))
    {
      return $keys;
    }
  }
}

if (!function_exists('get_term_custom_values'))
{
  /**
   * Retrieve values for a custom term field.
   *
   * The parameters must not be considered optional. All of the term meta fields
   * will be retrieved and only the meta field key values returned.
   *
   * @param string $key Meta field key.
   * @param int $term_id post ID
   * @return array Meta field values.
   */
  function get_term_custom_values($key = '', $term_id = 0) 
  {
    if (!$key)
    {
      return null;
    }
  
    $custom = get_term_custom($term_id);

    return isset($custom[$key]) ? $custom[$key] : null;
  }
}

?>