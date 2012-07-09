<?php
/*
Title: Select Fields
Setting: piklist-demo-fields
Order: 20
*/

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select'
    ,'label' => __('Select')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
  ));

