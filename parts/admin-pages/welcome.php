<?php
/*
Page: piklist
*/

global $current_user;
get_currentuserinfo();

?>


<div id="piklist-welcome" class="wrap about-wrap">

    <h1>
      <?php _e('Welcome to Piklist','piklist');?>
    </h1>

    <p class="about-text">
      <?php _e('Piklist was designed from the ground up to be a powerful, flexible framework for WordPress. With Piklist you can tailor and extend WordPress even more!','piklist');?>
    </p>

    <div id="get-piklist-news-badge">

      <h4>
        <?php _e('Get Piklist News', 'piklist');?><br>
        <?php _e('in your inbox.', 'piklist');?>
      </h4>

      <div id="subscribe-to-piklist">
        <form action="http://piklist.us5.list-manage.com/subscribe/post?u=48135d6d0775070599e9ddaee&amp;id=19ac927f9d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <label for="mce-EMAIL">
            <?php _e('Send to:', 'piklist');?>
          </label>
          <input type="email" value="<?php echo $current_user->user_email; ?>" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter email address" required>
          <div class="clear">
            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button-primary">
          </div>
        </form>
      </div>

    </div>

    <p class="piklist-social-links">
      <a target="_blank" title="<?php _e('Like Piklist on Facebook','piklist');?>" class="piklist-social piklist-social-facebook" href="https://www.facebook.com/Piklist"><?php _e('Like','piklist');?></a>
      <a target="_blank" title="<?php _e('Like Piklist on Google Plus','piklist');?>" class="piklist-social piklist-social-google-plus" href="https://plus.google.com/u/0/108403125978548990804/posts"><?php _e('Follow','piklist');?></a>
      <a target="_blank" title="<?php _e('Follow Piklist on Twitter','piklist');?>" class="piklist-social piklist-social-twitter"href="https://www.twitter.com/Piklist"><?php _e('Follow','piklist');?></a>
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://piklist.com" data-text="I'm using Piklist and loving it!" data-via="piklist" data-size="large" data-hashtags="piklist">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </p>

    <div class="feature-section col three-col">
    
      <div>
        <h4>
          <?php _e('Post Meta','piklist');?>
        </h4>
    
        <p>
          <?php _e('Add post meta, taxonomy, post, comment, and other field types to your post edit screens.','piklist');?>
        </p>
      </div>

      <div>  
        <h4>
          <?php _e('Meta Boxes','piklist');?>
        </h4>
    
        <p>
          <?php _e('Order, Lock and Collapse your Meta Boxes by simply setting a comment!','piklist');?>
        </p>
      </div>

      <div class="last-feature">    
        <h4>
          <?php _e('Admin Pages','piklist');?>
        </h4>
      
        <p>
          <?php _e('Custom Admin Pages couldn\'t be easier to build and extend!','piklist');?>
        </p>
      </div>

    </div>

    <div class="feature-section col three-col">

      <div>
        <h4>
          <?php _e('Fields','piklist');?>
        </h4>
      
        <p>
          <?php _e('Text, textarea, select, radio, checkbox, wysiwyg, datepicker, timepicker, colorpicer, and more!','piklist');?>
        </p>
      </div>
    
      <div>
        <h4>
          <?php _e('Settings','piklist');?>
        </h4>
      
        <p>
          <?php _e('Add new Settings Pages with ease, and make them look sharp with WordPress tabs.','piklist');?>
        </p>
      </div>

      <div class="last-feature">
        <h4>
          <?php _e('Widgets','piklist');?>
        </h4>
    
        <p>
          <?php _e('Create Widgets and Widget Forms without being a advanced programmer! If you can create a loop you can build a widget!','piklist');?>
        </p>
      </div>

    </div>

      <div class="feature-section col three-col">

      <div>
        <h4>
          <?php _e('Field Templates','piklist');?>
        </h4>
    
        <p>
          <?php _e('Create your own html templates for your forms and fields... you know best right?','piklist');?>
        </p>
      </div>

      <div>
        <h4>
          <?php _e('Group Fields','piklist');?>
        </h4>
      
        <p>
          <?php _e('Group any number of fields of any time to create your own custom fields, formatting included!','piklist');?>
        </p>
      </div>

      <div class="last-feature">
        <h4>
          <?php _e('Add-More Fields','piklist');?>
        </h4>
    
        <p>
          <?php _e('Any field can be an Add More field, even Group fields! For those times when you need a little more...','piklist');?>
        </p>
      </div>

    </div>


    <div class="feature-section col three-col">

      <div>
        <h4>
          <?php _e('Custom Post Types','piklist');?>
        </h4>
    
        <p>
          <?php _e('Now packaged with more options like custom statuses support, column headers, and meta box control.','piklist');?>
        </p>
      </div>

      <div>
        <h4>
          <?php _e('Taxonomies','piklist');?>
        </h4>
      
        <p>
          <?php _e('Easily create Taxonomies and gain more control over how they appear on edit screens.','piklist');?>
        </p>
      </div>

      <div class="last-feature">
        <h4>
          <?php _e('Styles and Scripts','piklist');?>
        </h4>
    
        <p>
          <?php _e('Easily add styles and scripts to your site with conditional script support!','piklist');?>
        </p>
      </div>
    
    </div>

    <div class="welcome-panel-dismiss">
      <?php _e('...stay tuned, more features, tutorials and docs coming soon...','piklist');?>
    </div>

    <div class="about-text">
      <?php printf( __('Do you have any questions? Please post them on our %1$s Support Forum %2$s', 'piklist'), '<a href="http://piklist.com/support?#utm_source=wpadmin&utm_medium=welcomepage&utm_campaign=piklistplugin" target="_blank">','</a>' );?>
    </div>

    <p class="piklist-social-links">
      <a target="_blank" title="<?php _e('Like Piklist on Facebook','piklist');?>" class="piklist-social piklist-social-facebook" href="https://www.facebook.com/Piklist"><?php _e('Like','piklist');?></a>
      <a target="_blank" title="<?php _e('Like Piklist on Google Plus','piklist');?>" class="piklist-social piklist-social-google-plus" href="https://plus.google.com/u/0/108403125978548990804/posts"><?php _e('Follow','piklist');?></a>
      <a target="_blank" title="<?php _e('Follow Piklist on Twitter','piklist');?>" class="piklist-social piklist-social-twitter"href="https://www.twitter.com/Piklist"><?php _e('Follow','piklist');?></a>
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://piklist.com" data-text="I'm using Piklist and loving it!" data-via="piklist" data-size="large" data-hashtags="piklist">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </p>

</div>


<style type="text/css">
  
  /* A few fixes for the welcome columns, this way they behave a little better when there are rows of them */
  
  
  @media all and (min-width: 711px) {

    .welcome-panel-column-container .welcome-panel-column:nth-child(3n+1) {
      clear: left;
    }
    
  }
  
  @media all and (max-width: 710px) {

    .welcome-panel-column-container .welcome-panel-column:nth-child(2n+1) {
      clear: left;
    }
    
    .welcome-panel-last {
      margin-right: 5% !important;
    }
    
  }
  
</style>