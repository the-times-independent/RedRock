=== RedRock ===

Contributors: automattic
Requires at least: 4.5
Tested up to: 4.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A theme called RedRock.

== Description ==

RedRock is a simple, modern theme for photographers, artists, and graphic designers looking to showcase their work. It comes with some interesting features:

* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* Custom header options including site logo and custom header.
* Support for Portfolio Posts or 'Projects' which can be used to present imagery in a more dynamic way than what you see with regular Posts
* Licensed under GPLv2 or later. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2017 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* columnist.js https://github.com/weblinc/jquery-columnlist, (C) 2012-2017 WebLinc LLC, [MIT](http://opensource.org/licenses/MIT)
* Font Awesome http://fontawesome.io, (C) 2012-2017 Dave Gandy, [SIL OFL 1.1](http://scripts.sil.org/OFL), [MIT](http://opensource.org/licenses/MIT)
* Images: licensed under [CC0](http://creativecommons.org/choose/zero/)
** https://www.flickr.com/photos/usgeologicalsurvey/16656107187/
** https://pixabay.com/en/rocket-spaceship-space-shuttle-79394/
** https://pixabay.com/en/space-shuttle-landing-600463/
** https://unsplash.com/photos/OVO8nK-7Rfs
** https://unsplash.com/photos/8qYThFAxsCs
** https://unsplash.com/photos/8Hjx3GNZYeA

== Changelog ==

= 3 March 2018 =
* Use wp_kses_post rather than wp_filter_post_kses.

= 23 February 2018 =
* Simplify Headstart annotations.

= 20 February 2018 =
* Fix a conflict with JetPack lazy loading and imagesLoaded feature in Masonry

= 12 February 2018 =
* Fix issue with Instagram widget showing very small images.

= 9 November 2017 =
* Add space between columns in gallery.

= 25 August 2017 =
* Update version number; include correct URL and credit reference in the footer.

= 24 August 2017 =
* Don't filter the More link text; this allows it to fall back to the consistent read more text, "Continue reading", and allows for users to customize the Read More text as they
* Center images and captions rather than offsetting centered image captions and images to the left. This was particularly odd behavior when the image size was smaller than the full width of the content column.
* Ensure floated columns display correctly for RTL languages.

= 23 August 2017 =
* Specify the registered sidebar ID rather than the sidebar's CSS ID in the infinite scroll setup footer_widgets parameter. This detects whether widgets are present and disables infinite scroll automatically so any content in the widgets is accessible.

= 22 August 2017 =
* Remove erroneous arrow on Older Posts button in RTL mode.

= 3 August 2017 =
* Rename widget area to reduce confusion

= 3 July 2017 =
* Fixed an issue whee it was not possible to turn on infinite scroll

= 29 June 2017 =
* Multiple changes:

= 14 June 2017 =
* Add behance.net support for social menu. Closes #4567

= 26 May 2017 =
* Add support for Content Options - Featured Images - Portfolio CPT

= 5 May 2017 =
* Check for post parent object before outputting post parent information to prevent fatals.

= 20 April 2017 =
* Add support for Smarter Featured Images.

= 14 April 2017 =
* Update post thumbnail size to better reflect the desired cropping behavior.

= 13 April 2017 =
* Check for post parent before outputting next, previous, and image attachment information to prevent fatals.

= 22 March 2017 =
* add Custom Colors annotations directly to the theme
* move fonts annotations directly into the theme

= 9 February 2017 =
* Check for is_wp_error() in cases when using get_the_tag_list() to avoid potential fatal errors.

= 24 January 2017 =
* Making sure site description also hides when 'Display Site Title and Tagline' is unchecked.

= 18 January 2017 =
* Add translation of Headstart annotation

= 17 January 2017 =
* Add new grid-layout tag to stylesheet.
* Add portfolio tag to style.css since theme is supporting Portfolio CPT.
* Update FontAwesome version to 4.7.0.

= 5 January 2017 =
* Refactor suggested changes from .org submission review.

= 28 November 2016 =
* Added Image credits
* Update readme

= 24 November 2016 =
* Add support for Content Options - Featured Images

= 25 October 2016 =
* Fix typo in Headstart annotation.

= 9 September 2016 =
* Add support for Content Options - Post Details Author

= 6 September 2016 =
* Add support for Blog Display (including Masonry fix)

= 26 August 2016 =
* Add Featured Content to Headstart annotations.

= 8 August 2016 =
* Update attachment URLs to smaller images.

= 27 July 2016 =
* Remove Content Options's blog display support: issue with customizer and post loading

= 21 July 2016 =
* Add support for Content Options -- Author Bio will need more work (issue with the avatar on larger screens)

= 7 July 2016 =
* Fix typo in text domain

= 6 July 2016 =
* Update Headstart post titles to ensure they're excluded from notifications.

= 22 June 2016 =
* Remove unsupported project posts from Headstart annotation. The featured images are giving errors.
* Update Headstart featured image URL.
* Update image URL for Headstart.

= 9 June 2016 =
* Update portfolio navigation
* Add Portfolio CPT new feature

= 3 June 2016 =
* Updating screenshot to make sure it shows the grid (see GH wp-calypso, issue #5767).

= 1 June 2016 =
* Add `imagesLoaded` function on `post-load` event too.
* Fixes an issue where infinite scroll didn't work with Masonry.

= 27 May 2016 =
* fix the behavior of `*_the_attached_image()` for PHP 7 compat

= 26 May 2016 =
* Cleaning up an issue where projects are accounting for borders that arent there and get moved too far up
* Cleans up sub header styling and removes unnecessary border on single posts when no menu or description exists

= 25 May 2016 =
* Adding site description to headstart annotations
* Adding headstart annotations

= 19 May 2016 =
* Swap project tags for project types on project archives

= 17 May 2016 =
* Fixes an issue in Firefox that didn’t allow a featured project's featured image to scale responsivly

= 13 May 2016 =
* Version bump

= 11 May 2016 =
* Adds support for Core site logo with a Jetpack site logo fallback.

= 10 May 2016 =
* Updating screenshot to use a CC0 compatible image.

= 27 April 2016 =
* Changes menu location name from 'primary' to 'header' menu which provides better context

= 21 April 2016 =
* Fixes an issue where on small screens, the tagline didn’t have a margin bottom when no primary menu existed

= 20 April 2016 =
* Adding direction arrows to Older/Newer posts links when infinite scroll is disabled
* Code cleanup: removes empty line
* Adding RTL support for dropdown submenu icons
* Removes pipe separator from footer and replaces it with a line break so that it reads more clearly
* Removes unnecessary contextual theme help
* Add support for core 'custom-logo' with a fallback for jetpack 'site-logo'
* Centering the drop down close icon
* Vertically centering mobile menu dropdown icons

= 19 April 2016 =
* Re-writing dropdown menu js
* Removes unneccesary border from last list-item on mobile menus
* Fixing issue where site title overlaps with social icons in some edge cases
* Fixing infinite scroll card display issue
* Moving goodreads back to style.css since it’s a part of JetPack and not wpcom core
* Adding style to Top Rated widget
* Moving goodreads widget styles from styles.css to styles-wpcom.css
* Adding wpcom goodreads widget support
* Adding style to RSS post widgets
* Adding styling to social menu widgets
* Adding bullets to .children list items for better visual clarity
* Adding wpcom Instagram widget styles
* Adding more improvements t the wpcom flickr widget
* Fixing front page template to use .card class correctly when combined with the portfolio-page template

= 18 April 2016 =
* Adding wpcom flickr widget styles
* Adds styling tweaks to calendar widget
* Adding styling for authors widget
* Fixing padding issue with tag/category cloud widgets
* Removing admin-head-callback and admin-preview-callback and associated functions because theyre really old
* Removes unnecessary JetPack featured-content call
* Iterating on wpcom improvements
* wpcom improvements
* Consolidate single post templates
* Only show the primary menu if it exists, otherwise doesn’t show it at all
* Fixing the site-logo & site-title conditional logic so that it makes more sense
* Cleaning up image.php
* Removing unnecessary projects archive template, the default archive template handles these archive the exact same way

= 15 April 2016 =
* Cleaning up RTL styles
* Fixing Next/Previous post links on archives, search and index pages so that they match the style of buttons
* Adding the new 'featured-content-with-pages' tag

= 14 April 2016 =
* Improving code comments for customizer scripts
* Re-initialize the main navigation when it is updated in the customizer
* Rolling back previous commit changes
* Corrects 'h1' selectors to be in sync with font annotations

= 13 April 2016 =
* Featured posts now inlcude posts, pages, and portfolio projects
* Animates metadata color on hover state
* Small color annotations improvement
* Cleaning up spacing between metadata separators for better legibility
* Cleaning up next and previous separators for better legibility

= 11 April 2016 =
* Adding color annotation support for JetPack Ratings
* Adding support for JetPack Ratings
* Adding better contrast to body-text colors
* Removes the hover state changes for .cards
* Adding

= 8 April 2016 =
* Adding sub-menu top borders
* Code cleanup, optimizes submenu selectors
* Adding sub-menu bottom borders for mobile devices
* Cleaning up CSS for font better font annotation support
* Cleaning up color styles for better font annotations

= 7 April 2016 =
* Color annotations fix. Makes all link HEX colors match.
* Code cleanup.

= 18 December 2015 =
* Fix custom header default size settings
* Fix subscribe opt-in font weight for wpcom highlander comments

= 17 December 2015 =
* Add screenshot png
* Fix card title link color vs border animation inconsistency
* Add a longer delay to masory re-layout to prevent overlapping
* Make social icons more usable on mobile

= 16 December 2015 =
* Add RTL support for children .page_item* classes
* Add support for children .page_item* classes
* Fix padding bug on mobile'
* Bring back card top borders, accidentally got removed in a previous commit
* Various RTL bug
* Various RTL bug
* Bug fix for mobile card image hover states
* Cleanup code indenting
* Add Rubiks 500 font-weight to fonts, use bolder font on buttons and UI items
* Decrease bottom padding of infinite-scroll wrapper so it feels less empty there
* Remove border from last .card on mobile
* Fix border underline animation on card titles
* Use muliply symbol instead of close icon on menu toggle
* Revise sub-menus so that they flyout towards the center of the layout preventing them from getting cut off by the edge of the browser
* Mobile menu is now relatively positioned and uses a smoother animation technique
* Add some breathing room between logo and title in header on mobile devices
* Fix incorrect text domains
* Small css alphabetical sorting fix
* Remove button :focus outlines
* Revise portfolio page template and how it is used as the frontpage, remove frontpage_template filter

= 15 December 2015 =
* CSS cleanup, properties are now alphabetical, vendor pre
* Fix odd copyright line-height
* Code clean up for indents and spaces
* Responsive
* Make input form line-heights match placeholder line-height
* Revise header markup to better support social-nav position, make social icons larger
* Fix broken Google Fonts CSS url for Libre Baskerville

= 14 December 2015 =
* Change mobile menu link name, add a close instance of menu ui so users now how to close the menu
* Update Readme info
* Remove unnecessary readme.txt from languages
* Fix pagination links on archives when infinite scroll is turned off
* Code cleanup, removes inconsistent indents and spaces in various template files
* Comment edit links should be less prominent so that reply links stand out more
* Improve 404 styles and templates
* Add improved styling to recent posts and categories widgets
* Add a hash (#) in front of tags so they arent mistaken for  categories, fix next/previous project bug
* Add support for multi-level blockquotes with indentations, adds RTL support too
* Revise bypostauthor icon position and add RTL support
* Add RTL support to nav and description
* Show next/prev links at the bottom of posts with post title and add RTL support for it
* Show next/prev links at the bottom of posts
* Remove uppercase titling
* Change bypostauthor icon to write/pen icon instead of asterisk
* Image alignment need bottom-margin
* Fix hidden text issue with highlander subscribe to comments input
* Fix hidden text issue with highlander subscribe to comments input
* Add breathing room between title and meta tags on single posts
* Optimize scripts and code clean up
* Fixes menus with two-line menu items so that it doesnt get too close to the content below, plus some code cleanup
* Card border colors should be animated on hover

= 11 December 2015 =
* Darken featured image hover state to increase legibility
* Update style.css theme description and details
* Adds new H5 style
* Add more button-esque style to menu toggle, clean up menu overlay
* Slow down featured image hover animation to the speed of card overlays for consistency
* Adds color transition to card hover states so that the animation syncs with the background and link color changes

= 10 December 2015 =
* Make featured project text more legible
* Improve featured content legibility by adding a darkened hover state
* Reduce shadow intensity for featured project text to increase legibility
* Tweaks to responsive featured project
* Make featured project text more legible on large screens only
* Make featured project text more legible
* Add licensing info to columnlist.js

= 9 December 2015 =
* Fix position bug on reblogged posts
* Move reblog indicator to inside of its wrapper
* Add reblog snapshot styling
* Consolidate author meta display into a template tag to prevent repetative code
* Fix highlander comments respond form margins
* Open up spacing above mobile menu toggle
* Make menu links more usable on mobile screens
* Fix archive title display, two-line term descriptions did not float correctly
* Add a subtle border to hero image when it doesnt fit the full width of the site, makes badly formatted images fit the space more naturally
* Projects should show project-types on archives and project tags on single projects in footer-entry, feels more logical

= 8 December 2015 =
* Force site-logo-link to display inline in admin
* Clean up comment title for asides
* always add a margin bottom to the last element of the content, improve #content TOC ordering
* Clean up header image display logic
* Clean up nested comments on small screens
* Fix inline respond form position on small screens
* Add author comment styling, fix respond form position bug
* Open up archive and search page headers for better legibility
* Tweaks for JetPack related posts display
* Add style for JetPack related posts
* Better support for WP.com sharing links
* Fix entry title font size on page templates
* Move Sharing and Like content below the footer entry meta, also clean up page layout on small screens
* Separate project tags and project types on single project templates so the tags arent duplicated
* Tweak inline respond form so it's more connected to the parent comment

= 7 December 2015 =
* fixes an odd issue where meta tags couldn't be click when RTL is turned on
* RTL tweaks and improvents for sharedaddy RTL
* Adding RTL support, also removed some non-relevant css
* Optimize and simplify responsive grid styles--less code with same result
* Optimize responsive masonry css
* Optimize responsive masonry css and scripts, code clean up and removing old comments
* Improve layout of cards in archives and search results, CSS code clean up
* shorten .col-width wrapper for cleaner display on smaller screens.
* Various improvements and

= 3 December 2015 =
* Update helper and customizer instructions to be more clear
* Found and fixed another comment form padding issue
* Increase content width to 1140px which is thet max-width of the layout. Also add margin fix for 404 page content
* Clean up 404 header styles and markup, had spacing issues before
* Fix Error404 padding and margins, needs to look more like a static page instead of a post
* fix margin between logo and site title on desktop
* Improve related posts and sharedaddy styling
* Fix inline comment form display for highlander comments
* Override highlander comments form border and padding styles
* Restructure comment titles to better support wp.com comments
* Restructure comments to better support wp.com comment form
* prevent widgets from breaking natural floating
* hide wpstats for wp.com

= 2 December 2015 =
* Fix infinite loader positioning so it appears at the bottom of the list of posts
* Prevent infinite-scroll from loading on scroll because the theme has widgets in its footer
* remove unnecessary wide table fix js in favor of css solution
* Fix issue where tables with links that are too long break the layout
* Moved redrock to pub directory for wp.com sandbox testing
