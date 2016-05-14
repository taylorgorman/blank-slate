# Blank Slate #

#### What's in the box ####

- Blank Slate **plugin** configures WordPress to be better universally.
- This Website **plugin** configures WordPress for this site. Settings go here so the site doesn't fall apart if the theme changes. Also needs a cleverer name.
- Blank Slate **theme** is a starting point for development. Rename it and go forth.

## Filters ##

`apply_filters( 'bs_add_user_fields', array $fields )`  
**Source file:** plugins/blank-slate/admin/users.php

$fields : Array of strings of field names. Inspect the inputs in the admin to get the names.

`apply_filters( 'bs_remove_user_fields', array $fields )`  
**Source file:** plugins/blank-slate/admin/users.php

$fields : Array keys are field names. Array values are fields' labels.

`apply_filters( 'bs_description', string $description’ )`  
**Source file:** [plugins/blank-slate/functions/meta.php](plugins/blank-slate/functions/meta.php)

## File Tour ##

#### plugins/blank-slate/admin/users.php ####

- Filter `manage_users_columns` remove posts column from user list screen.
- Filter `user_contactmethods` add and remove fields on user edit screen.

#### plugins/blank-slate/functions/meta.php ####

- Filter `wp_title` add blog name, description, page number.
- Function `bs_description` intended for description meta tag. Apply filter `bs_description`.

## To Do List ##

#### Blank Slate plugin ####

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

#### Blank Slate theme ####

- Enhance toggle-class.js to work with form elements
