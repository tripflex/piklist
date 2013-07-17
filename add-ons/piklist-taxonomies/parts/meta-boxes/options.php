<?php
/*
Post Type: piklist_taxonomy
Order: 10
Priority: core
Locked: true
Meta Box: false
Collapse: false
*/

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post'
    ,'field' => 'post_name'
    ,'label' => 'Taxonomy Name'
    ,'attributes' => array(
      'class' => 'text'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'pik_tax_hierarchical'
    ,'label' => 'Hierarchical'
    ,'description' => 'Hierarchical (have descendants) like categories or non-hierarchical like tags.'
    ,'value' => 'true'
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'true' => 'Hierarchical (i.e. Categories)'
      ,'false' => 'Non-Hierarchical (i.e. Tags)'
    )
  ));

  $get_post_types = piklist(get_post_types(
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
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_object_type'
    ,'label' => 'Associated Post Type(s)'
    ,'description' => 'Post Types that will be used with this Taxonomy'
    ,'list' => count($get_post_types) < 5 ? true : false // If 5 or more post types than show in columns
    ,'required' => true
    ,'attributes' => array(
      'class' => 'text'
      ,'columns' => 3
    )
    ,'choices' => $get_post_types
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'advanced_labels'
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
    ,'field' => 'pik_tax_labels'
    ,'label' => 'Advanced Labels'
    ,'description' => 'Detailed Labels used in the Administration for this Taxonomy'
    ,'conditions' => array(
      array(
       'field' => 'advanced_labels'
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
        ,'description' => 'A plural descriptive name for the taxonomy (i.e. Orders)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'menu_name'
        ,'label' => 'Menu Name'
        ,'label_position' => 'before'
        ,'value' => '%s'
        ,'description' => 'Name to appear in menu (i.e. Orders)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'search_items'
        ,'label' => 'Search Items'
        ,'label_position' => 'before'
        ,'value' => 'Search %s'
        ,'description' => '(i.e. Search Orders)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'popular_items'
        ,'label' => 'Popular Items'
        ,'label_position' => 'before'
        ,'value' => 'Popular %s'
        ,'description' => '(i.e. Popular Orders)'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'false'
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'all_items'
        ,'label' => 'All Items'
        ,'label_position' => 'before'
        ,'value' => 'All %s'
        ,'description' => '(i.e. All Orders)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'parent_item'
        ,'label' => 'Parent Item'
        ,'label_position' => 'before'
        ,'value' => 'Parent %s'
        ,'description' => '(i.e. Parent Order)'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'true'
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'parent_item_colon'
        ,'label' => 'Parent Item with a colon'
        ,'label_position' => 'before'
        ,'value' => 'Parent %s:'
        ,'description' => '(i.e. Parent Order:)'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'true'
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'edit_item'
        ,'label' => 'Edit Item'
        ,'label_position' => 'before'
        ,'value' => 'Edit %s'
        ,'description' => '(i.e. Edit Order)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'update_item'
        ,'label' => 'Update Item'
        ,'label_position' => 'before'
        ,'value' => 'Update %s'
        ,'description' => '(i.e. Update Order)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'add_new_item'
        ,'label' => 'Add New Item'
        ,'label_position' => 'before'
        ,'value' => 'Add New %s'
        ,'description' => '(i.e. Add new Order)'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'new_item_name'
        ,'label' => 'New Item Name'
        ,'label_position' => 'before'
        ,'value' => 'New %s Name'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'separate_items_with_commas'
        ,'label' => 'Separate Items with Commas'
        ,'label_position' => 'before'
        ,'value' => 'Separate %s with Commas'
        ,'description' => 'Appears in the taxonomy meta box (i.e. Separate Orders with Commas). Non-Hierarchical only.'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'false'
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'add_or_remove_items'
        ,'label' => 'Add or Remove Items'
        ,'label_position' => 'before'
        ,'value' => 'Add or Remove %s'
        ,'description' => 'This Text is shown when JavaScript is disabled (i.e. Add or Remove Orders). Non-Hierarchical only.'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'false'
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'choose_from_most_used'
        ,'label' => 'Choose from most used'
        ,'label_position' => 'before'
        ,'value' => 'Choose from most used %s'
        ,'description' => '(i.e. Choose from most used Orders). Non-Hierarchical only.'
        ,'conditions' => array(
          array(
            'field' => 'pik_tax_hierarchical'
            ,'value' => 'false'
          )
        )
      )
    )
  ));

?>