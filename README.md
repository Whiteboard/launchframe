
LaunchFrame
===

This is LaunchFrame, built by the dev team at Whiteboard. We've pieced together a few things from a few places, and ended up here.

We started with _s [http://underscores.me/](http://underscores.me/) - from their readme:

* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* A sample custom header implementation in `inc/custom-header.php` that can be activated by uncommenting one line in functions.php and adding the code snippet found the comments of `inc/custom-header.php` to your `header.php` template.
* Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* Some small tweaks in `inc/extras.php` that can improve your theming experience.
* Keyboard navigation for image attachment templates. The script can be found in `js/keyboard-navigation.js`. It's enqueued in `functions.php`.
* A script at `js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in `functions.php`.
* 2 sample CSS layouts in `layouts` for a sidebar on either side of your content.

We've kept most of this, but we've also included WB-Bootstrap, which is a pared down version of Twitter Bootstrap, adapted to use [Gulp.js](http://gulpjs.com/).

Getting Started
---------------

Prerequisites: You will need to have [Node](http://nodejs.org/) and [Gulp](http://gulpjs.com/) installed. Once you [install Node](http://nodejs.org/), you can then run `npm install --global gulp`. This also assumes you have a working Wordpress installation on your local machine.

*Steps to get going:*
1. Clone this repo into your `wp-content/themes/` directory
2. `cd wp-content/themes/launchframe/assets`
3. `npm install`
4. `gulp watch`
5. Go!

Note: the assets folder for the base theme may change based on WB-Bootstrap, as it is brought in using [git subtree](http://makingsoftware.wordpress.com/2013/02/16/using-git-subtrees-for-repository-separation/).

Development processes
---------------
Make sure you create a dev.php file, which only has the job of setting the `$devenv` variable. This file can also be used to set environment specific variables. *DO NOT use this to set up wordpress configuration variables.* Edit .less files and the script.js and plugin.js files directly; do not edit the build.js or style.css files unless you are doing away with the build process.

Go Live
---------------
When you go live, make sure `env.php` sets $devenv to false. This will switch assets to their minified versions.