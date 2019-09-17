# Launchframe

## Features

-   Built on top of the powerful and modern [Lumberjack](https://lumberjack.rareloop.com/) MVC Framework.
-   [Tailwind](https://tailwindcss.com/) CSS Framework & Sass for the styling.
-   Modern JavaScript using libraries such as [GreenSock](https://greensock.com/) & [ScrollMagic](https://scrollmagic.io/)
-   [Vue.js](http://vuejs.org) capabilities ready to go!
-   [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) for compiling assets and concatenating and minifying files
-   [Twig](https://twig.symfony.com/) as a templating engine and integrating with WordPress using [Timber](https://www.upstatement.com/timber/).
-   [ACF](https://getbootstrap.com/) for creating an assortment of custom fieldsets.

## Setup

-   From the project root, run `composer install`
-   Set the document root on your webserver to the web folder: /path/to/site/web/
-   Update the .env file
-   Login & activate plugins

## Theme development

-   From the theme directory, run `composer install`
-   `npm install` to install dependencies
-   Update `webpack.mix.js` with your local dev URL
-   You are good to go to activate the theme now inside of WordPress

### Build commands

-   `npm watch` — Compile assets when file changes are made, start Browsersync session
-   `npm dev` — Compile and optimize the files in your assets directory
-   `npm run production` — Compile assets for production

### Partials Structures

The partials for Twig, JS, and Sass all have sub-folders for better organization and abstraction.

-   _Components_ - The smallest reusable item, such as a button or post item card.
-   _Module_ - This is for a whole layout section that can contain multiple smaller components. For an example: Hero, CTA
-   _Block_ - Blocks are the same type of items as the modules, just that these are meant to be Flex Blocks.
