<?php
/*
Post Type: piklist_content_type
Order: 10
Priority: core
Locked: true
Meta Box: false
Collapse: false
*/


  piklist('field', array(
    'type' => 'text'
    ,'field' => 'post_name'
    ,'value' => $post->post_name
    ,'label' => 'Slug'
    ,'required' => true
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));


  piklist('field', array(
    'type' => 'text'
    ,'field' => 'description'
    ,'label' => 'Description'
    ,'required' => true
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'title'
    ,'label' => '"Enter title here" text'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'hierarchical'
    ,'label' => 'Hierarchical'
    ,'description' => 'Hierarchical (have descendants) like Pages or non-hierarchical like Posts.'
    ,'value' => 'false'
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'position' => 'end'
    ,'choices' => array(
      'true' => 'Hierarchical (i.e. Page)'
      ,'false' => 'Non-Hierarchical (i.e. Post)'
    )
  ));

  $valid_taxonomies = piklist(
                         get_taxonomies(
                          array(
                            'public' => true
                          )
                          ,'objects'
                        )
                        ,array(
                          'name'
                          ,'label'
                        )
                      );

  if ($valid_taxonomies)
  {
    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'taxonomies'
      ,'label' => 'Associated Taxonomies'
      ,'description' => 'Taxonomies that will be used with this Content Type'
      ,'list' => count($valid_taxonomies) < 5 ? true : false // If 5 or more taxonomies than show in columns
      ,'required' => true
      ,'attributes' => array(
       'class' => 'text'
      ,'columns' => 3
      )
      ,'choices' => $valid_taxonomies
      // KM: not sure how to add this embeded field into the choices
      ,'fields' => array(
            array(
              'type' => 'select'
              ,'field' => 'show_hide_meta_box'
              ,'embed' => true
              ,'value' => 'show'
              ,'choices' => array(
                'show' => 'Show meta box'
                ,'hide' => 'Hide meta box'
              )
            )
      )
    ));
  }

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'pik_cct_advanced_labels'
    ,'label' => __('Labels')
    ,'description' => __('Define your own or auto generate')
    ,'value' => 'false'
    ,'list' => false
    ,'choices' => array(
      'true' => 'Define'
      ,'false' => 'Auto Generate'
    )
  ));


piklist('field', array(
    'type' => 'group'
    ,'field' => 'pik_cct_labels'
    ,'label' => 'Advanced Labels'
    ,'description' => 'Detailed Labels used in the Administration for this Taxonomy'
    ,'conditions' => array(
      array(
       'field' => 'show_label_advanced'
       ,'value' => 'true'
      )
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'name'
        ,'label' => 'Label (Plural)'
        ,'label_position' => 'before'
        ,'value' => '%s'
        ,'description' => 'A plural descriptive name for the Content Type (i.e. Orders)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'singular_name'
        ,'label' => 'Label (Singular)'
        ,'label_position' => 'before'
        ,'value' => '%s'
        ,'description' => 'A singular descriptive name for the Content Type (i.e. Orders)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'add_new'
        ,'label' => 'Add New'
        ,'value' => 'Add New'
        ,'label_position' => 'before'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'add_new_item'
        ,'label' => 'Add New Item'
        ,'value' => 'Add New %s'
        ,'label_position' => 'before'
        ,'description' => '(i.e. Add new Order)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'all_items'
        ,'label' => 'All Items'
        ,'value' => 'All %s'
        ,'label_position' => 'before'
        ,'value' => '%s'
        ,'description' => '(i.e. All Orders)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'edit_item'
        ,'label' => 'Edit Item'
        ,'value' => 'Edit %s'
        ,'label_position' => 'before'
        ,'description' => '(i.e. Edit Order)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'new_item'
        ,'label' => 'New Item'
        ,'value' => 'New %s'
        ,'label_position' => 'before'
        ,'description' => '(i.e. New Order)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'view_item'
        ,'label' => 'View Item'
        ,'value' => 'View %s'
        ,'label_position' => 'before'
        ,'description' => '(i.e. View Order)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'search_items'
        ,'label' => 'Search Items'
        ,'value' => 'Search %s'
        ,'label_position' => 'before'
        ,'description' => '(i.e. Search Orders)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'not_found'
        ,'label' => 'Not Found'
        ,'value' => 'No %s Found'
        ,'label_position' => 'before'
        ,'description' => '(i.e. No Orders Found)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'not_found_in_trash'
        ,'label' => 'Not Found In Trash'
        ,'value' => 'No %s Found in Trash'
        ,'label_position' => 'before'
        ,'description' => '(i.e. No Orders Found in Trash)'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'parent_item_colon'
        ,'label' => 'Parent Item with a colon'
        ,'value' => 'Parent %s:'
        ,'label_position' => 'before'
        ,'description' => '(i.e. Parent Order:)'
        ,'columns' => 12
        ,'conditions' => array(
            array(
              'field' => 'hierarchical'
              ,'value' => 'false'
            )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'menu_name'
        ,'label' => 'Menu Name'
        ,'value' => '%s'
        ,'label_position' => 'before'
        ,'description' => 'Name to appear in menu (i.e. Orders)'
        ,'columns' => 12
      )
    )
  ));


?>