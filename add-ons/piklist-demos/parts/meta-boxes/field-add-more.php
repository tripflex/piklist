<?php
/*
Title: Add More Fields <span class="piklist-title-right">Order 1</span>
Post Type: piklist_demo
Order: 1
Collapse: false
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
    ,'label' => __('Todo\'s(Un-Grouped)')
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
    ,'label' => __('Content Section(Un-Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'demo_content_section_title'
        ,'label' => 'Section Title'
        ,'columns' => 12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'demo_content_section_tagline'
        ,'label' => 'Section Tagline'
        ,'columns' => 12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'group'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'select'
            ,'field' => 'demo_content_section_title'
            ,'value' => 'ID'
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


  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Add Contacts (Un-Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'nested_company_name'
        ,'label' => 'Company Name'
        ,'columns' => 7
        ,'attributes' => array(
          'class' => 'regular-text'
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'nested_industry'
        ,'label' => 'Industry'
        ,'columns' => 5
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'choices' => array(
          'arts-and-entertainment' => 'Arts and Entertainment'
          ,'automotive' => 'Automotive'
          ,'beauty-and-fitness'=>'Beauty and Fitness'
          ,'books-and-literature'=> 'Books and Literature'
          ,'business-and-industrial-markets'=> 'Business and Industrial Markets'
          ,'computers-and-electronics' => 'Computers and Electronics'
          ,'finance' => 'Finance'
          ,'food-and-drink' => 'Food and Drink'
          ,'games' => 'Games'
          ,'healthcare' => 'Healthcare'
          ,'home-and-garden' => 'Home and Garden'
          ,'internet-and-telecom' => 'Internet and Telecom'
          ,'jobs-and-education' => 'Jobs and Education'
          ,'news' => 'News'
          ,'real-estate' => 'Real Estate'
          ,'science' => 'Science'
          ,'shopping' => 'Shopping'
          ,'sports' => 'Sports'
          ,'travel' => 'Travel'
          ,'other' => 'Other'
        )
      )
      ,array(
        'type' => 'group'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'nested_first_name'
            ,'label' => 'First Name'
            ,'columns' => 6
          )
          ,array(
            'type' => 'text'
            ,'field' => 'nested_last_name'
            ,'label' => 'Last Name'
            ,'columns' => 6
          )
          ,array(
            'type' => 'group'
            ,'add_more' => true
            ,'fields' => array(
              array(
                'type' => 'select'
                ,'field' => 'nested_phone_type'
                ,'columns' => 5
                ,'choices' => array(
                  'home' => 'Home'
                  ,'work' => 'Work'
                  ,'mobile' => 'Mobile'
                )
              )
              ,array(
                'type' => 'text'
                ,'field' => 'nested_phone_number'
                ,'label' => 'Phone Number'
                ,'columns' => 7
              )
            )
          )
          ,array(
            'type' => 'group'
            ,'add_more' => true
            ,'fields' => array(
              array(
                'type' => 'select'
                ,'field' => 'nested_email_address_type'
                ,'columns' => 5
                ,'choices' => array(
                  'home' => 'Personal'
                  ,'work' => 'Work'
                )
              )
              ,array(
                'type' => 'text'
                ,'field' => 'nested_email_address'
                ,'label' => 'Email Address'
                ,'columns' => 7
              )
            )
          )
        )
      )
    )
  ));

?>