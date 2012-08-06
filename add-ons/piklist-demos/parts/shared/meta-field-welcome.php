
<br />

<ul class="wp-tab-bar">
  <li class="wp-tab-active"><a href="#"><?php _e('File Location'); ?></a></li>
  <li><a href="#"><?php _e('Sizing'); ?></a></li>
  <li><a href="#"><?php _e('Javascript Fields'); ?></a></li>
  <li><a href="#"><?php _e('Add More Fields'); ?></a></li>
  <li><a href="#"><?php _e('Field Templates'); ?></a></li>
</ul>

<div class="wp-tab-panel">
  
  <h4><?php _e('This file can be found in...'); ?></h4>

  <code><?php echo str_replace(ABSPATH, '', $location); ?></code>

</div>

<div class="wp-tab-panel">
  
  <h4><?php _e('How can I change the size of a field or field element?'); ?></h4>
  
  <p>
    <?php _e('These can be sized by applying the following standard WordPress classes to your fields.'); ?>
  </p>

  <code>small-text</code>
  <code>regular-text</code>
  <code>large-text</code>
  <code>widefat</code>
  <code>code</code>

  <h4><?php _e('Columns'); ?></h4>

  <p>
    <?php _e('By setting the '); ?><code>columns</code><?php _e(' attribute'); ?> <code>(1-12)</code> <?php _e('on a field or on its attributes to apply it directly to the element itself.'); ?>
  </p>
  
</div>

<div class="wp-tab-panel">

  <h4><?php _e('Javascript Options'); ?></h4>
  <p>
    <?php _e('Some fields are enhanced with Javascript, the Datepicker for example. When using these fields you can pass the '); ?>
    <code>options</code>
    <?php _e(' array with the options for the field as it would be defined normally.'); ?>
  </p>
  
  <pre><code>'options' => array(
    'dateFormat' => 'd M, y'
  )</code></pre>
  
</div>

<div class="wp-tab-panel">

  <h4><?php _e('Make any field and Add More Field'); ?></h4>
  <p>
    <?php _e('To allow any field to use the Add More functionality just pass the following with the field.'); ?>
  </p>
  
  <pre><code>'add_more' => true</code></pre>
  
</div>

<div class="wp-tab-panel">
  
  <h4><?php _e('Change the Field Template to anything!'); ?></h4>
  
  <p>
    <?php _e('Easily swap out the template used to generate any form/field. Once defined as below simply define the following on the field.'); ?>
  </p>
  
  <pre><code>'template' => 'piklist_demo'</code></pre>
  
  <pre><code>add_filter('piklist_field_templates', 'piklist_demo_field_templates');
  function piklist_demo_field_templates($templates)
  {
    $templates['piklist_demo'] = '<?php echo htmlspecialchars('<div class="piklist-example-fields-custom-template">
                                      [field_wrapper]
                                        <div style="display: block;">
                                          [field_label]
                                        </div>
                                        <div id="%1$s" class="%2$s">
                                          [field]
                                          [field_description_wrapper]
                                            <small>[field_description]</small>
                                          [/field_description_wrapper]
                                        </div>
                                      [/field_wrapper]
                                    </div>'); ?>';

    return $templates;
  }</code></pre>
  
</div>
