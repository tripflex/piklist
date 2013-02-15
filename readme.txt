=== PIKLIST | Rapid Development Framework ===
Contributors: piklist, p51labs, sbruner
Tags: piklist, framework, cms, custom post types, post type, custom taxonomies, taxonomy, custom comment type, comments, settings, widgets
Tested up to: 3.5
Requires at least: 3.3.2
Stable tag: 0.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Rapid Development Framework for WordPress.

== Description ==

**CURRENTLY IN BETA**

Piklist is the developers best friend. A rapid development framework for WordPress that will let you concentrate on the main focus of your plugin or theme, and let Piklist handle everything else.

[Watch the Piklist presentation from WordCamp NYC >](http://wordpress.tv/2012/09/04/steve-bruner-and-kevin-miller-building-powerful-websites-and-web-applications-with-piklist/):

= Piklist makes it easy to: =
*   Build Fields for Settings page, Widgets, Custom Post Types, Custom Taxonomies and User Profiles with minimal code.
*   Conditionally show fields (or their values), based on Post Status and/or User Role.
*   Define Custom Post Statuses
*   <a href="http://piklist.com">and more...</a>

= COMING SOON =
*   Drag-and-drop Field and Form builder.
*   Out-of-the-box applications: Contact Manager, Order Management, etc.

= LEARN MORE =
*   <a href="http://piklist.com/user-guide/">Piklist User Guide</a>

= Better Custom Post Types =
*   Powerful Custom Post Types 
*   Relate Custom Post Types to each other. 
*   Add your own post statuses. 

= Codeless Meta Boxes =
*   Group fields in a meta box, by placing them all in one file.
*   Add a comment block at the top of your file to define the meta box attributes 
*   Hide/Show based on the post status. 
*   Hide/Show based on the users capability. 
*   Sort meta boxes with granular control. 
*   Lock the box, so users cannot move or hide them.
*   Add meta box to a specific Page/Post ID.

= Simple, Groupable Widgets =
*   Group widgets into one widget to save space, and make finding them easier 
*   Create one file for your Widget settings, and one for your output... all done!
*   Use any Piklist field type in your widget settings page.

= Powerful Fields =
*   Backend, Frontend, Widgets... it all works the same.

= Lots of field types (and more coming soon!): =
*   text
*   textarea
*   checkbox
*   radio
*   select
*   post editor
*   hidden
*   html
*   date chooser 
*   color picker
*   add more

= Choose a content type for your field (You can even mix-n-match on one form) =
*   post
*   post_meta
*   comment
*   comment_meta
*   term
*   term_meta
*   user
*   user_meta
*   media
*   media_meta

= Mix Field and Content types (i.e. Taxonomies as radio buttons) =
*   Hide/Show based on another form field. 
*   Hide/Show based on the post status.
*   Hide/Show based on the users capability.
*   Hide form fields, and just show field values

== Installation ==

*   Install and activate Piklist like any other plugin.
*   DEVELOPERS: <a href="http://piklist.com">Learn how to develop</a> Piklist Powered Themes and Plugins.

== Changelog ==

= 0.7.2 =
* NEW: Plugin updates...the Piklist way.
* FIXED: Long Post Status lists now wrap nicely.

= 0.7.1 =
* FIXED: Add-mores save correctly when adding/deleting rows.
* FIXED: Media meta saves without errors.
* FIXED: Settings save properly when using multiple tabs.
* FIXED: Logged-in user can now save user meta for any user.
* FIXED: Fixed typo in process_form function in class-piklist-taxonomy. Props @James_Mc
* FIXED: Empty Time and Date fields no longer return "false".

= 0.7.0 =
* NEW FEATURE: Disable Piklist Deactivation.
* NEW FEATURE: Customize the "Enter Title Here" text in Post Type Titles.
* FIXED: Error when saving Media meta. Props @James_Mc
* FIXED: Removed legacy less_styles() function.
* FIXED: Added Text Domain to all localized strings.

= 0.6.9 =
* Bugfix: Metaboxes jQuery conflict fixed for Firefox.

= 0.6.8 =
* Better upgrade notice in admin.
* Nicer jQuery animation for certain fields.
* Update uninstall.php to remove Piklist tables.
* Bugfix: Conditionals now working.

= 0.6.7 =
* Our most significant update since the initial release:
* Add Taxonomy Meta!
* Add User Meta!
* Add Media Meta!
* New super powers for tax_query and meta_query!
* Add meta box to a specific Page/Post ID. Props @kattagami and @James_Mc
* Bugfix: Network Activated plugins did not work properly.
* Bugfix: In function post_type_labels, view_item should be singularize. Props @James_Mc
* Bugfix: Allow creating of field-less meta boxes. Props @James_Mc
* Bugfix: Register Taxonomies before Custom Post Types. Props @Daniel Ménard

= 0.6.6 =
* uninstall.php file added.
* Language folder added.
* Bugfix: Stopped some installs from receiving upgrade notices.
* Bugfix: Settings Tabs in submenu's didn't always work.

= 0.6.5 =
* Taxonomy save function update.
* Auto-columns for checkboxes and radio buttons.
* Asset loader supports admin.

= 0.6.4 =
* Save button can be removed for individual Settings pages.
* Show file uploads in Piklist Demos.
* Bugfix: Publish box fixes.
* Bugfix: Taxonomy save/edit.
* Bugfix: 3.3.2 support.

= 0.6.3 =
* New field! Upload files.
* Added new Piklist XML class.
* Updated Piklist get_terms function.
* Removed ability to run any shortcode in a widget. Moved to WordPress-Helpers plugin.
* Many notices have been fixed.

= 0.6.2 =
* Bugfix: Publish box wasn't always publishing.
* Bugfix: Fixed settings issues with multisite.
* Bugfix: Grouped fields were not laying out properly.

= 0.6.1 =
* Bugfix: Group fields stying

= 0.6.0 =
* Bugfix: Published posts revert to draft on save.
* Bugfix: Tabbed Settings page were not saving.
* Field names and ID's are now prefixed on frontend.

= 0.5.9 =
* Allow multiple nested fields.
* Bugfix: add-more fields.
* Bugfix: Conditonal fields.
* Bugfix: Auto update fields.
* Bugfix: issue with plugin folders alphabetically higher than "piklist".
* Implemented GET Field value function.
* Bugfix: path issue on Windows server.

= 0.5.8 =
* Advanced Search capabilities function.

= 0.5.7 =
* Publish box set to Priority:Core, so meta boxes can be added before it.

= 0.5.6 =
* Forced Publish Meta Box to always be at top right.
* Fixed all PHP Notice issues.
* Added rule to flush permalinks when registering a new post type if needed.
* Fixed default post title fallback.
* Added has_archive to register_custom_post_types function.
* Fixed Taxonomy scope bug on show value.
* Fixed bug with Post-to-Post relationships.

= 0.5.5 =
* Fixed Child theme support.
* Fixed bug with frontend forms.

= 0.5.4 =
* Fixed Meta Box Sort for non-ordered meta boxes.
* Added support to register a plugin with Piklist by using the Plugin Type comment.
* Updated Theme Path.
* Updated fields so that post_meta is the default scope for meta-boxes.

= 0.5.3 =
* Updated Meta Boxes to respect new theme folder structure.
* Updated global meta boxes to work on default post types.

= 0.5.2 =
* Fixed Conditional Tag for Style Loading.
* Fixed Add-On Registration.

= 0.5.1 =
* Updated Status Ranges.
* Fixed Directory Parse Bug.

= 0.5.0 =
* Initial release!


== Upgrade Notice ==

= 0.6.7 =
* Major upgrade. Looks of awesome new features.

= 0.6.4 =
* Fixes major issue with Publish box. Please upgrade.