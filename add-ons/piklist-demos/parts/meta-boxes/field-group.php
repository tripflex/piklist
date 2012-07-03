<?php
/*
Title: Field Groups <span class="piklist-title-right">Order 80</span>
Post Type: piklist_demo
Order: 80
Priority: high
Collapse: true
*/
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'address'
    ,'scope' => 'post_meta'
    ,'label' => __('Address')
    ,'description' => __('This is an example of how to build a simple address field using the group type.')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => __('Street Address')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => __('PO Box, Suite, etc.')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'label' => __('City')
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'label' => __('State')
        ,'columns' => 4
        ,'choices' => array(
          'AL' => 'Alabama'
          ,'AK' => 'Alaska'  
          ,'AZ' => 'Arizona'  
          ,'AR' => 'Arkansas'  
          ,'CA' => 'California'  
          ,'CO' => 'Colorado'  
          ,'CT' => 'Connecticut'  
          ,'DE' => 'Delaware'  
          ,'DC' => 'District Of Columbia'  
          ,'FL' => 'Florida'  
          ,'GA' => 'Georgia'  
          ,'HI' => 'Hawaii'  
          ,'ID' => 'Idaho'  
          ,'IL' => 'Illinois'  
          ,'IN' => 'Indiana'  
          ,'IA' => 'Iowa'  
          ,'KS' => 'Kansas'  
          ,'KY' => 'Kentucky'  
          ,'LA' => 'Louisiana'  
          ,'ME' => 'Maine'  
          ,'MD' => 'Maryland'  
          ,'MA' => 'Massachusetts'  
          ,'MI' => 'Michigan'  
          ,'MN' => 'Minnesota'  
          ,'MS' => 'Mississippi'  
          ,'MO' => 'Missouri'  
          ,'MT' => 'Montana'
          ,'NE' => 'Nebraska'
          ,'NV' => 'Nevada'
          ,'NH' => 'New Hampshire'
          ,'NJ' => 'New Jersey'
          ,'NM' => 'New Mexico'
          ,'NY' => 'New York'
          ,'NC' => 'North Carolina'
          ,'ND' => 'North Dakota'
          ,'OH' => 'Ohio'  
          ,'OK' => 'Oklahoma'  
          ,'OR' => 'Oregon'  
          ,'PA' => 'Pennsylvania'  
          ,'RI' => 'Rhode Island'  
          ,'SC' => 'South Carolina'  
          ,'SD' => 'South Dakota'
          ,'TN' => 'Tennessee'  
          ,'TX' => 'Texas'  
          ,'UT' => 'Utah'  
          ,'VT' => 'Vermont'  
          ,'VA' => 'Virginia'  
          ,'WA' => 'Washington'  
          ,'WV' => 'West Virginia'  
          ,'WI' => 'Wisconsin'  
          ,'WY' => 'Wyoming'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'zip_code'
        ,'label' => __('Zip Code')
        ,'columns' => 3
      )
    )
    ,'position' => 'start'
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'address_add_more'
    ,'add_more' => true
    ,'scope' => 'post_meta'
    ,'label' => __('Address (Add More)')
    ,'description' => __('This is an example of how to build a simple address field using the group type.')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => __('Street Address')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => __('PO Box, Suite, etc.')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'label' => __('City')
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'label' => __('State')
        ,'columns' => 4
        ,'choices' => array(
          'AL' => 'Alabama'
          ,'AK' => 'Alaska'  
          ,'AZ' => 'Arizona'  
          ,'AR' => 'Arkansas'  
          ,'CA' => 'California'  
          ,'CO' => 'Colorado'  
          ,'CT' => 'Connecticut'  
          ,'DE' => 'Delaware'  
          ,'DC' => 'District Of Columbia'  
          ,'FL' => 'Florida'  
          ,'GA' => 'Georgia'  
          ,'HI' => 'Hawaii'  
          ,'ID' => 'Idaho'  
          ,'IL' => 'Illinois'  
          ,'IN' => 'Indiana'  
          ,'IA' => 'Iowa'  
          ,'KS' => 'Kansas'  
          ,'KY' => 'Kentucky'  
          ,'LA' => 'Louisiana'  
          ,'ME' => 'Maine'  
          ,'MD' => 'Maryland'  
          ,'MA' => 'Massachusetts'  
          ,'MI' => 'Michigan'  
          ,'MN' => 'Minnesota'  
          ,'MS' => 'Mississippi'  
          ,'MO' => 'Missouri'  
          ,'MT' => 'Montana'
          ,'NE' => 'Nebraska'
          ,'NV' => 'Nevada'
          ,'NH' => 'New Hampshire'
          ,'NJ' => 'New Jersey'
          ,'NM' => 'New Mexico'
          ,'NY' => 'New York'
          ,'NC' => 'North Carolina'
          ,'ND' => 'North Dakota'
          ,'OH' => 'Ohio'  
          ,'OK' => 'Oklahoma'  
          ,'OR' => 'Oregon'  
          ,'PA' => 'Pennsylvania'  
          ,'RI' => 'Rhode Island'  
          ,'SC' => 'South Carolina'  
          ,'SD' => 'South Dakota'
          ,'TN' => 'Tennessee'  
          ,'TX' => 'Texas'  
          ,'UT' => 'Utah'  
          ,'VT' => 'Vermont'  
          ,'VA' => 'Virginia'  
          ,'WA' => 'Washington'  
          ,'WV' => 'West Virginia'  
          ,'WI' => 'Wisconsin'  
          ,'WY' => 'Wyoming'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'zip_code'
        ,'label' => __('Zip Code')
        ,'columns' => 3
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'group_add_more'
    ,'scope' => 'post_meta'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('This is an example of how to build a list with multiple element types.')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'text_add_more'
        ,'value' => 'Lorem'
        ,'columns' => 4
      )
      ,array(
        'type' => 'datepicker'
        ,'field' => 'date_add_more'
        ,'options' => array(
          'dateFormat' => 'M d, y'
        )
        ,'value' => date('M d, y', time() + 604800)
        ,'columns' => 2
      )
      ,array(
        'type' => 'select'
        ,'field' => 'select_add_more'
        ,'value' => 'third'
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
        ,'columns' => 3
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Address (Un-Grouped)')
    ,'description' => __('This is an example of how to build a simple address field using the group type.')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'scope' => 'post_meta'
        ,'label' => __('Street Address')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'scope' => 'post_meta'
        ,'label' => __('PO Box, Suite, etc.')
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'scope' => 'post_meta'
        ,'label' => __('City')
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'scope' => 'post_meta'
        ,'label' => __('State')
        ,'columns' => 4
        ,'choices' => array(
          'AL' => 'Alabama'
          ,'AK' => 'Alaska'  
          ,'AZ' => 'Arizona'  
          ,'AR' => 'Arkansas'  
          ,'CA' => 'California'  
          ,'CO' => 'Colorado'  
          ,'CT' => 'Connecticut'  
          ,'DE' => 'Delaware'  
          ,'DC' => 'District Of Columbia'  
          ,'FL' => 'Florida'  
          ,'GA' => 'Georgia'  
          ,'HI' => 'Hawaii'  
          ,'ID' => 'Idaho'  
          ,'IL' => 'Illinois'  
          ,'IN' => 'Indiana'  
          ,'IA' => 'Iowa'  
          ,'KS' => 'Kansas'  
          ,'KY' => 'Kentucky'  
          ,'LA' => 'Louisiana'  
          ,'ME' => 'Maine'  
          ,'MD' => 'Maryland'  
          ,'MA' => 'Massachusetts'  
          ,'MI' => 'Michigan'  
          ,'MN' => 'Minnesota'  
          ,'MS' => 'Mississippi'  
          ,'MO' => 'Missouri'  
          ,'MT' => 'Montana'
          ,'NE' => 'Nebraska'
          ,'NV' => 'Nevada'
          ,'NH' => 'New Hampshire'
          ,'NJ' => 'New Jersey'
          ,'NM' => 'New Mexico'
          ,'NY' => 'New York'
          ,'NC' => 'North Carolina'
          ,'ND' => 'North Dakota'
          ,'OH' => 'Ohio'  
          ,'OK' => 'Oklahoma'  
          ,'OR' => 'Oregon'  
          ,'PA' => 'Pennsylvania'  
          ,'RI' => 'Rhode Island'  
          ,'SC' => 'South Carolina'  
          ,'SD' => 'South Dakota'
          ,'TN' => 'Tennessee'  
          ,'TX' => 'Texas'  
          ,'UT' => 'Utah'  
          ,'VT' => 'Vermont'  
          ,'VA' => 'Virginia'  
          ,'WA' => 'Washington'  
          ,'WV' => 'West Virginia'  
          ,'WI' => 'Wisconsin'  
          ,'WY' => 'Wyoming'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'zip_code'
        ,'scope' => 'post_meta'
        ,'label' => __('Zip Code')
        ,'columns' => 3
      )
    )
    ,'position' => 'end'
  ));
  
  piklist('shared/meta-field-welcome', array(
    'location' => __FILE__
  ));
  
?>