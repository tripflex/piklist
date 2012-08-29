<?php
/*
Width: 700
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text_small'
    ,'label' => __('Text ~ small-text')
    ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'small-text'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text'
    ,'label' => __('Text')
    ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'text'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text_large'
    ,'label' => __('Text ~ large-text')
    ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'large-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'demo_textarea_large'
    ,'label' => __('Textarea ~ large-text code')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'attributes' => array(
      'rows' => 10
      ,'cols' => 50
      ,'class' => 'large-text code'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'demo_select'
    ,'label' => __('Select')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice'
    )
    ,'attributes' => array(
      'class' => 'clear-left'
    )
  ));

  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'demo_radio'
    ,'label' => __('Radio')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'third'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice with a nested [field=radio_text_small] input.'
      ,'third' => 'Third Choice'
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'radio_text_small'
        ,'value' => '12345'
        ,'embed' => true
        ,'attributes' => array(
          'class' => 'small-text widefat'
        )
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'demo_checkbox'
    ,'label' => __('Checkbox')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'second'
    ,'choices' => array(
      'first' => 'First Choice'
      ,'second' => 'Second Choice'
      ,'third' => 'Third Choice with a nested [field=checkbox_select] input.'
    )
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'checkbox_select'
        ,'value' => 'third'
        ,'embed' => true
        ,'choices' => array(
          'first' => 'First Choice'
          ,'second' => 'Second Choice'
          ,'third' => 'Third Choice'
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'colorpicker'
    ,'field' => 'demo_color'
    ,'label' => __('Color Picker')
    ,'description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'attributes' => array(
      'class' => 'clear-left'
    )
  ));
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'demo_date'
    ,'label' => __('Date')
    ,'description' => __('Choose a date')
    ,'attributes' => array(
      'class' => 'clear-left'
    )
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'value' => date('M d, Y', time() + 604800)
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text_add_more'
    ,'add_more' => true
    ,'label' => __('Add More')
    ,'description' => __('ipsum dolor sit amet, consectetur adipiscing elit.')
    ,'value' => 'Lorem'
    ,'attributes' => array(
      'class' => 'text'
    )
  ));

?>