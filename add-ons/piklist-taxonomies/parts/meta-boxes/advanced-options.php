<?php
/*  
Post Type: piklist_taxonomy
Order: 99
Priority: core
Locked: true
Meta Box: false
Collapse: false
*/

  global $wp_version;

  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Public'
    ,'description' => 'This enables public access for the taxonomy.'
    ,'fields' => array(
      array(
        'type' => 'checkbox'
        ,'field' => 'pik_tax_public'
        ,'value' => 'true'
        ,'choices' => array(
          'true' => '<strong>' . __('Select All') . '</strong>'
        )
        ,'conditions' => array(
          array(
            'field' => 'show_in_nav_menus'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'show_ui'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'pik_tax_show_in_nav_menus'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Enable for Navigation Menus'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'pik_tax_show_ui'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Generate Administration UI'
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_hide_meta_box'
    ,'label' => 'Hide Meta Box'
    ,'description' => 'Hide this taxonomies meta box when creating/editing content.'
    ,'value' => 'true'
    ,'choices' => array(
      'true' => 'Hide'
    )
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_show_tagcloud'
    ,'label' => 'Tag Cloud'
    ,'description' => 'Allow the Tag Cloud Widget to use this taxonomy.'
    ,'value' => 'true'
    ,'choices' => array(
      'true' => 'Allow'
    )
  ));

  if ($wp_version >= 3.5)
  {
    piklist('field', array(
      'type' => 'checkbox'
      ,'field' => 'pik_tax_show_admin_column'
      ,'label' => 'Show Admin Column'
      ,'description' => 'Show taxonomy column on associated post-types.'
      ,'choices' => array(
        'true' => 'Show'
      )
    ));
  }

?>

  <hr>

<?php

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'pik_tax_rewrite'
    ,'label' => __('Rewrite rules')
    ,'description' => __('Use "pretty permalinks" or Standard')
    ,'value' => 'true'
    ,'list' => false
    ,'choices' => array(
      'true' => 'Pretty permalinks'
      ,'false' => 'Standard urls'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_rewrite_with_front'
    ,'value' => 'true'
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'true' => 'Prepend with front base'
    )
    ,'conditions' => array(
      array(
       'field' => 'pik_tax_rewrite'
       ,'value' => 'true'
      )
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_rewrite_hierarchical'
    ,'value' => 'true'
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'true' => 'Allow hierarchical urls'
    )
    ,'conditions' => array(
      array(
       'field' => 'pik_tax_rewrite'
       ,'value' => 'true'
      )
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'pik_tax_rewrite_slug'
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'true' => '[field=pik_tax_rewrite_slug_text] Custom slug ( i.e. /order/ ). Default: Taxonomy Name.'
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'pik_tax_rewrite_slug_text'
        ,'value' => '%s'
        ,'embed' => true
        ,'attributes' => array(
          'class' => 'text'
        )
      )
    )
    ,'conditions' => array(
      array(
       'field' => 'pik_tax_rewrite'
       ,'value' => 'true'
      )
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'pik_tax_query_var'
    ,'label' => __('Query Variable')
    ,'description' => __('Allow direct queries through WP_Query')
    ,'value' => 'true'
    ,'list' => false
    ,'choices' => array(
      'true' => 'Use Default'
      ,'false' => 'Prevent queries'
      ,'custom' => 'Use Custom'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'pik_tax_custom_query_var'
    ,'description' => __('Custom Query Variable')
    ,'value' => 'true'
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text sub'
    )
    ,'conditions' => array(
      array(
       'field' => 'pik_tax_query_var'
       ,'value' => 'custom'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'pik_tax_update_count_callback'
    ,'label' => __('Update count callback function')
    ,'description' => sprintf( __('A function name that will be called to update the count of any associated $object_type.%si.e. my_custom_count_callback'), '<br>')
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));

?>

  <hr>

<?php

  // TODO: This should probably be in the main taxonomies.php file, or even in Piklist core.
  global $wp_roles; 
  $roles = array();
  $capabilities = array();
  $roles = $wp_roles->role_objects;

  $caps = piklist($roles, array('capabilities'));

  foreach ($caps as $section => $items)
  {
    foreach ($items as $key => $value)
    {
      $capabilities[$key] = ucwords(str_replace('_', ' ', $key));
    }
  }

  $capabilities = array_unique($capabilities);
  array_multisort($capabilities);

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'define_capabilities'
    ,'label' => __('Capabilities')
    ,'value' => 'true'
    ,'choices' => array(
      'true' => 'Use defaults'
      ,'false' => 'Set Custom'
    )
  ));


  piklist('field', array(
    'type' => 'group'
    ,'field' => 'pik_tax_capabilities'
    ,'label' => 'Advanced Capabilities'
    ,'description' => 'Define Capabilities'
    ,'conditions' => array(
      array(
       'field' => 'define_capabilities'
       ,'value' => 'false'
      )
    )
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'manage_terms'
        ,'label' => 'Manage Terms'
        ,'label_position' => 'before'
        ,'value' => 'manage_categories'
        ,'description' => sprintf( __('Manage Terms: capability to view terms in the admin.%sDefault: manage_categories.'), '<br>')
        ,'choices' => $capabilities
      )
      ,array(
        'type' => 'select'
        ,'field' => 'edit_terms'
        ,'label' => 'Edit Terms'
        ,'label_position' => 'before'
        ,'value' => 'manage_categories'
        ,'description' => sprintf( __('Edit Terms: capability to edit and create terms.%sDefault: manage_categories.'), '<br>')
        ,'choices' => $capabilities
      )
      ,array(
        'type' => 'select'
        ,'field' => 'delete_terms'
        ,'label' => 'Delete Terms'
        ,'label_position' => 'before'
        ,'value' => 'manage_categories'
        ,'description' => sprintf( __('Delete Terms: capability to delete terms from this taxonomy.%sDefault: manage_categories.'), '<br>')
        ,'choices' => $capabilities
      )
      ,array(
        'type' => 'select'
        ,'field' => 'assign_terms'
        ,'label' => 'Assign Terms'
        ,'label_position' => 'before'
        ,'value' => 'edit_posts'
        ,'description' =>  sprintf( __('Assign Terms: capability to assign terms in the new/edit post screen.%sDefault: edit_posts.'), '<br>')
        ,'choices' => $capabilities
      )
    )
  ));

?>