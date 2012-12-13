<?php
/*
Plugin Name: Piklist Demos
Plugin URI: http://piklist.com
Description: Piklist Demos. Creates a Demo post type, Taxonomy, Settings Page and Widget, with Field Examples.
Version: 0.3
Author: Piklist
Author URI: http://piklist.com/
*/

  add_filter('piklist_post_types', 'piklist_demo_post_types');
  function piklist_demo_post_types($post_types)
  {
    $post_types['piklist_demo'] = array(
      'labels' => piklist('post_type_labels', 'Piklist Demo')
      ,'public' => true
      ,'title' => __('Enter Custom Title')
      ,'supports' => array(
        'title'
      )
      ,'rewrite' => array(
        'slug' => 'piklist-demo'
      )
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Demo')
        ,'author' => __('Assigned to')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      ,'status' => array(
        'draft' => array(
          'label' => 'New'
          ,'public' => true
        )
        ,'demo' => array(
          'label' => 'Demo'
          ,'public' => true
        )
        ,'lock' => array(
          'label' => 'Lock'
          ,'public' => true
        )
      )
    );
    
    return $post_types;
  }
  

  add_filter('piklist_taxonomies', 'piklist_demo_taxonomies');
  function piklist_demo_taxonomies($taxonomies)
  {
    $taxonomies[] = array(
      'post_type' => 'piklist_demo'
      ,'name' => 'piklist_demo_type'
      ,'configuration' => array(
        'hierarchical' => true
        ,'labels' => piklist('taxonomy_labels', 'Demo Type')
        ,'show_ui' => true
        ,'query_var' => true
        ,'rewrite' => array( 
          'slug' => 'demo-type' 
        )
        ,'show_admin_column' => true
      )
    );
  
    return $taxonomies;
  }


  add_filter('piklist_admin_pages', 'piklist_demo_admin_pages');
  function piklist_demo_admin_pages($pages) 
  {
    $pages[] = array(
      'page_title' => __('Field Demos')
      ,'menu_title' => __('Settings', 'piklist')
      ,'sub_menu' => 'edit.php?post_type=piklist_demo'
      ,'capability' => 'manage_options'
      ,'menu_slug' => 'piklist_demo_fields'
      ,'setting' => 'piklist_demo_fields'
      ,'icon_url' => plugins_url('piklist/parts/img/piklist-icon.png')
      ,'icon' => 'piklist-page'
      ,'single_line' => false
      ,'default_tab' => 'Basic'
    );
  
    return $pages;
  }

  
  add_filter('piklist_field_templates', 'piklist_demo_field_templates');
  function piklist_demo_field_templates($templates)
  {
    $templates['piklist_demo'] = '[field_wrapper]
                                    <div id="%1$s" class="%2$s">
                                      [field_label]
                                      [field]
                                      [field_description_wrapper]
                                        <small>[field_description]</small>
                                      [/field_description_wrapper]
                                    </div>
                                  [/field_wrapper]';

    return $templates;
  }


  add_filter('piklist_post_submit_meta_box_title', 'piklist_demo_post_submit_meta_box_title', 10, 2);
  function piklist_demo_post_submit_meta_box_title($title, $post)
  {
    switch ($post->post_type)
    {
      case 'piklist_demo':
        $title = __('Create Demo Post');
      break;
    }
    
    return $title;
  }
  
  add_filter('piklist_post_submit_meta_box', 'piklist_demo_post_submit_meta_box', 10, 3);
  function piklist_demo_post_submit_meta_box($show, $section, $post)
  {
    switch ($post->post_type)
    {   
      case 'piklist_demo':
        
        switch ($section)
        {
          case 'minor-publishing-actions':
          //case 'misc-publishing-actions':
          //case 'misc-publishing-actions-status':
          case 'misc-publishing-actions-visibility':
          case 'misc-publishing-actions-published':
          
            $show = false;
          
          break;
        }
        
      break;
    }
    
    return $show;
  }


?>