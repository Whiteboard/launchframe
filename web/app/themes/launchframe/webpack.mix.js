const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const source = 'assets';
const dist = 'dist';

/* :: Config
{+} ---------------------------------- */
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('assets/js')
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

mix.sass(`${source}/sass/site.scss`, `${dist}/css`)
    .sass(`${source}/sass/admin.scss`, `${dist}/css`)
    .options({
        outputStyle: mix.inProduction() ? 'compressed' : 'expanded',
        processCssUrls: false,
        // postCss: [require('postcss-import'), tailwindcss('tailwind.config.js'), require('postcss-nested')]
        postCss: [tailwindcss('tailwind.config.js')]
    })
    .sourceMaps();

/* mix.postCss(`${source}/sass/site.css`, `${dist}/css`, [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('autoprefixer')
]); */

mix.version();

if (mix.inProduction()) {
    mix.disableNotifications();
}
