# Blank Slate #

#### What's in the box ####

- Blank Slate **plugin** configures WordPress to be better universally.
- This Website **plugin** configures WordPress for this site. Settings go here so the site doesn't fall apart if the theme changes. Also needs a cleverer name.
- Blank Slate **theme** is a starting point for development. Rename it and go forth.

## Functions ##

`bs_list_contextually( string|array $args )`  
**Source file:** [plugins/blank-slate/functions/bs_list_contextually.php](plugins/blank-slate/functions/bs_list_contextually.php)

`$args` *(string|array) (Optional)*

---

`bs_nav_menu( string $menu_name, string|array $args )`  
**Source file:** [plugins/blank-slate/functions/bs_nav_menu.php](plugins/blank-slate/functions/bs_nav_menu.php)

`$menu_name` *(string) (Required)*
`$args` *(string|array) (Optional)*

---

`lia2a(  )`  
**Source file:** [plugins/blank-slate/functions/bs_nav_menu.php](plugins/blank-slate/functions/bs_nav_menu.php)

---

`bs_svg_sprite(  )`  
**Source file:** [plugins/blank-slate/functions/bs_svg_sprite.php](plugins/blank-slate/functions/bs_svg_sprite.php)

---

`bs_description(  )`  
**Source file:** [plugins/blank-slate/theme/meta.php](plugins/blank-slate/theme/meta.php)

## Filters ##

`apply_filters( 'bs_add_user_fields', array $fields )`  
**Source file:** [plugins/blank-slate/admin/users.php](plugins/blank-slate/admin/users.php)

`$fields` *(array)* : Keys are field names. Values are fields' labels.

---

`apply_filters( 'bs_remove_user_fields', array $fields )`  
**Source file:** [plugins/blank-slate/admin/users.php](plugins/blank-slate/admin/users.php)

`$fields` *(array)* : No keys. Values are field names. Inspect the inputs in the admin to get the names.

---

`apply_filters( 'bs_description', string $description’ )`  
**Source file:** [plugins/blank-slate/functions/meta.php](plugins/blank-slate/functions/meta.php)

## Files ##

*Files listed in the order they're `require_once`'d.*

#### [plugins/blank-slate/functions/bs_list_contextually.php](plugins/blank-slate/functions/bs_list_contextually.php) ####

- Function `bs_list_contextually` gets list items based on context. Acts like, and uses, `wp_list_pages` and `wp_list_categories`.

#### [plugins/blank-slate/functions/bs_nav_menu.php](plugins/blank-slate/functions/bs_nav_menu.php) ####

- Function `bs_nav_menu` calls `wp_nav_menu` with convenient defaults. Also strips `<ul>` and `<li>` tags.
- Function `lia2a` removes `<li>` tags, moving attributes to child `<a>`. Used by `bs_nav_menu`.

#### [plugins/blank-slate/functions/bs_svg_sprite.php](plugins/blank-slate/functions/bs_svg_sprite.php) ####

- Function `bs_svg_sprite` generates HTML for SVG sprite with use tag.

#### [plugins/blank-slate/admin/users.php](plugins/blank-slate/admin/users.php) ####

- Filter `manage_users_columns` to remove posts column from user list screen.
- Filter `user_contactmethods` to add and remove fields on user edit screen.

#### [plugins/blank-slate/widgets/section-navigation.php](plugins/blank-slate/widgets/section-navigation.php) ####

- Widget Section Navigation makes list with `bs_list_contextually`.

#### [plugins/blank-slate/theme/meta.php](plugins/blank-slate/theme/meta.php) ####

- Filter `wp_title` to add blog name, description, page number.
- Function `bs_description` intended for description meta tag. Apply filter `bs_description`.

## To Do List ##

##### plugins/blank-slate #####

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

##### themes/blank-slate #####

- Enhance toggle-class.js to work with form elements
- Add parts/face.php
- Remove header-int.php and footer-int.php
- Cornerstone settings file. Goal would be to never touch Cornerstone. So could udpate it anywhere without losing site-specific settings. Would require a lot of if(!isset()).
