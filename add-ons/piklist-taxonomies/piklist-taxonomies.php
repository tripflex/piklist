<?php
/*
Plugin Name: Piklist Taxonomies
Plugin URI: http://piklist.com
Plugin Type: Piklist
Description: Create and Manage Taxonomies
Version: 0.0.1
Author: Piklist
Author URI: http://piklist.com
*/

$piklist_taxonomies = new Piklist_Taxonomies();

class Piklist_Taxonomies
{
  private static $priority = 9999;

  private static $post_type = 'piklist_taxonomy';

  private static $meta_prefix = 'pik_tax_';

  public function __construct()
  {
    //TODO KM: This is not working
    //add_filter('piklist_post_submit_meta_box_title', array('piklist_taxonomies', 'post_submit_meta_box_title', 10, 2));
    
    // KM: Not working well when both this one and content-type is active
    //add_filter('piklist_post_submit_meta_box', array('piklist_taxonomies', 'post_submit_meta_box', 10, 3));

    add_action('init', array('piklist_taxonomies', 'init'), self::$priority);
    add_action('manage_piklist_taxonomy_posts_custom_column', array('piklist_taxonomies','custom_column_data'), self::$priority, 2);
    add_action('load-edit.php', array('piklist_taxonomies', 'filter_request'));

    add_filter('piklist_post_types', array('piklist_taxonomies', 'post_types'));
    add_filter('piklist_taxonomies', array('piklist_taxonomies', 'taxonomies'), self::$priority + 1);

    add_filter('get_user_option_screen_layout_piklist_taxonomy', array('piklist_taxonomies','set_screen_layout_piklist_taxonomy'), self::$priority);

    add_filter('manage_edit-piklist_taxonomy_columns', array('piklist_taxonomies','set_custom_columns'), self::$priority);
    add_filter('manage_edit-piklist_taxonomy_sortable_columns', array('piklist_taxonomies','set_sortable_columns'));
  }

  public static function init()
  {
    self::load();
  }
  
  public static function load()
  {
    global $wp_taxonomies;
    
    $taxonomies = get_posts(array(
      'post_type' => self::$post_type
      ,'numberposts' => -1
      ,'post_status' => 'any'
    ));

    $taxonomy_types = array();
    foreach ($taxonomies as $taxonomy)
    {
      if ($_taxonomy = get_metadata('post', $taxonomy->ID, self::$meta_prefix . '_taxonomy', true))
      {
        array_push($taxonomy_types, $_taxonomy);
      }
    }

    foreach ($wp_taxonomies as $taxonomy_name => $taxonomy)
    {
      if (!in_array($taxonomy_name, $taxonomy_types))
      {
        $post_id = wp_insert_post(array(
          'post_type' => self::$post_type
          ,'post_title' => $taxonomy->label
          ,'post_status' => 'enabled'
        ));
        
        add_metadata('post', $post_id, self::$meta_prefix . '_taxonomy', $taxonomy_name, true);
        
        foreach ($taxonomy as $key => $value)
        {
          if (is_object($value))
          {
            $value = (array) $value;
          }
          else if (is_bool($value))
          {
            $value = (boolean) $value ? 'true' : 'false';
          }
          
          if ((!is_array($value) && trim($value) !== '') || is_array($value))
          {
            add_metadata('post', $post_id, self::$meta_prefix . $key, $value, true);
          }
        }
      }
    }
  }

  public static function taxonomies($taxonomies)
  {
    $_taxonomies = get_posts(array(
      'post_type' => self::$post_type
      ,'numberposts' => -1
      ,'post_status' => 'any'
    ));
        
    foreach ($_taxonomies as $_taxonomy)
    {
      $object_type = false;
      $arguments = array();
      $meta = piklist('post_custom', $_taxonomy->ID);
      
      foreach ($meta as $key => $value)
      {
        if (substr($key, 0, strlen(self::$meta_prefix)) == self::$meta_prefix)
        {
          $new_key = substr($key, strlen(self::$meta_prefix));
          if ($new_key == 'object_type')
          {
            $object_type = $value;
          }
          else if ($new_key != '_taxonomy')
          {
            $arguments[$new_key] = $value;
          }
        }
      }

      if ($object_type)
      {
        register_taxonomy($arguments['name'], array());
        
        if ($_taxonomy->post_status == 'enabled')
        {
          foreach ($arguments as $key => &$value)
          {
            if ($value === 'true')
            {
              $value = true;
            }
            else if ($value === 'false')
            {
              $value = false;
            }
          }

          array_push($taxonomies, array(
            'post_type' => $object_type
            ,'name' => $arguments['name']
            ,'configuration' => $arguments
          ));
        }
      }
    }

    return $taxonomies;
  }

  public static function post_types($post_types)
  {
    $post_types[self::$post_type] = array(
      'labels' => piklist('post_type_labels', 'Taxonomy')
      ,'label' => 'taxonomy'
      ,'title' => 'Enter Taxonomy label'
      ,'description' => 'Create and edit Taxonomies.'
      ,'public' => false
      ,'show_ui' => true
      ,'show_in_menu' => 'piklist'
      ,'menu_slug' => 'taxonomies'
      ,'hide_screen_options' => true
      ,'supports' => array(
        'title'
      )
      ,'edit_columns' => array(
        'title' => 'Taxonomy'
        ,'date' => 'Created'
        ,'author' => 'Created by'
      )
      ,'hide_meta_box' => array(
        'author'
        ,'revisions'
        ,'comments'
        ,'commentstatus'
        ,'slug'
      )
      ,'admin_body_class' => array (
        'cpt-setting'
      )
      ,'status' => array(
        'enabled' => array(
          'label' => 'Enabled'
        )
        ,'disabled' => array(
          'label' => 'Disabled'
        )
      )
    );

    return $post_types;
  }

  public static function post_submit_meta_box_title($title, $post)
  {
    switch ($post->post_type)
    {
      case 'piklist_content_type':
      
        $title = __('Create Taxonomy');
      
      break;
    }
    
    return $title;
  }

  public static function post_submit_meta_box($show, $section, $post)
  {
    switch ($post->post_type)
    {   
      case self::$post_type:
        
        switch ($section)
        {
          //case 'minor-publishing-actions':
          //case 'misc-publishing-actions':
          //case 'misc-publishing-actions-status':
          //case 'misc-publishing-actions-visibility':
          //case 'misc-publishing-actions-published':

          case 'need-something-here':

         
            $show = false;
          
          break;
        }
        
      break;
    }
    
    return $show;
  }

  public static function set_custom_columns($columns)
  {
    $column_status = array(
      'status' =>  __('Status', 'piklist')
    );
    
    $column_type = array(
      'type' =>  __('Type', 'piklist')
    );
    
    $column_assigned_to = array(
      'assigned_to' => __('Assigned to', 'piklist')
    );

    $columns = array_slice($columns, 0, 2, true) + $column_status + array_slice($columns, 2, NULL, true);
    $columns = array_slice($columns, 0, 3, true) + $column_type + array_slice($columns, 3, NULL, true);
    $columns = array_slice($columns, 0, 4, true) + $column_assigned_to + array_slice($columns, 4, NULL, true);
    
    return $columns;
  }

  public static function custom_column_data($column, $post_id)
  {
    $output = null;
    
    switch ($column)
    {
      case 'status':
      
        $output = ucwords(get_post_status($post_id));
      
      break;

      case 'type':
      
        $output = get_metadata('post', $post_id , self::$meta_prefix . 'hierarchical' , true) == 'true' ? __('Hierarchical', 'piklist') : __('Non-Hierarchical', 'piklist');
      
      break;

      case 'assigned_to':
        
        global $wp_post_types;

        $object_types = array();
        $assigned_object_types = get_metadata('post', $post_id, self::$meta_prefix . 'object_type', false);
        foreach ($assigned_object_types as $assigned_object_type)
        {
          array_push($object_types, is_array($assigned_object_type) ? current($assigned_object_type) : $assigned_object_type);
        }

        if (!empty($object_types))
        {
          foreach ($object_types as $type)
          {
            $output .= (isset($wp_post_types[$type]) ? $wp_post_types[$type]->label : '<strong>' . $type . '</strong>') . (end($object_types) != $type ? ', ' : null);
          }
        }
        
      break;
    }
    
    if (!is_null($output))
    {
      echo $output;
    }
  }

  public static function set_sortable_columns($columns)
  {
    //$columns['status'] = 'status';
    $columns['type'] = 'type';

    return $columns;
  }

  public static function filter_request()
  {
    $screen = get_current_screen();

    if ($screen->id == 'edit-piklist_taxonomy')
    {
      add_filter('request', array('piklist_taxonomies','column_orderby'));
    }    
  }

  public static function column_orderby($vars)
  {
    if (isset($vars['orderby']) && 'type' == $vars['orderby'])
    {
      $vars = array_merge($vars, array(
        'meta_key' => 'hierarchical'
        ,'orderby' => 'meta_value'
      ));
    }
    
    return $vars;
  }

  public static function set_screen_layout_piklist_taxonomy()
  {
    return '2';
  }

}

?>