<?php
/*
Post Type: piklist_content_type
Order: 199
Priority: core
Locked: true
Meta Box: false
Collapse: false
*/


//KM: a few things:
// You need to make sure the first ID is always DRAFT
// We should format the add-mores better.  The label should only appear under the last field.
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'status'
    ,'add_more' => true
    ,'label' => 'Create custom statuses'
    ,'description' => 'Override the standard WordPress statuses (i.e. draft, published, etc.)'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'id'
        ,'label' => 'ID'
        ,'columns' => 4
      )
     ,array(
        'type' => 'text'
        ,'field' => 'label'
        ,'label' => 'Label'
        ,'columns' => 4
     )
    )
  ));



?>