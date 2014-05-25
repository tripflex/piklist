# Piklist

## Rapid development framework
* Contributors: piklist, p51labs, sbruner
* Tags: piklist, framework, cms, custom post types, post type, custom taxonomies, taxonomy, custom comment type, comments, settings, widgets
* Tested up to: 3.9
* Requires at least: 3.6
* Stable tag: 0.9.3.3
* Donate link: http://piklist.com/get-involved/
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

A rapid development framework for WordPress.

***

**Automatic update from SVN is currently having issues, i'll try and fix it ASAP, but until then you can always get a copy from the WP Plugins clone:**
https://github.com/wp-plugins/piklist

### Description

**CURRENTLY IN BETA**

Piklist is the developers best friend. A rapid development framework for WordPress that will let you concentrate on the main focus of your plugin or theme, and let Piklist handle everything else.

[Watch the Piklist presentation from WordCamp NYC >](http://wordpress.tv/2012/09/04/steve-bruner-and-kevin-miller-building-powerful-websites-and-web-applications-with-piklist/):

### Piklist makes it easy to:
*   Build Fields for Settings page, Widgets, Custom Post Types, Custom Taxonomies and User Profiles with minimal code.
*   Conditionally show fields (or their values), based on Post Status and/or User Role.
*   Define Custom Post Statuses
*   Relate Post-to-Posts.
*   <a href="http://piklist.com">and more...</a>


### LEARN MORE
*   <a href="http://piklist.com/user-guide/">Piklist User Guide</a>


### Better Custom Post Types
*   Powerful Custom Post Types 
*   Relate Custom Post Types to each other. 
*   Add your own post statuses. 

### Codeless Meta Boxes
*   Group fields in a meta box, by placing them all in one file.
*   Add a comment block at the top of your file to define the meta box attributes 
*   Hide/Show based on the post status. 
*   Hide/Show based on the users capability. 
*   Sort meta boxes with granular control. 
*   Lock the box, so users cannot move or hide them.
*   Add meta box to a specific Page/Post ID.

### Simple, Groupable Widgets
*   Group widgets into one widget to save space, and make finding them easier 
*   Create one file for your Widget settings, and one for your output... all done!
*   Use any Piklist field type in your widget settings page.

### Powerful Fields
*   Backend, Frontend, Widgets... it all works the same.

### Lots of field types (and more coming soon!):
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

### Choose a content type for your field (You can even mix-n-match on one form)
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

### Mix Field and Content types (i.e. Taxonomies as radio buttons)
*   Hide/Show based on another form field. 
*   Hide/Show based on the post status.
*   Hide/Show based on the users capability.
*   Hide form fields, and just show field values

### Translators
* French (fr) - Daniel Ménard
* Slovak (sk) - Branco

## Installation

*   Install and activate Piklist like any other plugin.
*   DEVELOPERS: <a href="http://piklist.com">Learn how to develop</a> Piklist Powered Themes and Plugins.

## Changelog

### 0.9.3.3
* FIXED: Update to class-piklist-user

### 0.9.3.2
* FIXED: User registrations emails no longer conflict with other plugins (i.e. BuddyPress)
* FIXED: check_update function respects new plugins.
* FIXED: notice from post_row_actions function.

### 0.9.3.1
* FIXED: Addmore field bug fix.

### 0.9.3
* FIXED: Checkboxes save properly.

### 0.9.2
* NEW: Multiselect field.
* NEW DEMO: Post Editor in an Add-more.
* IMPROVED: Add-mores are better than ever.
* FIXED: Dashboard widgets drag-and-drop properly.
* FIXED: Fixed Notices.

### 0.9.1
* FIXED: Add-mores can now contain empty values.
* FIXED: body_class function works better with Jetpack.

### 0.9.0
* NEW: Add Tooltip Help to any Piklist field.
* NEW: post_states parameter.
* NEW: Set page icon on Taxonomy and User Taxonomy pages.
* NEW: Dashicons now included.
* NEW: Piklist grid css.
* IMPROVED: Comma-seperated list of Taxonomies can be passed in a term file.
* IMPROVED: Comma-separated lists of Post Types or Taxonomies in meta-boxes or term files can contain spaces.
* IMPROVED: Use $page_icon instead of $icon.
* IMPROVED: Use $menu_icon instead of $icon_url.
* FIXED: Editing text boxes for Add-mores work in Firefox.
* FIXED: Dashboard widget layout saves properly.
* FIXED: $attributes in Editor field should be $options.
* FIXED: Custom Post Statuses retain order when used with multiple CPTs.

### 0.8.0b6
* IMPROVED: Multiple Author Roles are turned off by default.
* IMPROVED: Add-mores are now even more awesome.
* FIXED: Checkboxes.
* FIXED: Tab Spacing.
* FIXED: User Taxonomy data saves properly.
* FIXED: WorkFlow tabs save properly for Post Types.
* FIXED: Widgets work better than ever.
* FIXED: Lots of bugs squashed!

### 0.8.0b5
* NEW: Comment Field.
* IMPROVED: Assets for Javascript fields only load when the field is in use.
* FIXED: Windows Path Error.
* FIXED: Image upload for Widgets.

### 0.8.0b4
* NEW: Replace standard Right Now widget on WordPress dashboard.
* FIXED: REALLY fixed the Javascript error that broke visual editor and Help Tabs.
* FIXED: Widgets

### 0.8.0b3
* FIXED: Javascript error that broke visual editor and Help Tabs.

### 0.8.0b2
* NEW: Upload File field!
* Bug Fixes

### 0.8.0b1
* Now requires WordPress 3.4+.
* NEW: Infinite Add-Mores!
* NEW: Relationship field!
* NEW: Multiple User Roles!
* NEW: User Taxonomies!
* NEW: Work Flow!
* NEW: Help Tabs!
* NEW: Dashboard Widgets!
* NEW: Required option for fields!
* New: Remove Meta Box around custom fields!
* NEW: Show meta fields by Page Template. Props @James_Mc.
* NEW: hide_screen_options parameter when registering Post Types.
* NEW: admin_body_class parameter when registering Post Types.
* NEW: Remove Save functionality for settings page.
* NEW: Change Save button text.
* NEW: French translation by Daniel Ménard.
* NEW: Slovak translation by Branco.
* IMPROVED: Extended admin_body_class for Post Types and Taxonomies.
* IMPROVED: Better display for settings page for both Tabs/no Tabs, and single line.
* IMPROVED: Add or auto generate Form ID.
* IMPROVED: Stops Webkit browsers from auto-filling user fields in the admin.
* IMPROVED: More localized strings. Props @Daniel Ménard.
* FIXED: HTTPS works properly.
* FIXED: Comment field no longer duplicates comments.
* FIXED: Administrators can edit other users meta.
* FIXED: HTML escaped neccessary fields.
* FIXED: Better garbage collection.
* FIXED: CSS for h2.nav-tab-wrapper.

### 0.7.2
* NEW: Plugin updates...the Piklist way.
* FIXED: Long Post Status lists now wrap nicely.

### 0.7.1
* FIXED: Add-mores save correctly when adding/deleting rows.
* FIXED: Media meta saves without errors.
* FIXED: Settings save properly when using multiple tabs.
* FIXED: Logged-in user can now save user meta for any user.
* FIXED: Fixed typo in process_form function in class-piklist-taxonomy. Props @James_Mc
* FIXED: Empty Time and Date fields no longer return "false".

### 0.7.0
* NEW: Disable Piklist Deactivation.
* NEW: Customize the "Enter Title Here" text in Post Type Titles.
* FIXED: Error when saving Media meta. Props @James_Mc
* FIXED: Removed legacy less_styles() function.
* FIXED: Added Text Domain to all localized strings.

### 0.6.9
* FIXED: Metaboxes jQuery conflict fixed for Firefox.

### 0.6.8
* IMPROVED: Better upgrade notice in admin.
* IMPROVED: Nicer jQuery animation for certain fields.
* IMPROVED: Update uninstall.php to remove Piklist tables.
* FIXED: Conditionals now working.

### 0.6.7
* Our most significant update since the initial release:
* NEW: Add Taxonomy Meta!
* NEW: Add User Meta!
* NEW: Add Media Meta!
* NEW: New super powers for tax_query and meta_query!
* NEW: Add meta box to a specific Page/Post ID. Props @kattagami and @James_Mc
* FIXED: Network Activated plugins did not work properly.
* FIXED: In function post_type_labels, view_item should be singularize. Props @James_Mc
* FIXED: Allow creating of field-less meta boxes. Props @James_Mc
* FIXED: Register Taxonomies before Custom Post Types. Props @Daniel Ménard

### 0.6.6
* NEW: uninstall.php file added.
* NEW: Language folder added.
* FIXED: Stopped some installs from receiving upgrade notices.
* FIXED: Settings Tabs in submenu's didn't always work.

### 0.6.5
* IMPROVED: Taxonomy save function.
* NEW: Auto-columns for checkboxes and radio buttons.
* NEW: Asset loader supports admin.

### 0.6.4
* NEW: Save button can be removed for individual Settings pages.
* NEW: Show file uploads in Piklist Demos.
* FIXED: Publish box fixes.
* FIXED: Taxonomy save/edit.
* FIXED: 3.3.2 support.

### 0.6.3
* NEW: New field! Upload files.
* NEW: Added new Piklist XML class.
* NEW: Updated Piklist get_terms function.
* NEW: Removed ability to run any shortcode in a widget. Moved to WordPress-Helpers plugin.
* FIXED: notice issues.

### 0.6.2
* FIXED: Publish box wasn't always publishing.
* FIXED: Fixed settings issues with multisite.
* FIXED: Grouped fields were not laying out properly.

### 0.6.1
* FIXED: Group fields stying

### 0.6.0
* NEW: Field names and ID's are now prefixed on frontend.
* FIXED: Published posts revert to draft on save.
* FIXED: Tabbed Settings page were not saving.

### 0.5.9
* NEW: Allow multiple nested fields.
* NEW: Implemented GET Field value function.
* FIXED: add-more fields.
* FIXED: Conditonal fields.
* FIXED: Auto update fields.
* FIXED: issue with plugin folders alphabetically higher than "piklist".
* FIXED: path issue on Windows server.

### 0.5.8
* NEW: Implemented GET Field value function.Advanced Search capabilities function.

### 0.5.7
* FIXED: Publish box set to Priority:Core, so meta boxes can be added before it.

### 0.5.6
* IMPROVED: Forced Publish Meta Box to always be at top right.
* IMPROVED: Added has_archive to register_custom_post_types function.
* FIXED: PHP Notice issues.
* FIXED: Added rule to flush permalinks when registering a new post type if needed.
* FIXED: default post title fallback.
* FIXED: Taxonomy scope bug on show value.
* FIXED: bug with Post-to-Post relationships.

### 0.5.5
* FIXED: Child theme support.
* FIXED: bug with frontend forms.

### 0.5.4
* NEW: Added support to register a plugin with Piklist by using the Plugin Type comment.
* IMPROVED: Updated fields so that post_meta is the default scope for meta-boxes.
* FIXED: Meta Box Sort for non-ordered meta boxes.
* FIXED: Updated Theme Path.

### 0.5.3
* IMPROVED: Meta Boxes now respect new theme folder structure.
* IMPROVED: Global meta boxes now work on default post types.

### 0.5.2
* FIXED: Conditional Tag for Style Loading.
* FIXED: Add-On Registration.

### 0.5.1
* IMPROVED: Updated Status Ranges.
* FIXED: Directory Parse Bug.

### 0.5.0
* Initial release!


## Upgrade Notice=

### 0.6.7
* Major upgrade. Looks of awesome new features.

### 0.6.4
* Fixes major issue with Publish box. Please upgrade.

## Screenshots

1. Post relationships: You'll wish all relationships were this easy.
2. Add-mores: The infinite repeater field.
3. WorkFlows: The tab system you never knew was possible.
4. Multiple user roles: Better security, more flexibility.
