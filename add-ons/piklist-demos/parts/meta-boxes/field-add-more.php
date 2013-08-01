<?php
/*
Title: Add More Fields <span class="piklist-title-right">Order 1</span>
Post Type: piklist_demo
Order: 1
Collapse: false
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'test_add_more'
    ,'label' => __('Text')
    ,'add_more' => true
    ,'value' => 'single'
  ));

  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'test_add_more_textarea'
    ,'label' => __('Text Area')
    ,'add_more' => true
    ,'value' => 'This is some default text.'
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
  ));
 
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'test_add_more_grouped'
    ,'label' => __('Test ~ Add More Group (Grouped)')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_1'
        ,'value' => 'one'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_2'
        ,'value' => 'two'
      )
      ,array(
        'type' => 'text'
        ,'field' => 'test_add_more_grouped_3'
        ,'value' => 'three'
      )
    )
  ));
   
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'test_add_more_group_nested'
    ,'label' => __('Test ~ Add More Group Nested')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'test_add_more_group_1'
        ,'value' => 'one'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'test_add_more_group_2'
        ,'value' => 'first'
        ,'attributes' => array(
          'class' => 'regular-text'
        )
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
      ,array(
        'type' => 'group'
        ,'field' => 'test_add_more_nested_group'
        ,'add_more' => true
        ,'fields' => array(
          array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_2'
            ,'value' => 'two'
          )
          ,array(
            'type' => 'text'
            ,'field' => 'test_add_more_nested_group_3'
            ,'value' => 'three'
          )
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Add Contacts Demo (Nested Add-More)')
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