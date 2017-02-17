![](wp-content/themes/launchframe/screenshot.png)

## Launchframe takes advantage of the following tools available.
---
* Composer
* Bootstrap 4
* Ruby
* NPM, Gulp, Bower
* Timber and Twig


## Get Started Locally
---
Note: Make sure you are in the Launchframe folder when you run the following commands so your node modules are in the correct place.

* `npm install`
* `bower install`
* `gulp watch` to get the party started 🎉


## Local Computer Setup
---
You should also make sure that Composer, NPM, and RubyGems are globally installed before you start. Each of these will be responsible for installing necessary things for PHP, NodeJS, and Ruby, respectively.


## WP Engine Note
---
A bit more info: If you launch your site on WP Engine, the autoloader that normally gets pulled into the site will no longer get pulled in. This happens in the wp-config.php file.

You will need to add that via SFTP (weird, I know). You will also need to make sure that the dependencies for the Timber plugin (the vendor folder, specifically) gets committed to version control.

To do this, you'll have to edit the .gitignore file in the Timber directory.
