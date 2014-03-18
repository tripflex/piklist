<?php
/*
Title: Piklist Deactivation
Setting: piklist_core
Order: 10
*/


if (isset( $_GET['referer']) && $_GET['referer'] == 'plugins.php'): ?>

  <div id="message" class="error">

    <p>
      <?php echo '<strong>', __('WARNING: Deactivating Piklist may disable functionality on this website.','piklist'), '</strong>';?>
    </p>

    <p>
      <?php _e('Before deactivating please make sure other Plugins or your Theme do not rely on Piklist.', 'piklist'); ?>
    </p>

    <p>
      <?php _e('If you still want to deactivate Piklist:', 'piklist'); ?>
        <ol>
          <li><?php _e('Change the setting below to: Allow Deactivation.', 'piklist'); ?></li>
          <li><?php _e('SAVE the Settings.', 'piklist'); ?></li>
          <li><?php printf(__('Return to the %1$sPlugins page%2$s and disable Piklist normally.','piklist'),'<a href="plugins.php">','</a>');?></li>
        <ol>
    </p>

  </div>

<?php else: ?>

  <p>
    <?php _e('Stops Piklist from being deactivated, and replaces the standard DEACTIVATE link for Piklist, with a link to this page.', 'piklist'); ?>
  </p>

  <p>
    <?php _e('When a user clicks on the new link on the plugins page, they will be brought here, and shown a warning.', 'piklist'); ?>
  </p>

<?php endif; ?>
  
<?php

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'deactivation_link'
    ,'label' => __('Piklist Deactivation', 'piklist')
    ,'help' => __('Deactivating Piklist may disable functionality on this website.', 'piklist')
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'unlock' => __('Allow Deactivation', 'piklist')
      ,'lock' => __('Lock', 'piklist')
    )
  ));


  
?>