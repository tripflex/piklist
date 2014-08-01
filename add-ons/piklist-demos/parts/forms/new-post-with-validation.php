<?php
/*  
Title: Post Submit
Method: post
Message: Test Entry Saved.
*/

  // [piklist_form form="new-post-validation" add_on="piklist-demos"]

  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_type'
    ,'value' => 'piklist_demo_entry'
  ));

  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_status'
    ,'value' => 'pending'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post'
    ,'field' => 'post_title'
    ,'label' => 'Title'
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_required_validate'
    ,'scope' => 'post_meta'
    ,'label' => 'Text Required'
    ,'description' => "required => true"
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_limit_validate'
    ,'scope' => 'post_meta'
    ,'label' => 'Text Limit Validate'
    ,'add_more' => true
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 1
          ,'max' => 2
        )
      )
    )
  ));

  piklist('field', array(
    'type'    => 'group'
    ,'field'   => 'group_required_validate'
    ,'scope' => 'post_meta'
    ,'label'   => 'Group Required'
    ,'add_more'=> true
    ,'fields'  => array(
      array(
        'type' => 'text'
        ,'field' => 'name'
        ,'columns' => 8
        ,'attributes' => array(
          'placeholder' => 'Name'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'hierarchical_validate'
        ,'required' => true
        ,'columns' => 4
        ,'choices' => array(
          'true' => 'Hierarchical'
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'label' => 'File Name'
    ,'field' => 'file_name_validate'
    ,'scope' => 'post_meta'
    ,'description' => 'Converts multiple words to a valid file name'
    ,'sanitize' => array(
      array(
        'type' => 'file_name'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'emaildomain_validate'
    ,'scope' => 'post_meta'
    ,'label' => 'Email address'
    ,'description' => __('Validate Email and Email Domain')
    ,'validate' => array(
      array(
        'type' => 'email'
      )
      ,array(
        'type' => 'email_domain'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'file_exists_validate'
    ,'scope' => 'post_meta'
    ,'label' => __('File exists?')
    ,'description' => 'Test with: http://wordpress.org/plugins/about/readme.txt'
    ,'validate' => array(
      array(
        'type' => 'file_exists'
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'image_validate'
    ,'scope' => 'post_meta'
    ,'label' => __('Image')
    ,'description' => 'Test with: http://piklist.com/wp-content/themes/piklistcom-base/images/piklist-logo@2x.png'
    ,'validate' => array(
      array(
        'type' => 'image'
      )
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'checkbox_validate'
    ,'scope' => 'post_meta'
    ,'label' => 'Checkbox'
    ,'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 2
          ,'max' => 2
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'upload_media_validate'
    ,'scope' => 'post_meta'
    ,'label' => __('Add File','piklist')
    ,'options' => array(
      'modal_title' => __('Add File','piklist')
      ,'button' => __('Add','piklist')
    )
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 1
          ,'max' => 1
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'address_group_add_more_validate'
    ,'scope' => 'post_meta'
    ,'add_more' => true
    ,'label' => 'Grouped/Add-More with Limit'
    ,'description' => 'No more than 2'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'group_field_1'
        ,'label' => 'Field 1'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'group_field_2'
        ,'label' => 'Field 2'
        ,'columns' => 12
      )
    )
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 1
          ,'max' => 2
        )
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'add_more' => true
    ,'label' => 'UnGrouped/Add-More with Limit'
    ,'scope' => 'post_meta'
    ,'description' => 'No more than 2'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'group_field_1_test'
        ,'label' => 'Field 1'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'group_field_2_test'
        ,'label' => 'Field 2'
        ,'columns' => 12
      )
    )
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 1
          ,'max' => 2
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Submit'
  ));
