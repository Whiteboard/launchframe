# Launchframe

<h1 align="center">
    WordPress Starter Kit
</h1>

Launchframe is built on top of the [Lumberjack](https://lumberjack.rareloop.com/) MVC Framework. The custom fields are created with [ACF](https://www.advancedcustomfields.com/resources/) and the views are rendered with [Timber](https://www.upstatement.com/timber/) using [Twig](https://twig.symfony.com/).

-   CSS: [Tailwind](https://tailwindcss.com/)
-   JavaScript: [Alpine](https://github.com/alpinejs/alpine/) with [GreenSock](https://greensock.com/) & [Barba](https://barba.js.org/)
-   [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) for compiling assets.
-   [Twig](https://twig.symfony.com/) as a templating engine and integrating with WordPress using [Timber](https://www.upstatement.com/timber/).
-   [ACF](https://www.advancedcustomfields.com/resources/) for creating an assortment of custom fields.

*   [Getting Started](#getting-started)
*   [Tailwind](#tailwind)
*   [Components Structure](#components-structure)
*   [Article](#article)
*   [Typography](#typography)

## Getting Started

<span id="getting-started"></span>

**1. Create a new site** - cloning the repo and removing the origin repo.

```bash
git clone git@github.com:Whiteboard/launchframe.git my-site
cd my-site
rm -rf .git
composer install
cp .env.example .env
```

**2. Edit .env file**

**3. WordPress Setup** - If you're using [Laravel Valet](https://laravel.com/docs/valet), your site should be available at `http://my-site.test`. You can access the control panel at `http://my-site.test/wp/wp-admin` and login with once you setup WordPress. Once setup and you are logged in, you will need activate plugins and set the theme to Launchframe. Once the theme is activated with the plugins, you will need to sync the Launchframe ACF fields.

**4. Compile the fontend assets** - the [TailwindCSS](https://tailwindcss.com/) & [Alpine](https://github.com/alpinejs/alpine/) compiled assets aren't included in this repo. You need to compile it yourself. Compilation is configured in `webpack.mix.js`. Make sure you add your hostname to your `.env` file (`WP_HOME`) as it's being used for Browsersync in `webpack.mix.js`.

```bash
npm i && npm run watch (or npm run dev)
```

To compile for production run this (on your server). It will purge all unnecessary utility classes and greatly reduce file size:

```bash
npm run production
```

## Tailwind

<span id="tailwind"></span>

Launchframe comes with a `tailwind.config.js` which dictates how Tailwind should be compiled. This file imports multiple Tailwind config files each responsable for various parts of your website. Next to the default config, it uses the following configuration files:

1. `tailwind.config.typography.js`: the Tailwind typography configuration for customizing the `prose` class.
2. `tailwind.config.forms.js`: the Tailwind forms configuration for customizing the form classes.
3. `tailwind.config.core.js`: all Launchframe's configuration, utilities, and components.
4. `tailwind.config.site.js`: your site's configuration. This file would typically include all custom styles and config for the project you're currently working on.

All configuration files are fully documented. Read the Tailwind docs on [theme configuration](https://tailwindcss.com/docs/theme/) for more information.

Read up on the [Tailwind Custom Forms](https://tailwindcss-custom-forms.netlify.app) and [Tailwind Typography](https://github.com/tailwindlabs/tailwindcss-typography) plugins. They're easy to customize and the configure files already include some basic customization. The plugins are easy to remove if you don't plan on using them.

When your app environment is `development`, Launchframe will add a breakpoint notice to your site so you can tell on which breakpoint you're currently displaying the website. You can turn this off by removing `{{ environment == 'development' ? 'debug' : '' }}` from `views/layouts/base.twig`.

### Best Practices

When structuring Tailwind classes, it's recommended to follow the [Thrust](https://www.notion.so/Thrust-8ff9fbf7f25c41c085efda1cb0656f5c) approach.

## Components Structures

<span id="components-structure"></span>

Everything is a **component**. A button, a hero, an image. When a component is larger like a hero or CTA, it should be classified as a **module** since it can contain multiple components to make a whole layout section. When a module is used in a Blocks field (ACF Flexible Content), it is classified as a **block**.

-   _Component_ - The smallest reusable item, such as a button or entry card.
-   _Module_ - This is for a whole layout section that can contain multiple smaller components. For an example: Hero, CTA
-   _Block_ - A Module that is used in a Blocks field

## Article

<span id="article"></span>

An Article is a block of article based blocks: (text, image, video, etc).

### Sizing Utilities

An article goes into a CSS Grid with 12 columns. By default all blocks get the class `size-md`. As you can see in `tailwind.config.core.js` on mobile this means those elements span 12 columns. On larger screens however they just span 6 columns (centered). There are other sizing utilities as well:

-   _size-sm_: 12 columns on mobile, 4 columns from medium screens up
-   _size-md_: 12 columns on mobile, 6 columns from medium screens up
-   _size-lg_: 12 columns on mobile, 8 columns from medium screens up
-   _size-xl_: 12 columns on mobile, 10 columns from medium screens up

For example use the sizing utilities to let an image break out of it's content. In blocks like `image` and `video` the user can pick their own size using a `size` field.

> Note: the layout doesn't have to be centered and is easy to change in the `tailwind.config.core.js` file.

## Typography

<span id="typography"></span>

Launchframe contains a few basic typography partials in `views/typography`. Whenever you need to render text in your partial you should call the relevant partial or add a new one. Let's say we have a block with a `{{ title }}` field. In the template partial for your block you could do the following:

```twig
{% include "typography/h1.twig" with {
    content: blockset.title
} %}
```

This will render the title with the styling defined in `typography/h1`. This way you ensure the same styling throughout your website without having to add or edit Tailwinds utility classes in multiple template files. You can even change the tag and text color and add classes if need be:

```html
{% include "typography/h1.twig" with { tag="span", color="text-red-600"
class="mb-8", content: blockset.title } %}
```

Launchframe comes with a few defaults that are easy to style. Feel free to add more partials for your current website.

---
