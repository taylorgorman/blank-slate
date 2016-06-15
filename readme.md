# Blank Slate

### What's in the box

- Blank Slate **plugin** configures WordPress to be better universally.
- This Website **plugin** configures WordPress for this site. Settings go here so the site doesn't fall apart if the theme changes. Also needs a cleverer name.
- Blank Slate **theme** is a starting point for development. Rename it and go forth.

## Files

*Files listed in the order they're `require_once`'d.*

#### [plugins/blank-slate/structure/page.php](plugins/blank-slate/structure/page.php)

- Modifies Page post type.
- Adds excerpt.
- Removes trackbacks, comments, & author.

#### [plugins/blank-slate/structure/roles.php](plugins/blank-slate/structure/roles.php)

- Adds `edit_theme_options` capability to editor role so editors can modify widgets and menus.

#### [plugins/blank-slate/abstract/post-type.php](plugins/blank-slate/abstract/post-type.php)

- Function `bs_register_post_type` to simplify and call `register_post_type` with practical defaults.
- DEPRICATED Class `bs_post_type` to register post type and do a crap ton of other stuff.

#### [plugins/blank-slate/abstract/taxonomy.php](plugins/blank-slate/abstract/taxonomy.php)

- Function `bs_register_taxonomy` to simplify and call `register_taxonomy` with practical defaults.

#### [plugins/blank-slate/abstract/scheduled.php](plugins/blank-slate/abstract/scheduled.php)

- UNFINISHED Adds feature to turn any post type into a scheduled post type.

#### [plugins/blank-slate/functions/get_author_posts_link.php](plugins/blank-slate/functions/get_author_posts_link.php)

- Function `get_author_posts_link` does just that. This should be in WP Core.

#### [plugins/blank-slate/functions/get_post_thumbnail_url.php](plugins/blank-slate/functions/get_post_thumbnail_url.php)

- Function `get_post_thumbnail_url` does just that. Tbh, this should be in WP Core, too.

#### [plugins/blank-slate/functions/highest_ancestor.php](plugins/blank-slate/functions/highest_ancestor.php)

- Function `get_highest_ancestor`.
- Function `highest_ancestor` echoes `get_highest_ancestor`.
- Function `is_highest_ancestor`.

#### [plugins/blank-slate/functions/bs_list_contextually.php](plugins/blank-slate/functions/bs_list_contextually.php)

- Function `bs_list_contextually` is situationally aware and uses `wp_list_categories` and `wp_list_pages`.

#### [plugins/blank-slate/functions/bs_svg_sprite.php](plugins/blank-slate/functions/bs_svg_sprite.php)

- Function `bs_svg_sprite` generates HTML for SVG sprite with use tag.

#### [plugins/blank-slate/functions/bs_nav_menu.php](plugins/blank-slate/functions/bs_nav_menu.php)

- Function `bs_nav_menu` to simplify and call `wp_nav_menu` with practical defaults. Also strips `<ul>` and `<li>` tags.
- Function `lia2a` removes `<li>` tags, moving attributes to child `<a>`. Used by `bs_nav_menu`.

#### [plugins/blank-slate/functions/bs_paginate_links.php](plugins/blank-slate/functions/bs_paginate_links.php)

- Function `bs_paginate_links` to simplify and call `paginate_links` with practical defaults.

#### [plugins/blank-slate/admin/general.php](plugins/blank-slate/admin/general.php)

-

#### [plugins/blank-slate/admin/bar.php](plugins/blank-slate/admin/bar.php)

-

#### [plugins/blank-slate/admin/menu.php](plugins/blank-slate/admin/menu.php)

-

#### [plugins/blank-slate/admin/tinymce.php](plugins/blank-slate/admin/tinymce.php)

-

#### [plugins/blank-slate/admin/new-user-email.php](plugins/blank-slate/admin/new-user-email.php)

-

#### [plugins/blank-slate/admin/media.php](plugins/blank-slate/admin/media.php)

-

#### [plugins/blank-slate/admin/users.php](plugins/blank-slate/admin/users.php)

- Filters `manage_users_columns` to remove posts column from user list screen.
- Filters `user_contactmethods` to add and remove fields on user edit screen.

#### [plugins/blank-slate/admin/settings-blank-slate.php](plugins/blank-slate/admin/settings-blank-slate.php)

-

#### [plugins/blank-slate/admin/settings-contact.php](plugins/blank-slate/admin/settings-contact.php)

-

#### [plugins/blank-slate/admin/featured-icon.php](plugins/blank-slate/admin/featured-icon.php)

-

#### [plugins/blank-slate/dashboard/general.php](plugins/blank-slate/dashboard/general.php)

-

#### [plugins/blank-slate/dashboard/dashboard-widget.php](plugins/blank-slate/dashboard/dashboard-widget.php)

-

#### [plugins/blank-slate/dashboard/right-now.php](plugins/blank-slate/dashboard/right-now.php)

-

#### [plugins/blank-slate/widgets/section-navigation.php](plugins/blank-slate/widgets/section-navigation.php)

- Widget Section Navigation makes list with `bs_list_contextually`.

#### [plugins/blank-slate/theme/meta.php](plugins/blank-slate/theme/meta.php)

- Filters `wp_title` to add blog name, description, page number.
- Function `bs_description` intended for description meta tag. Apply filter `bs_description`.

#### [plugins/blank-slate/theme/wp_head.php](plugins/blank-slate/theme/wp_head.php)

-

#### [plugins/blank-slate/theme/scripts.php](plugins/blank-slate/theme/scripts.php)

-

#### [plugins/blank-slate/theme/excerpt.php](plugins/blank-slate/theme/excerpt.php)

-

#### [plugins/blank-slate/theme/content.php](plugins/blank-slate/theme/content.php)

-

#### [plugins/blank-slate/theme/classes.php](plugins/blank-slate/theme/classes.php)

-

#### [plugins/blank-slate/theme/support.php](plugins/blank-slate/theme/support.php)

-

#### [plugins/blank-slate/theme/images.php](plugins/blank-slate/theme/images.php)

-

#### [plugins/blank-slate/theme/format-meta.php](plugins/blank-slate/theme/format-meta.php)

-

#### [plugins/blank-slate/theme/layouts.php](plugins/blank-slate/theme/layouts.php)

-

## To Do List

##### plugins/blank-slate

- Put custom fields back. Can use this if not ACF.
- Move Excerpt box above Content
- Add to Blank Slate Settings screen
    - Toggle Post Formats
    - Toggle scheduled post types
- Post Formats Meta
    - Load according to post format, then listen to post format radiobox changing to switch out without waiting for save.
    - Link: Source URL, Source Name
    - Quote: Source Name, Source Details
- Blank Slate activation
    - Delete sample comment, post, page
    - Create Home and Blog pages
    - Set front page to Home, posts page to Blog
    - Set permalinks
    - Uninstall Hello Dolly and Akismet plugins
    - Uninstall 2010-2014 themes
    - Clear tagline (general settings)
    - Change timezone to New York
    - Week starts on Sunday
    - Do not convert emoticons to graphics
    - Medium image size to 320
    - Large image size to 800
    - Do not organize uploads into folders
- Make new image sizes visible in WordPress UI
- Finish format meta box
- Reorganize files to folders that make more sense.
- Ditch all the objects?
- blank-slate / admin / contact.php / bs_get_social_urls()
- blank-slate / admin / contact.php / bs_get_share_urls()
- blank-slate / admin / contact.php / bs_share_links() Full markup, accepts printf layout
- blank-slate / theme / images.php / img_caption_shortcode - Remove altogether?
- format-meta - Add Source Name. Save all format meta as one array?
- Add Open Graph meta tags via wp_head hook
- bs_nav_menu : Add role="navigation" to <nav>
- Move admin notices above screen tabs?
- Media categories, add filter to list screen
- Scheduled post types
    - What if I want an events calendar and a conferences post type and something else, but they need to be separate with separate views, but I want them all future dated? This.
    - Admin screen to select which post types are scheduled.
    - Adds "Occurs on" date picker right below "Published on" and mimics its functionality.
    - Sorts posts by occurs on date, everywhere.
    - That's it. Location, times, and whatever else should be handled by ACF and calendar view should be handled by the theme. Maybe the plugin somehow offers a function for calendar view? But doesn't change by default.
- Add address 2 line to Settings/Contact
- Layout classes
    - Just put a class on the body.
    - Are for changing some styles.
    - Can select multiple, so checkboxes.
    - is_layout_class()
- Layout templates
    - Are like page templates, but for all post types. For drastically changing markup.
    - Select only one, so select input.
    - is_layout_template()
- Add classes to nav.section subnav that tell what it contains
    - post-type-page, tax-category, etc
- Set up Settings/Contact so add_settings_field() works on it
    - Then This Website can add to it
- Post type archive on a page. Could be shortcode? Might need to be page template so pagination will work.
- Methodology for calling template parts with shortcodes.
    - Probably using a global variable, $template['file-name']['variable'].
    - So another template file does global $template; $template['reviews']['title'] = 'Read these reviews';
    - And a shortcode does global $template; $template['reviews']['title'] = 'Reviews for this page';
    - And the template file does global $template; echo $template[__file__]['title'];
- Set layout classes in Blank Slate settings. Currently hard coded.
    - Or maybe not? Since layout classes are supposed to affect the theme. So anyone who modifies the classes will need to modify the theme files, too. So maybe make this a hook for This Website.

##### themes/blank-slate

- Enhance toggle-class.js to work with form elements
- Add parts/face.php
- Remove header-int.php and footer-int.php
- Cornerstone settings file. Goal would be to never touch Cornerstone. So could udpate it anywhere without losing site-specific settings. Would require a lot of if(!isset()).
