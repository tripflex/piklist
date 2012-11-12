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
      ,'rewrite' => array(
        'slug' => 'piklist-demo'
      )
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Demo')
        ,'author' => __('Person')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
        ,'piklist_demo_type'
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
        ,'tutorial' => array(
          'label' => 'Tutorial'
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
        ,'hide_meta_box' => true
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

?>