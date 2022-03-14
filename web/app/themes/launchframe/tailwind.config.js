// 追い風 ----
// :: TAILWIND CONFIGURATION ---------------------------::
// ____
/* Use the Tailwind configuration to completely define the current sites
 * design system by adding and extending to Tailwinds default utility
 * classes. Various aspects of the config are split in multiple files.
 */

const _ = require('lodash');
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    /* :: Config Files
    {+} ---------------------------------- */
    presets: [
        require('tailwindcss/defaultConfig'),
        require('./tailwind.config.core.js'),
        require('./tailwind.config.site.js'),
        require('./tailwind.config.typography.js'),
    ],

    /* :: Opt in to future Tailwind features
    {+} ---------------------------------- */
    future: {},

    /* :: Dark Mode
    {+} ---------------------------------- */
    dark: 'media', // or 'class'

    /* :: Experimental Features
    {+} ---------------------------------- */
    experimental: {
        darkModeVariant: false
    },

    /* :: Purge CSS
    {+} ---------------------------------- */
    purge: {
        content: ['./views/**/*.twig', './assets/images/**/*.svg', './assets/js/**/*.js', './assets/js/**/*.vue'],
        options: {
            whitelist: ['size-sm', 'size-md', 'size-lg', 'size-xl', 'sr-only']
        }
    },

    /* :: Extend Variants
    {+} ---------------------------------- */
    variants: {
        extend: {
            scale: ['group-hover'],
            skew: ['group-hover'],
            rotate: ['group-hover'],
            translate: ['group-hover'],
            visibility: ['group-hover'],
            zIndex: ['hover']
        }
    }
};
