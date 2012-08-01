=== PIKLIST | Rapid Development Framework ===
Contributors: piklist
Tags: framework, cms, custom post types, post type, custom taxonomies, taxonomy, custom comment type, comments, settings, widgets
Tested up to: 3.4
Requires at least: 3.3.2
Stable tag: 0.5.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Rapid Development Framework for WordPress.

== Description ==

**CURRENTLY IN BETA**

Piklist is the developers best friend. A rapid development framework for WordPress that will let you concentrate on the main focus of your plugin or theme, and let Piklist handle everything else.

**Piklist makes it easy to:**

*   Build Fields for Settings page, Widgets and Custom Post Types with minimal code (Custom Taxonomies and User Profiles coming soon.)
*   Conditionally show fields (or their values), based on Post Status and/or User Role.
*   Define Custom Post Statuses
*   Relate Post-to-Posts.
*   <a href="http://piklist.com">and more...</a>

**COMING SOON**

*   Drag-and-drop Field and Form builder.
*   Out-of-the-box applications: Contact Manager, Order Management, etc.

**LEARN MORE**

*   <a href="http://piklist.com/user-guide/">Piklist User Guide</a>


**Better Custom Post Types**

*   Powerful Custom Post Types 
*   Relate Custom Post Types to each other. 
*   Add your own post statuses. 

**Codeless Meta Boxes**

*   Group fields in a meta box, by placing them all in one file.
*   Add a comment block at the top of your file to define the meta box attributes 
*   Hide/Show based on the post status. 
*   Hide/Show based on the users capability. 
*   Sort meta boxes with granular control. 
*   Lock the box, so users cannot move or hide them. 

**Simple, Groupable Widgets**

*   Group widgets into one widget to save space, and make finding them easier 
*   Create one file for your Widget settings, and one for your output... all done!
*   Use any Piklist field type in your widget settings page.

**Powerful Fields**

*   Backend, Frontend, Widgets... it all works the same.

**Lots of field types (and more coming soon!):**

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


**Choose a content type for your field (You can even mix-n-match on one form)**

*   post
*   post_meta
*   comment
*   comment_meta
*   taxonomy
*   taxonomy_meta
*   user
*   user_meta

**Mix Field and Content types (i.e. Taxonomies as radio buttons)**

*   Hide/Show based on another form field. 
*   Hide/Show based on the post status.
*   Hide/Show based on the users capability.
*   Hide form fields, and just show field values

== Installation ==

*   Install and activate Piklist like any other plugin.
*   DEVELOPERS: <a href="http://piklist.com">Learn how to develop</a> Piklist Powered Themes and Plugins.

== Changelog ==

0.5.8
= Advanced Search capabilities function

= 0.5.7 =
* Publish box set to Priority:Core, so meta boxes can be added before it.

= 0.5.6 =
* Forced Publish Meta Box to always be at top right
* Fixed all PHP Notice issues
* Added rule to flush permalinks when registering a new post type if needed
* Fixed default post title fallback
* Added has_archive to register_custom_post_types function
* Fixed Taxonomy scope bug on show value.
* Fixed bug with Post-to-Post relationships.

= 0.5.5 =
* Fixed Child theme support
* Fixed bug with frontend forms

= 0.5.4 =
* Fixed Meta Box Sort for non-ordered meta boxes
* Added support to register a plugin with Piklist by using the Plugin Type comment
* Updated Theme Path
* Updated fields so that post_meta is the default scope for meta-boxes

= 0.5.3 =
* Updated Meta Boxes to respect new theme folder structure
* Updated global meta boxes to work on default post types

= 0.5.2 =
* Fixed Conditional Tag for Style Loading
* Fixed Add-On Registration

= 0.5.1 =
* Updated Status Ranges
* Fixed Directory Parse Bug

= 0.5.0 =
* Initial release!