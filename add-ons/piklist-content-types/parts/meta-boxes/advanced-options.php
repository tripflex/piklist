<?php
/*  
Post Type: piklist_content_type
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
    ,'description' => 'This enables public access for the Content Type.'
    ,'fields' => array(
      array(
        'type' => 'checkbox'
        ,'field' => 'public'
        ,'value' => 'true'
        ,'choices' => array(
          'true' => '<strong>' . __('Select All') . '</strong>'
        )
        ,'conditions' => array(
          array(
            'field' => 'exclude_from_search'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'show_in_nav_menus'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'show_in_admin_bar'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'publicly_queryable'
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
          ,array(
            'field' => 'show_in_menu'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
        )
      )
      // KM: anyway to change this to INCLUDE in search?
      ,array(
        'type' => 'checkbox'
        ,'field' => 'exclude_from_search'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Exclude from front end searches.'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'show_in_nav_menus'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Enable for Navigation Menus.'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'show_in_admin_bar'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Show in WordPress Admin Bar.'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'publicly_queryable'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Allow front-end queries to be performed.'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'show_ui'
        ,'value' => 'true' 
        ,'choices' => array(
          'true' => 'Generate Administration UI.'
        )
      )

      ,array(
        'type' => 'checkbox'
        ,'field' => 'show_in_menu'
        ,'value' => 'true'
        ,'choices' => array(
          'true' => 'Show Administration menu as [field=show_ui_menu_type]'
        )
        ,'fields' => array(
          array(
            'type' => 'select'
            ,'field' => 'show_ui_menu_type'
            ,'embed' => true
            ,'choices' => array(
              'top' => 'Top Level'
              ,'sub' => 'Sub Level'
            )
          )
          ,'conditions' => array(
            array(
              'field' => 'show_ui'
              ,'value' => 'true'
            )
          )
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'show_ui_menu_sub'
        ,'label' => 'Existing Top Level Page'
        ,'label_position' => 'before'
        ,'value' => 'tools.php'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'conditions' => array(
          array(
            'field' => 'show_ui'
            ,'value' => 'true'
          )
          ,array(
            'field' => 'show_ui_menu_type'
            ,'value' => 'sub'
          )
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'menu_position'
        ,'label' => 'Show menu below'
        ,'label_position' => 'before'
        ,'value' => '25'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'choices' => array(
          '5' => 'Posts'
          ,'10' => 'Media'
          ,'15' => 'Links'
          ,'20' => 'Pages'
          ,'25' => 'Comments'
          ,'60' => 'First Separator'
          ,'65' => 'Plugins'
          ,'70' => 'Users'
          ,'75' => 'Tools'
          ,'80' => 'Settings'
          ,'100' => 'Second Separator'
        )
         ,'conditions' => array(
          array(
            'field' => 'show_ui'
            ,'value' => 'true'
          )
          ,array(
            'field' => 'show_ui_menu_type'
            ,'value' => 'top'
          )
        )
      )
    )
  ));

?>

  <hr>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'menu_icon'
    ,'label' => 'Menu Icon'
    ,'value' => 'http://'
    ,'description' => 'URL to the icon to be used for this menu.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'hide_screen_options'
    ,'label' => 'Screen Options'
    ,'value' => 'false'
    ,'choices' => array(
      'true' => 'Hide the screen options tab.'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'has_archive'
    ,'label' => 'Enable archives'
    ,'value' => 'false'
    ,'choices' => array(
      'true' => 'Create archives on frontend'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'can_export'
    ,'label' => 'Allow Export'
    ,'value' => 'false'
    ,'choices' => array(
      'true' => 'Allow exporting of content.'
    )
  ));

?>

  <hr>


<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'admin_body_class'
    ,'add_more' => true
    ,'label' => 'Admin Body Class'
    ,'description' => 'Add css classes to the admin_body_class'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'class'
        ,'columns' => 4
      )
    )
  ));

?>

  <hr>

<?php

  // Note: As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior.
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'supports'
    ,'value' => array(
                  'title'
                  ,'editor'
                )
    ,'label' => 'Supports'
    ,'list' => false
    ,'attributes' => array(
     'class' => 'text'
    ,'columns' => 3
    )
    ,'choices' => array(
      'title' => 'Title'
      ,'editor' => 'Editor'
      ,'author' => 'Author'
      ,'excerpt' => 'Excerpt'
      ,'custom-fields' => 'Custom Fields'
      ,'page-attributes' => 'Page Attributes'
      ,'post-formats' => 'Post Formats'
      ,'comments' => 'Comments'
      ,'trackbacks' => 'Trackbacks'
      ,'revisions' => 'Revisions'
    )
  ));

?>

  <hr>

<?php

piklist('field', array(
  'type' => 'checkbox'
  ,'field' => 'hide_meta_box'
  ,'label' => 'Hide Meta boxes'
  ,'description' => 'KM: I think we decided to change this to SHOW_META_BOXES'
  ,'list' => false
  ,'attributes' => array(
   'class' => 'text'
  ,'columns' => 3
  )
  ,'choices' => array(
    'list' => 'KM: auto generate list here'
  )
));

?>

  <hr>

<?php

piklist('field', array(
  'type' => 'checkbox'
  ,'field' => 'edit_columns'
  ,'label' => 'Edit columns'
  ,'description' => 'KM: NOT SURE HOW YOU WANT TO HANDLE THIS PIKLIST PARAMETER'
  ,'list' => false
  ,'attributes' => array(
   'class' => 'text'
  ,'columns' => 3
  )
  ,'choices' => array(
    'list' => 'KM: auto generate list here'
  )
));

?>

  <hr>

<?php

piklist('field', array(
    'type' => 'group'
    ,'field' => 'pik_cct_rewrite'
    ,'label' => 'Rewrite Rules'
    ,'fields' => array(
      array(
        'type' => 'checkbox'
        ,'field' => 'rewrite'
        ,'value' => 'true'
        ,'choices' => array(
          'true' => '<strong>' . __('Select All') . '</strong>'
        )
        ,'conditions' => array(
          array(
            'field' => 'slug'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'rewrite_with_front'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'feeds'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'pages'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
          ,array(
            'field' => 'ep_mask'
            ,'value' => 'true' 
            ,'update' => 'true' 
            ,'type' => 'update'
          )
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'slug'
        ,'value' => 'true'
        ,'list' => false
        ,'attributes' => array(
          'class' => 'text'
        )
        ,'choices' => array(
          'true' => '[field=rewrite_slug_text] Custom slug ( i.e. order ). Default: Content Type Name.'
        )
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'rewrite_slug_text'
            ,'value' => '%s'
            ,'embed' => true
            ,'attributes' => array(
              'class' => 'text'
            )
          )
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'rewrite_with_front'
        ,'value' => 'true'
        ,'list' => false
        ,'attributes' => array(
          'class' => 'text'
        )
        ,'choices' => array(
          'true' => 'Prepend with front base'
        )
        ,'columns' => 12
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'feeds'
        ,'value' => 'true' //KM: defaults to value of has_archive
        ,'list' => false
        ,'attributes' => array(
          'class' => 'text'
        )
        ,'choices' => array(
          'true' => 'Create permalinks for feed'
        )
        ,'columns' => 12
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'pages'
        ,'value' => 'true'
        ,'list' => false
        ,'attributes' => array(
          'class' => 'text'
        )
        ,'choices' => array(
          'true' => 'Create permalinks for pagination'
        )
        ,'columns' => 12
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'ep_mask'
        ,'list' => false
        ,'attributes' => array(
          'class' => 'text'
        )
        ,'choices' => array(
          'true' => '[field=epmask_text] Default rewrite endpoint bitmask.'
        )
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'epmask_text'
            ,'value' => 'EP_PERMALINK'
            ,'embed' => true
            ,'attributes' => array(
              'class' => 'text'
            )
          )
        )
      )
    )
  ));



?>

  <hr>

<?php


  piklist('field', array(
    'type' => 'select'
    ,'field' => 'query_var'
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
    ,'field' => 'custom_query_var'
    ,'description' => __('Custom Query Variable')
    ,'value' => 'true'
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text sub'
    )
   ,'conditions' => array(
     array(
      'field' => 'query_var'
      ,'value' => 'custom'
     )
   )
  ));

?>

  <hr>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'register_meta_box_cb'
    ,'label' => __('Register Meta Box Callback')
    ,'description' => __('Provide a callback function that will be called when setting up the meta boxes for the edit form')
    ,'list' => false
    ,'attributes' => array(
      'class' => 'text'
    )
  ));

?>

  <hr>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'capability_type'
    ,'label' => 'Capability Type'
    ,'value' => 'post'
    ,'description' => 'read, edit, and delete capabilities.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'capabilities'
    ,'label' => 'capabilities: NOT SURE WHAT TO DO HERE'
    ,'value' => 'post'
    ,'description' => ''
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'map_meta_cap'
    ,'label' => 'Map Meta Capabilites'
    ,'value' => 'false'
    ,'choices' => array(
      'true' => 'Use internal default meta capability handling.'
    )
  ));

?>