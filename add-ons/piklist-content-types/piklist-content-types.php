<?php
/*
Plugin Name: Piklist Content Types
Plugin URI: http://piklist.com/
Plugin Type: Piklist
Description: Create and Manage Content Types
Version: 0.0.1
Author: Piklist
Author URI: http://piklist.com/
*/

$Piklist_Content_Types = new Piklist_Content_Types();

class Piklist_Content_Types
{
  private static $filter_priority = 8888;
  public function __construct()
  {
    add_filter('piklist_post_types', array('piklist_content_types', 'post_types'));

    // KM: This is not working
    //add_filter('piklist_post_submit_meta_box_title', array('piklist_content_types', 'post_submit_meta_box_title', 10, 2));
    
    // KM: Not working well when both this one and content-type is active
    //add_filter('piklist_post_submit_meta_box', array('piklist_content_types', 'post_submit_meta_box', 10, 3));
    add_filter('manage_edit-piklist_content_type_columns', array('piklist_content_types','set_custom_columns'),self::$filter_priority);
    add_action('manage_piklist_content_type_posts_custom_column', array('piklist_content_types','custom_column_data'), self::$filter_priority, 2 );
    add_filter('manage_edit-piklist_content_type_sortable_columns', array('piklist_content_types','set_sortable_columns'));
    add_action('load-edit.php', array('piklist_content_types','filter_request'));
  }

  public function post_types($post_types)
  {
    $post_types['piklist_content_type'] = array(
      'labels' => piklist('post_type_labels', 'Content Type')
      ,'label' => 'content-type'
      ,'title' => 'Enter Content Type label'
      ,'description' => 'Create and edit Content Types.'
      ,'public' => false
      ,'show_ui' => true
      ,'show_in_menu' => 'piklist'
      ,'menu_slug' => 'content-types'
      ,'hide_screen_options' => true
      ,'supports' => array(
        'title'
        )
      ,'edit_columns' => array(
        'title' => 'Content Type'
        ,'date' => 'Created'
        ,'author' => 'Created by'
      )
      ,'hide_meta_box' => array(
        'author'
        ,'revisions'
        ,'comments'
        ,'commentstatus'
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
        $title = __('Create Content Type');
      break;
    }
    
    return $title;
  }
  

  public static function post_submit_meta_box($show, $section, $post)
  {
    switch ($post->post_type)
    {   
      case 'piklist_content_type':
        
        switch ($section)
        {
          //case 'minor-publishing-actions':
          //case 'misc-publishing-actions':
          //case 'misc-publishing-actions-status':
          //case 'misc-publishing-actions-visibility':
          case 'misc-publishing-actions-published':
        
            $show = false;
          
          break;
        }
        
      break;
    }
    
    return $show;
  }

  public static function set_custom_columns($columns)
  {
    $column_status = array('status' =>  __('Status', 'piklist'));
    $column_type = array('type' =>  __('Type', 'piklist'));
    $column_assigned_to = array('assigned_to' => __('Assigned to', 'piklist'));

    $columns = array_slice( $columns, 0, 1, true ) + $column_status + array_slice( $columns, 1, NULL, true );
    $columns = array_slice( $columns, 0, 3, true ) + $column_type + array_slice( $columns, 3, NULL, true );
    $columns = array_slice( $columns, 0, 4, true ) + $column_assigned_to + array_slice( $columns, 4, NULL, true );
    
    return $columns;
  }

  public static function custom_column_data($column, $post_id)
  {
    switch ($column)
    {
      case 'status':
        echo get_post_status($post_id);
      break;

      case 'type':
        echo (get_post_meta( $post_id , 'hierarchical' , true ) == 'true' ? __('Hierarchical','piklist') : __('Non-Hierarchical','piklist'));
      break;

      case 'assigned_to':
        $assigned_object_types = get_post_meta($post_id, 'taxonomies', false);

        foreach($assigned_object_types as $assigned_object_type):
          $object_types[] = $assigned_object_type;
        endforeach;

        echo implode(', ', $object_types);
      
      break;
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

    if($screen->id == 'edit-piklist_content_type')
    {
      add_filter('request', array('piklist_content_types','column_orderby'));
    }    
  }
  

  public static function column_orderby($vars)
  {
    if (isset( $vars['orderby'] ) && 'type' == $vars['orderby'])
    {
      $vars = array_merge( $vars, array(
      'meta_key' => 'hierarchical',
      'orderby' => 'meta_value'
      ));
    }
    return $vars;
  }

}



?>