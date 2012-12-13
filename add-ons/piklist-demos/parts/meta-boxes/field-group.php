<?php
/*
Title: Field Groups <span class="piklist-title-right">Order 80</span>
Post Type: piklist_demo
Order: 80
Collapse: false
*/
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'address'
    ,'label' => 'Address'
    ,'list' => false
    ,'description' => 'This is an example of how to build a simple address field using the group type.'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => 'Street Address'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => 'PO Box, Suite, etc.'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'label' => 'City'
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'label' => 'State'
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
        ,'label' => 'Zip Code'
        ,'columns' => 3
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'address_add_more'
    ,'add_more' => true
    ,'label' => 'Address (Add More)'
    ,'description' => 'This is an example of how to build a simple address field using the group type.'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => 'Street Address'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => 'PO Box, Suite, etc.'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'label' => 'City'
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'label' => 'State'
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
        ,'label' => 'Zip Code'
        ,'columns' => 3
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'group_add_more'
    ,'add_more' => true
    ,'label' => 'Add More'
    ,'description' => 'This is an example of how to build a list with multiple element types.'
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
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Address (Un-Grouped)'
    ,'description' => 'This is an example of how to build a simple address field using the group type.'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'ungrouped_address_1'
        ,'label' => 'Street Address'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'ungrouped_address_2'
        ,'label' => 'PO Box, Suite, etc.'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'ungrouped_city'
        ,'label' => 'City'
        ,'columns' => 5
      )
      ,array(
        'type' => 'select'
        ,'field' => 'ungrouped_state'
        ,'label' => 'State'
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
        ,'field' => 'ungrouped_zip_code'
        ,'label' => 'Zip Code'
        ,'columns' => 3
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
  
  piklist('shared/meta-box-welcome', array(
    'location' => __FILE__
  ));
  
?>