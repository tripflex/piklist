<?php
/*
Title: Add More Fields <span class="piklist-title-right">Order 1</span>
Post Type: piklist_demo
Order: 1
Collapse: true
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_add_more'
    ,'label' => __('Text')
    ,'add_more' => true
    ,'value' => 'single'
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'demo_add_more_group_todo'
    ,'label' => __('Todo\'s (Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'user'
        ,'label' => 'Assigned to'
        ,'columns' => 4
        ,'choices' => piklist(
           get_users(
             array(
              'orderby' => 'display_name'
              ,'order' => 'asc'
             )
             ,'objects'
           )
           ,array(
             'ID'
             ,'display_name'
           )
          )
        )
        ,array(
          'type' => 'text'
          ,'field' => 'task'
          ,'label' => 'Task'
          ,'columns' => 8
        )
    )
  ));
 
  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Todo\'s (Un-Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'demo_add_more_todo_user'
        ,'label' => 'Assigned to'
        ,'columns' => 4
        ,'choices' => piklist(
           get_users(
             array(
              'orderby' => 'display_name'
              ,'order' => 'asc'
             )
             ,'objects'
           )
           ,array(
             'ID'
             ,'display_name'
           )
          )
        )
        ,array(
          'type' => 'text'
          ,'field' => 'demo_add_more_todo_task'
          ,'label' => 'Task'
          ,'columns' => 8
        )
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Content Section (Grouped)')
    ,'decription' => __('When an add-more field is nested it should be grouped to maintain the data relationships.')
    ,'field' => 'demo_content'
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'title'
        ,'label' => 'Section Title'
        ,'columns' => 12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'tagline'
        ,'label' => 'Section Tagline'
        ,'columns' => 12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'group'
        ,'field' => 'content'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'select'
            ,'field' => 'post_id'
            ,'label' => 'Content Title'
            ,'columns' => 12
            ,'choices' => piklist(
              get_posts(
                 array(
                  'post_type' => 'post'
                  ,'orderby' => 'post_date'
                 )
                 ,'objects'
               )
               ,array(
                 'ID'
                 ,'post_title'
               )
            )
          )
        )
      )
    )
  ));

?>