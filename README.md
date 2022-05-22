# Todo

-   generate theme info in style.css
-   custom image sizes

## Features

-   disable comments

## Installation

Clone into your themes, change the folder name to your template.

1. Search and replace the following:

-   `'thomas-theme'` (with single quotes) => `'your-theme-name'`
-   `thomas_theme_` => `your_theme_name_`
-   `thomas_theme` => `your_theme_name`
-   `Text Domain: _s` (in style.css) => `Text Domain: your-theme-name`
-   ` thomas_theme` (with a space) => ` Your_Theme_Name`
-   `thomas_theme-` => `your-theme-name-`
-   `THOMAS_THEME_` => `YOUR_THEME_NAME_`

2. Rename `thomas-theme.pot` from `languages` folder to use the theme's slug.

3. Run `npm i` and `composer install`.

4. Install following plugins:

-   Disable comments
-   ACF Pro
-   WPML ?

### Available CLI commands

-   `composer make-pot` : generates a .pot file in the `languages/` directory.
-   `npm run compile:css` : compiles SASS files to css.
-   `npm run watch` : watches all SASS files and recompiles them to css when they change.
-   `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.

## Credits

-   Based on Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
