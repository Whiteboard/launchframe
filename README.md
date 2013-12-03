
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

We've kept most of this, except we moved the JavaScript plugins into the "plugins" file. No need to mess with those, so why have them in their own files?

Getting Started
---------------

We've built our own LESS files to build out using Grunt. To get going with this, change into the theme directory and run `npm install`. This will bring the `node_modules` folder into the project; make sure these don't go with your project to production unnecessarily.

You can do a one off build by running `grunt`, or you can watch the less and js files by using `grunt watch`. The Gruntfile is largely borrowed from [Twitter Bootstrap](https://github.com/twbs/bootstrap/blob/master/Gruntfile.js).

To change the theme's name, use the following instructions from the _s documentation.

1. Search for `'launchframe'` (inside single quotations) to capture the text domain.
2. Search for `launchframe_` to capture all the function names.
3. Search for <code>&nbsp;_s</code> (with a space before it) to capture DocBlocks.
4. Search for `_s-` to capture prefixed handles.
5. Search for `Text Domain: _s` in style.css.

OR

* Search for: `'launchframe'` and replace with: `'megatherium'`
* Search for: `launchframe_` and replace with: `megatherium_`
* Search for: <code>&nbsp;_s</code> and replace with: <code>&nbsp;Megatherium</code>
* Search for: `_s-` and replace with: `megatherium-`
* Search for: `Text Domain: _s` and replace with: `Text Domain: megatherium` in style.css.

Then, update the stylesheet header in style.css and the links in footer.php with your own information.

Development processes
---------------
Make sure you create a dev.php file, which only has the job of setting the `$devenv` variable. This file can also be used to set environment specific variables. *DO NOT use this to set up wordpress configuration variables.* Edit .less files and the script.js and plugin.js files directly; do not edit the build.js or style.css files unless you are doing away with the build process.

Go Live
---------------
When you go live, make sure `env.php` sets $devenv to false. This will switch assets to their minified versions.