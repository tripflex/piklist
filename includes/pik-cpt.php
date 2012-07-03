<?php

class PikList_CPT
{
  private static $post_types = array();

  private static $taxonomies = array();
  
  private static $meta_boxes_locked = array();
  
  private static $meta_boxes_hidden = array();
  
  private static $meta_box_nonce = null;
  
  public static function _construct()
  {    
    add_action('init', array('piklist_cpt', 'init'));
    add_action('do_meta_boxes', array('piklist_cpt', 'sort_meta_boxes'), 100, 3);
    add_action('save_post', array('piklist_cpt', 'save_post_data'));
    add_action('edit_page_form', array('piklist_cpt', 'edit_form'));
    add_action('edit_form_advanced', array('piklist_cpt', 'edit_form'));
    add_action('piklist_install', array('piklist_cpt', 'install'));
    
    add_filter('posts_join', array('piklist_cpt', 'posts_join'));
    add_filter('posts_where', array('piklist_cpt', 'posts_where'));
  }
  
  public static function init()
  {    
    self::register_post_types();
    self::register_taxonomies();
  }
  
  public static function install()
  {
    $table = piklist::create_table(
      'cpt_relate'
      ,'relate_id bigint(20) unsigned NOT NULL auto_increment
        ,post_id bigint(20) unsigned NOT NULL
        ,has_post_id bigint(20) unsigned NOT NULL
        ,PRIMARY KEY (relate_id)
        ,KEY post_id (post_id)
        ,KEY has_post_id (has_post_id)'
    );
  }

  public static function posts_join($join)
  {
    global $wpdb;

    $table_name = $wpdb->prefix . 'piklist_cpt_relate';

    if ($post_id = get_query_var('post_belongs'))
    {
      $join .= " LEFT JOIN " . $table_name . " ON " . $wpdb->posts . ".ID = " . $table_name . ".has_post_id";
    }
    
    if ($post_id = get_query_var('post_has'))
    {
      $join .= " LEFT JOIN " . $table_name . " ON " . $wpdb->posts . ".ID = " . $table_name . ".post_id";
    }
    
    return $join;
  }

  public static function posts_where($where)
  {
    global $wpdb;

    $table_name = $wpdb->prefix . 'piklist_cpt_relate';

    if ($post_id = get_query_var('post_belongs'))
    {
      $where .= " AND {$table_name}.post_id = {$post_id}";
    }
    
    if ($post_id = get_query_var('post_has'))
    {
      $where .= " AND {$table_name}.has_post_id = {$post_id}";
    }
    
    return $where;
  }

  public static function edit_form()
  {
    $fields = array(
      '_pik_relate'
      ,'_pik_post_id'
      ,'_pik_admin_hide_ui'
    );

    foreach ($fields as $field)
    {
      if (isset($_REQUEST[$field]) && !empty($_REQUEST[$field])) 
      {
        piklist::render_field(array(
          'type' => 'hidden'
          ,'field' => $field
          ,'value' => $_REQUEST[$field]
        ));
      }
    }
  }
  
  public static function register_post_types()
  {
    global $wp_post_statuses;
    
    self::$post_types = apply_filters('piklist_post_types', self::$post_types);

    foreach (self::$post_types as $post_type => &$configuration)
    {
      $configuration['register_meta_box_cb'] = array('piklist_cpt', 'register_meta_boxes');

      $configuration['supports'] = empty($configuration['supports']) ? array('nothing') : $configuration['supports'];
      register_post_type($post_type, $configuration);
      
      if (isset($configuration['status']) && !empty($configuration['status']))
      {   
        $configuration['status'] = apply_filters('piklist_post_type_statuses', $configuration['status'], $post_type);
  
        foreach ($configuration['status'] as $status => &$status_data)
        {
          $status_data['label'] = _x($status_data['label'], $post_type);
          $status_data['label_count'] = _n_noop($status_data['label'] .' <span class="count">(%s)</span>', $status_data['label'] . ' <span class="count">(%s)</span>');
          $status_data['capability_type'] = $post_type;

          $status_data = wp_parse_args($status_data, array(
            'label' => false
            ,'label_count' => false
            ,'exclude_from_search' => null
            ,'capability_type' => 'post'
            ,'hierarchical' => false
            ,'public' => true
            ,'internal' => null
            ,'protected' => true
            ,'private' => null
            ,'show_in_admin_all' => null
            ,'publicly_queryable' => null
            ,'show_in_admin_status_list' => true
            ,'show_in_admin_all_list' => true
            ,'single_view_cap' => null
            ,'_builtin' => false 
          ));
          
          if ($status != 'draft')
          {
            register_post_status($status, $status_data);
          }
        }
        
        add_filter('views_edit-piklist_example', array('piklist_cpt', 'custom_status'));
      }
            
      if (isset($configuration['hide_meta_box']) && !empty($configuration['hide_meta_box']) && is_array($configuration['hide_meta_box']))
      {
        foreach ($configuration['hide_meta_box'] as $meta_box)
        {
          if (!isset(self::$meta_boxes_hidden[$post_type]))
          {
            self::$meta_boxes_hidden[$post_type] = array();
          }
          array_push(self::$meta_boxes_hidden[$post_type], $meta_box . 'div');
        }
        
        add_action('admin_head', array('piklist_cpt', 'hide_meta_boxes'), 100);
      }
      
      if (isset($configuration['edit_columns']) && !empty($configuration['edit_columns']))
      {
        add_filter('manage_edit-' . $post_type . '_columns', array('piklist_cpt', 'manage_edit_columns'));
      }
      
      if (isset($configuration['edit_manage']) && !empty($configuration['edit_manage']))
      {
        add_action('restrict_manage_posts', array('piklist_cpt', 'restrict_manage_posts'));
      }
    }
  }
  
  public static function register_taxonomies()
  {
    self::$taxonomies = apply_filters('piklist_taxonomies', self::$taxonomies);
    
    foreach (self::$taxonomies as $taxonomy)
    {
      register_taxonomy($taxonomy['name'], $taxonomy['post_type'], $taxonomy['configuration']);
      
      if (isset($taxonomy['configuration']['hide_meta_box']) && !empty($taxonomy['configuration']['hide_meta_box']))
      {
        $post_types = is_array($taxonomy['post_type']) ? $taxonomy['post_type'] : array($taxonomy['post_type']);
        foreach ($post_types as $post_type)
        {
          if (!isset(self::$meta_boxes_hidden[$post_type]))
          {
            self::$meta_boxes_hidden[$post_type] = array();
          }
          array_push(self::$meta_boxes_hidden[$post_type], $taxonomy['configuration']['hierarchical'] ? $taxonomy['name'] . 'div' : 'tagsdiv-' . $taxonomy['name']);
        }

        add_action('admin_head', array('piklist_cpt', 'hide_meta_boxes'), 100);
      }
    }
  }
  
  public static function hide_meta_boxes()
  {    
    global $pagenow, $wp_meta_boxes;

    if (in_array($pagenow, array('post.php', 'post-new.php')))
    {
      global $post;

      $post_type = get_post_type();

      if (isset(self::$meta_boxes_hidden[$post_type]))
      {
        if (!in_array('submitdiv', self::$meta_boxes_hidden[$post_type]))
        {
          array_push(self::$meta_boxes_hidden[$post_type], 'submitdiv');
        }
        
        foreach (self::$meta_boxes_hidden[$post_type] as $meta_box)
        {  
          foreach (array('normal', 'advanced', 'side') as $context)
          {
            // NOTE: remove_meta_box simply removes the meta configuration not the key, we need to wipe it... 
            foreach (array('high', 'core', 'default', 'low') as $priority)
            {              
              if (isset($wp_meta_boxes[$post_type][$context][$priority][$meta_box]))
              {
                if ($meta_box == 'submitdiv')
                {
                  $wp_meta_boxes[$post_type][$context][$priority][$meta_box]['callback'] = array('piklist_cpt', 'post_submit_meta_box');
                }
                else
                {
                  unset($wp_meta_boxes[$post_type][$context][$priority][$meta_box]);
                } 
              }     
            }
          }
        }
      }
    }
  }
  
  public static function post_submit_meta_box()
  {
    global $post;
        
    piklist::render('shared/post-submit-meta-box', array(
      'post' => $post
      ,'statuses' => self::$post_types[$post->post_type]['status'] 
    ));
  }
  
  public static function custom_status($views)
  {
    $post_type = $_REQUEST['post_type'];
    
    if (isset(self::$post_types[$post_type]))
    {
      $num_posts = wp_count_posts($post_type, 'readable');

      foreach (self::$post_types[$post_type]['status'] as $status => $status_data)
      {
        $views[$status] = '<a href="edit.php?post_status=' . $status . '&amp;post_type=' . $status_data['capability_type'] . '">' . sprintf(translate_nooped_plural($status_data['label_count'], $num_posts->$status), number_format_i18n($num_posts->$status)) . '</a>';
      }
    }

    return $views;
  }
  
  public static function manage_edit_columns($columns) 
  {
    $post_type = $_REQUEST['post_type'];
    
    if (isset(self::$post_types[$post_type]))
    {
      return array_merge($columns, self::$post_types[$post_type]['edit_columns']);
    }
    
    return $columns;
  }
  
  public static function restrict_manage_posts()
  {
    // NOTE: How to handle pre-existing printed info?  Callback function here?
  }
  
  public static function save_post_data($post_id) 
  {
    global $wpdb, $post;
    
    if (empty($_POST) || !isset($_POST['post_meta']['meta_box_nonce']))
    {
      return $post_id;
    }
    
    if (!wp_verify_nonce($_POST['post_meta']['meta_box_nonce'], plugin_basename(__FILE__))) 
    {
      return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
    {
      return $post_id;
    }

    if ($post->post_type == 'page') 
    {
      if (!current_user_can('edit_page', $post_id)) 
      {
        return $post_id;
      }
    } 
    elseif (!current_user_can('edit_post', $post_id)) 
    {
      return $post_id;
    }
    
    remove_action('save_post', array('piklist_cpt', 'save_post_data'));
      
      piklist_form::save(array(
        'post' => $post_id
      ));

      $_post = array(
        'ID' => $post_id
      );

      if (empty($_REQUEST['post_title']) || !isset($_REQUEST['post_title']))
      {
        $_post['post_title'] = ucwords(str_replace(array('-', '_'), ' ', $post->post_type)) . ' ' . $post_id;
      }

      if (isset($_REQUEST['original_publish']) && $_REQUEST['original_publish'] != 'Publish')
      {
        $_post['post_status'] = $_REQUEST['original_publish'];
      }
      
      if (count($_post) > 1)
      {
        wp_update_post($_post);
      }
          
    add_action('save_post', array('piklist_cpt', 'save_post_data'));
  }
  
  public static function register_meta_boxes()
  { 
    piklist::process_views('meta-boxes', array('piklist_cpt', 'register_meta_boxes_callback'));
  }

  public static function register_meta_boxes_callback($arguments)
  {
    global $post, $pagenow;

    extract($arguments);
    
    $data = get_file_data($path . '/parts/' . $folder . '/' . $part, array(
              'name' => 'Title'
              ,'context' => 'Context'
              ,'description' => 'Description'
              ,'capability' => 'Capability'
              ,'priority' => 'Priority'
              ,'order' => 'Order'
              ,'type' => 'Post Type'
              ,'lock' => 'Lock'
              ,'collapse' => 'Collapse'
              ,'status' => 'Status'
              ,'new' => 'New'
            ));

    $types = !empty($data['type']) ? get_post_types() : explode(',', $data['type']);

    foreach ($types as $type)
    {
      $statuses = isset($data['status']) ? explode(',', $data['status']) : false;

      if (post_type_exists($type) 
        && (!$data['capability'] || ($data['capability'] && current_user_can($data['capability'])))
        && (!$data['status'] || ($data['status'] && in_array($post->post_status, $statuses)))
        && (!$data['new'] || ($data['new'] && $pagenow != 'post-new.php'))
      )
      {
        $id = 'piklist_meta_' . piklist::slug($part);

        add_meta_box(
          $id
          ,__($data['name'], 'piklist')
          ,array('piklist_cpt', 'meta_box')
          ,$type
          ,!empty($data['context']) ? $data['context'] : 'normal'
          ,!empty($data['priority']) ? $data['priority'] : 'high'
          ,array(
            'part' => $part
            ,'add_on' => $add_on
            ,'order' => $data['order'] ? $data['order'] : null
            ,'config' => $data
          )
        );

        // NOTE: Improve
        if (isset($data['lock']) && strtolower($data['lock']) == 'true')
        {
          add_filter("postbox_classes_{$type}_{$id}", array('piklist_cpt', 'lock_meta_boxes'));
        }
        if (isset($data['collapse']) && strtolower($data['collapse']) == 'true')
        {
          add_filter("postbox_classes_{$type}_{$id}", array('piklist_cpt', 'collapse_meta_boxes'));
        }
        add_filter("postbox_classes_{$type}_{$id}", array('piklist_cpt', 'default_classes'));
      }
    }
          
    if (!empty($data['type']))
    {

    }
  }
  
  public static function meta_box($post, $meta_box)
  {
    $type = get_post_type($post);

    if ($type)
    {
      if (!self::$meta_box_nonce)
      {
        piklist_form::render_field(array(
          'type' => 'hidden'
          ,'field' => 'meta_box_nonce'
          ,'value' => wp_create_nonce(plugin_basename(__FILE__))
          ,'scope' => 'post_meta'
        ));
        
        self::$meta_box_nonce = true;
      }
      
      piklist::render(piklist::$paths[$meta_box['args']['add_on']] . '/parts/meta-boxes/' . $meta_box['args']['part'], array(
        'type' => $type
        ,'prefix' => 'piklist'
        ,'plugin' => 'piklist'
      ), false);
    }
  }
  
  public static function sort_meta_boxes($post_type, $context, $post)
  {
    global $wp_meta_boxes;
        
    foreach (array('high', 'sorted', 'core', 'default', 'low') as $priority) 
    {
      if (isset($wp_meta_boxes[$post_type][$context][$priority]))
      {
        piklist::$sort_by_order_prefix = 'args';
        uasort($wp_meta_boxes[$post_type][$context][$priority], array('piklist', 'sort_by_args_order'));
      }
    }        

    add_filter('get_user_option_meta-box-order_' . $post_type, array('piklist_cpt', 'user_sort_meta_boxes'), 100, 3);
  }
  
  public static function user_sort_meta_boxes($result, $option, $user)
  {
    global $wp_meta_boxes;
    
    $post_type = str_replace('meta-box-order_', '', $option);
    
    $order = array(
      'side' => ''
      ,'normal' => ''
      ,'advanced' => ''
    );
    
    foreach (array('side', 'normal', 'advanced') as $context) 
    {    
      foreach (array('high', 'sorted', 'core', 'default', 'low') as $priority) 
      {
        if (isset($wp_meta_boxes[$post_type][$context][$priority]) && !empty($wp_meta_boxes[$post_type][$context][$priority]))
        {
          $order[$context] .= (!empty($order[$context]) ? ',' : '') . implode(',', array_keys($wp_meta_boxes[$post_type][$context][$priority]));
        }
      }
      
    }
    
    return $order;    
  }
  
  public static function lock_meta_boxes($classes)
  {
    array_push($classes, 'piklist-meta-box-lock hide-all');
    return $classes;
  }
  
  public static function default_classes($classes)
  {
    array_push($classes, 'piklist-meta-box');
    return $classes;
  }
    
  public static function collapse_meta_boxes($classes)
  {
    array_push($classes, 'piklist-meta-box-collapse');
    return $classes;
  }
  
  public static function default_post_title($id)
  {
    $post = get_post($id);
    
    wp_update_post(array(
      'ID' => $id
      ,'post_title' => ucwords(str_replace(array('-', '_'), ' ', $post->post_type)) . ' ' . $id 
    ));
  }
  
  public static function get_post_statuses($type, $object_type = null)
  {
    $status_list = array();
    
    switch ($type)
    {
      case 'post':
      
        global $wp_post_statuses;

        $object_type = $object_type ? $object_type : get_post_type();

        foreach ($wp_post_statuses as $status)
        {
          if ($status->capability_type == $object_type)
          {
            array_push($status_list, $status->name);
          }
        }
        
      break;
    }
    
    return $status_list;
  }
}

?>