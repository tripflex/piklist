<?php
/*
Title: Custom Groups
Setting: piklist_demo_fields
Tab: Custom
Order: 10
*/
    
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'demo_address'
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
  ));

?>