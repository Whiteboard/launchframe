const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const source = 'assets';
const dist = 'dist';

/* :: Config
{+} ---------------------------------- */
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('assets/js'),
            '@templates': path.resolve('assets/js/templates'),
            '@blocks': path.resolve('assets/js/blocks'),
            '@modules': path.resolve('assets/js/modules'),
            '@components': path.resolve('assets/js/components')
        }
    }
});

mix.setPublicPath(dist);

mix.browserSync({
    proxy: 'launchframe.test',
    files: [`${dist}/js/*.js`, `${dist}/css/*.css`, `${source}/images/**/*`, 'views/**/*.twig', '**/*.php'],
    ghostMode: false,
    notify: false
});

mix.js(`${source}/js/site.js`, `${dist}/js`).extract(['alpinejs', 'gsap']).sourceMaps();

mix
    .sass(`${source}/sass/site.scss`, `${dist}/css`)
    // .sass(`${source}/sass/admin.scss`, `${dist}/css`)
    .options({
        outputStyle: mix.inProduction() ? 'compressed' : 'expanded',
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.config.js')]
    })
    .sourceMaps();

mix.version();

if (mix.inProduction()) {
    mix.disableNotifications();
}
