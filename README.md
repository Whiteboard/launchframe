![](wp-content/themes/launchframe/screenshot.png)

It's time for Launchframe to take advantage of the tools available.

- Composer
- Bootstrap (4)
- A little dash of Ruby
- Bower
- NPM and Gulp
- Timber and Twig
- etc


To get started, run `bundle`, then `./start`.

Note: you should also install Composer, NPM, and RubyGems before you start. Each of these will be responsible for installing necessary things for PHP, NodeJS, and Ruby, respectively.

---

A bit more info: If you launch your site on WP Engine, the autoloader that normally gets pulled into the site will no longer get pulled in. This happens in the wp-config.php file.

You will need to add that via SFTP (weird, I know). You will also need to make sure that the dependencies for the Timber plugin (the vendor folder, specifically) gets committed to version control.

To do this, you'll have to edit the .gitignore file in the Timber directory.
