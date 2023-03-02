const mix = require('laravel-mix');

mix.alias({
    '@': 'resources/js',
    '@templates': 'resources/js/templates',
    '@blocks': 'resources/js/blocks',
    '@modules': 'resources/js/modules',
    '@components': 'resources/js/components'
});

const source = 'resources';
const dist = 'public';
mix.setPublicPath(dist);

mix.js(`${source}/js/site.js`, `${dist}/js/site.js`).sourceMaps(false);

mix.postCss(`${source}/css/site.css`, `${dist}/css/site.css`, [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('postcss-focus-visible'),
    require('autoprefixer')
]);

mix.options({ cssNano: { minifyFontValues: false } });

mix.browserSync({
    proxy: process.env.WP_HOME,
    files: [`${source}/views/**/*.twig`, `${dist}/**/*.(css|js)`, '**/*.php'],
    // Option to open in non default OS browser.
    // browser: "firefox",
    notify: false
});

mix.version();
