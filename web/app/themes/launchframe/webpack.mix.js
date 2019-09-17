const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');
require('laravel-mix-purgecss');

const source = 'assets';
const dist = 'dist';

/* :: Config
{+} ---------------------------------- */
mix.webpackConfig({
    resolve: {
        extensions: ['.js'],
        alias: {
            TweenLite: 'gsap/src/uncompressed/TweenLite.js',
            TweenMax: 'gsap/src/uncompressed/TweenMax.js',
            TimelineLite: 'gsap/src/uncompressed/TimelineLite.js',
            TimelineMax: 'gsap/src/uncompressed/TimelineMax.js',
            ScrollMagic: 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js',
            'animation.gsap': 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js'
        }
    }
});

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});

mix.setPublicPath(dist);

/* :: Watch
{+} ---------------------------------- */
mix.browserSync({
    proxy: 'launchframe.test',
    files: [`${dist}/js/*.js`, `${dist}/css/*.css`, `${dist}/images/**/*`, 'views/**/*.twig', '**/*.php'],
    ghostMode: false
});

/* :: Images
{+} ---------------------------------- */
mix.webpackConfig({
    plugins: [
        new CopyWebpackPlugin([
            {
                from: `${source}/images`,
                to: 'images'
            }
        ]),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80
                })
            ]
        })
    ]
});

/* :: JS, Sass, & Css
{+} ---------------------------------- */
mix.js(`${source}/js/main.js`, `${dist}/js`)
    .extract(['jquery', 'vue', 'gsap', 'scrollmagic'])
    .sass(`${source}/sass/main.scss`, `${dist}/css`, {
        outputStyle: mix.inProduction() ? 'compressed' : 'expanded'
    })
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.config.js')]
    })
    .sourceMaps();

if (mix.inProduction()) {
    mix.purgeCss({
        enabled: true,
        globs: [
            path.join(__dirname, 'views/**/*.twig'),
            path.join(__dirname, 'assets/js/**/*.js'),
            path.join(__dirname, 'assets/js/views/**/*.vue'),
            path.join(__dirname, 'assets/images/**/*.svg')
            // path.join(__dirname, 'node_modules/slick-carousel/slick/**/*.js'),
            // path.join(__dirname, 'node_modules/plyr/dist/*.js')
        ],
        extensions: ['twig', 'js', 'php', 'vue'],
        whitelistPatterns: [/plyr/, /language/, /hljs/],
        whitelistPatternsChildren: [/^markdown$/]
    });

    mix.disableNotifications();
    mix.version();
}
