<?php
/*
 * Page: piklist
 */

global $current_user;
get_currentuserinfo();

?>

<style type="text/css">

  html {
    background-color: #fff;
  }

  ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu > li.current > a.current:after {
    border-right-color: #fff;
  }

  .about-wrap .feature-section.two-col > div.alt-feature {
    float: right;
  }

  .wrap > h2 {
    display: none;
  }

  img.screenshot {
    width: 95%;
  }

  .icon16.icon-comments:before {
    font-size: 40px;
    padding: 0;
  }

  .wp-badge {
    color: #fdc0b0;
    background: url('/wp-content/plugins/piklist/parts/img/piklist-icon-white.png') no-repeat center 32px #c82b00 !important;
  }

  #mce-EMAIL {
    font-family: monospace;
    font-size: 14px;
    padding: 5px 2px;
    margin: 5px 0;
    width: 100%;
  }

  .piklist-social-links a {
    padding: 5px;
    color: #fff;
    text-decoration: none;
  }

  .piklist-social-links a:hover {
    text-decoration: none;
    color: #F0F0F0;
  } 
  
  .piklist-social-links a.facebook_link {
    background: #3460A1;
  }

  .piklist-social-links a.twitter_link {
    background: #29AAE3;
  }

  .piklist-social-links a.google_plus_link {
    background: #3460A1;
  }

  .piklist-social-links a span.dashicons {
    display: inline-block;
    -webkit-font-smoothing: antialiased;
    line-height: 1;
    font-family: 'Dashicons';
    text-decoration: none;
    font-weight: normal;
    font-style: normal;
    vertical-align: middle;
  }

  /* 3.7 style helpers */
  body.branch-3-7 .about-wrap .feature-section.col {
    margin-bottom: 0;
  }

  body.branch-3-7 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-7 img.screenshot {
    vertical-align: bottom;
  }

  body.branch-3-7 .wrap h2 {
    text-align: center;
  }

  body.branch-3-7 .about-wrap .feature-section.two-col {
    padding-bottom: 0;
  }

  /* 3.6 style helpers */
  body.branch-3-6 .about-wrap .feature-section img {
    border: none;
    box-shadow: none;
    margin: 0;
    vertical-align: bottom;
  }

  body.branch-3-6 .about-wrap .feature-section.two-col {
    padding-bottom: 0px;
  }

  body.branch-3-6 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-6 .about-wrap h3 {
    font-size: 22px;
  }



  @media (max-width: 782px) {

    html,
    #wpwrap {
      background-color: #fff;
    }

    .about-wrap .feature-section.two-col > div.alt-feature {
      float: none;
    }
}

</style>

<div class="wrap about-wrap">

<h1><?php echo __('Welcome to Piklist','piklist') . '&nbsp;'  . piklist::$version; ?></h1>

<div class="about-text"><?php _e('The most powerful framework available for WordPress.','piklist'); ?></div>

<div class="wp-badge"><?php printf(__('Version %s', 'piklist'), piklist::$version); ?></div>

<div class="piklist-social-links">
  <a class="facebook_link" href="http://facebook.com/piklist">
    <span class="dashicons dashicons-facebook-alt"></span>
  </a>
  <a class="twitter_link" href="http://twitter.com/piklist">
    <span class="dashicons dashicons-twitter"></span>
  </a>
  <a class="google_plus_link" href="https://plus.google.com/u/0/b/108403125978548990804/108403125978548990804/posts">
    <span class="dashicons dashicons-googleplus"></span>         
  </a>
</div><!-- .piklist-social-links -->



<div class="changelog">
  <h2 class="about-headline-callout">Now even more powerful than before.</h2>
</div>


<div class="changelog">
  <div class="feature-section col two-col">
    <div>
      <h3>Post relationships</h3>
      <h4>You'll wish all relationships were this easy.</h4>
      <p>Post relationships are standard with Piklist and easy to setup. Displaying them in your theme is even easier, since you can use the standard WordPress <code>query_posts</code> function.</p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('piklist/parts/img/post-relationships@2x.jpg');?>">
    </div>
  </div>
</div>

<hr>

<div class="changelog">
  <div class="feature-section col two-col">
    <div class="alt-feature">
      <h3>Add-Mores</h3>
      <h4>The infinite repeater field.</h4>
      <p>Piklist AddMore fields are the repeater field you always dreamed of. Group together as many fields as you want and make them repeat indefinitely. Or place an Add-More within an Add-More within an Add-more...</p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('piklist/parts/img/add-mores@2x.jpg');?>">
    </div>
  </div>
</div>

<hr>

<div class="changelog">
  <div class="feature-section col two-col">
    <div>
      <h3>WorkFlows</h3>
      <h4>The tab system you never knew was possible.</h4>
      <p>Piklist WorkFlows allows you to place tabs anywhere... and with <strong>anything</strong>. Tabs can include content from any page or even custom views you create.</p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('piklist/parts/img/workflow-user@2x.jpg');?>">
    </div>
  </div>
</div>

<hr>

<div class="changelog">
  <div class="feature-section col two-col">
    <div class="alt-feature">
      <h3>Multiple user roles</h3>
      <h4>Better security, more flexibility.</h4>
      <p>Powerful web sites and applications require multiple user roles and Piklist supports this out of the box. Standard WordPress functions can be used to validate a user's permissions and provide appropriate access to data.</p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('piklist/parts/img/user-roles@2x.jpg');?>">
    </div>
  </div>
</div>

<hr>

<div class="changelog">
  <h2 class="about-headline-callout">Customize everything in WordPress.</h2>
  <p class="about-description">Post Types, Taxonomies, User Profiles, Settings, Admin Pages, Widgets, Dashboard, Contextual Help, and more...</p>

  <div class="feature-section col three-col">

    <div class="col-1">
      <h3>Fields</h3>
        <ul>
          <li>Lock field values.</li>
          <li>Conditionally hide/show fields.</li>
          <li>Auto-update another field.</li>
          <li>Define field scopes.</li>
          <li>Add Tooltip Help.</li>
          <li>Customize field templates.</li>
        </ul>
    </div>

    <div class="col-2">
      <h3>Meta Boxes</h3>
        <ul>
          <li>Lock meta boxes</li>
          <li>Show/hide by user capability or role</li>
          <li>Set the order of meta boxes</li>
          <li>Hide meta box when creating a new post/term</li>
        </ul>
    </div>

    <div class="col-3 last-feature">
      <h3>Post Types</h3>
        <ul>
          <li>Create custom post statuses</li>
          <li>Change the "Enter title here" text</li>
          <li>Custom admin body classes</li>
          <li>Hide meta boxes</li>
        </ul>
    </div>

  </div>

  <div class="feature-section col three-col">
    
    <div class="col-1">
      <h3>List Tables</h3>
        <ul>
          <li>Change column headings</li>
          <li>Show post states</li>
          <li>Hide the post row actions</li>
        </ul>
    </div>

    <div class="col-2">
      <h3>User Profiles</h3>
        <ul>
          <li>Profiles can taken advantage of any Piklist field</li>
          <li>Show/hide fields by user capability or role</li>
          <li>Easily add User Taxonomies</li>
        </ul>
    </div>

    <div class="col-3 last-feature">
      <h3>Widgets, Dashboard & Help</h3>
        <ul>
          <li>Simply create complex widgets</li>
          <li>No object oriented programming required</li>
          <li>No help needed to create contextual help</li>
        </ul>
    </div>

  </div>

</div>

<hr>

<div class="changelog">
  <div class="feature-section col three-col">
    <div class="col-1">
      <h2 class="about-headline-callout">Get Started</h2>
      <p class="about-description">The built in demos is a great way to see what Piklist can do, and comes with tons of sample code.</p>
      <a href="<?php echo admin_url('admin.php?page=piklist-core-settings&tab=add-ons');?>">Activate Demos → </a>
    </div>
    <div class="col-2">
      <h2 class="about-headline-callout">Get Help</h2>
      <p class="about-description">Visit the Piklist community forums to get answers to your questions, and suggest new features.</p>
      <a href="http://piklist.com/support/">Visit Forums → </a>
    </div>
    <div class="col-3 last-feature">
      <h2 class="about-headline-callout">Get News</h2>
      <p class="about-description">Piklist updates in your inbox.</p>
        <form action="http://piklist.us5.list-manage.com/subscribe/post?u=48135d6d0775070599e9ddaee&amp;id=19ac927f9d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <label for="mce-EMAIL">
          <?php _e('Send to:', 'piklist');?>
        </label>
        <input type="email" value="<?php echo $current_user->user_email; ?>" name="EMAIL" class="regular-text email" id="mce-EMAIL" placeholder="Enter email address" required>
        <input type="hidden" name="SIGNUP" id="SIGNUP" value="plugin-piklist" />
        <div class="clear">
        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
        </div><!-- .clear -->
        </form>
    </div>
  </div>
</div>


<hr>

<p class="about-description">
  Piklist is created by a team of passionate individuals.
</p>

<h4 class="wp-people-group">Project Leaders</h4>

<ul class="wp-people-group " id="wp-people-group-project-leaders">

<li class="wp-person" id="wp-person-miller">
  <a href="http://profiles.wordpress.org/p51labs/">
    <img src="http://0.gravatar.com/avatar/ed33891ef54d14d71cee542af5c64aa3?s=60" style="padding:0 5px 5px 0;" class="gravatar" alt="Kevin Miller" />
  </a>
  <a class="web" href="http://profiles.wordpress.org/p51labs/">Kevin Miller</a>
  <span class="title">Lead Developer</span>
</li>

<li class="wp-person" id="wp-person-bruner">
  <a href="http://profiles.wordpress.org/sbruner">
    <img src="http://www.gravatar.com/avatar/909371185bf3c3cd783b9580f394bd7f?s=60" class="gravatar" alt="Steve Bruner" />
    </a>
  <a class="web" href="http://profiles.wordpress.org/sbruner">Steve Bruner</a>
  <span class="title">Lead Developer</span>
</li>

</ul>

<h4 class="wp-people-group">Contributing Developers</h4>

<ul class="wp-people-group " id="wp-people-group-project-leaders">

  <li class="wp-person" id="wp-person-menard">
    <img src="http://1.gravatar.com/avatar/7b199884c1b4530d05aca31db88b19f6?s=60" class="gravatar" alt="Marcus Eby" />
    <span>Marcus Eby</span>
  </li>

  <li class="wp-person" id="wp-person-menard">
    <img src="http://1.gravatar.com/avatar/fa3dfd09d81f6c8b3494c2f75ef4139d?s=60" class="gravatar" alt="Daniel Ménard" />
    <span>Daniel Ménard</span>
  </li>

</ul>



<hr>

<p class="about-description">
  Follow Piklist
</p>


<div class="piklist-social-links">
  <a class="facebook_link" href="http://facebook.com/piklist">
    <span class="dashicons dashicons-facebook-alt"></span>
  </a>
  <a class="twitter_link" href="http://twitter.com/piklist">
    <span class="dashicons dashicons-twitter"></span>
  </a>
  <a class="google_plus_link" href="https://plus.google.com/u/0/b/108403125978548990804/108403125978548990804/posts">
    <span class="dashicons dashicons-googleplus"></span>         
  </a>
</div><!-- .piklist-social-links -->

</div>

  <script type="text/javascript">
  var addthis_share = {
      url_transforms : {
          shorten: {
               twitter: 'bitly'
          }
      }, 
      shorteners : {
          bitly : {}
      }
  }
  var addthis_config = {"data_track_addressbar":false};</script>
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fc6697407a3afe4"></script>
  <!-- AddThis Button END -->
