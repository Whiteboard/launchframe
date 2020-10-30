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
        require('./tailwind.config.forms.js')
    ],

    /* :: Opt in to future Tailwind features
    {+} ---------------------------------- */
    future: {
        applyComplexClasses: true,
        purgeLayersByDefault: true,
        standardFontWeights: true,
        removeDeprecatedGapUtilities: true
    },

    /* :: Dark Mode
    {+} ---------------------------------- */
    dark: 'media', // or 'class'

    /* :: Experimental Features
    {+} ---------------------------------- */
    experimental: {
        defaultLineHeights: true,
        darkModeVariant: false,
        extendedFontSizeScale: true,
        extendedSpacingScale: true,
        uniformColorPalette: true
    },

    /* :: Purge CSS
    {+} ---------------------------------- */
    purge: {
        content: ['./views/**/*.twig', './assets/images/**/*.svg', './assets/js/**/*.js', './assets/js/**/*.vue'],
        options: {
            whitelist: ['size-sm', 'size-md', 'size-lg', 'size-xl']
        }
    },

    /* :: Define all variants available
    {+} ---------------------------------- */
    variants: {
        boxShadow: ['responsive', 'hover', 'focus', 'group-hover'],
        backgroundColor: ['responsive', 'hover', 'focus', 'group-hover'],
        opacity: ['responsive', 'hover', 'focus', 'group-hover'],
        scale: ['responsive', 'hover', 'focus', 'group-hover'],
        skew: ['responsive', 'hover', 'focus', 'group-hover'],
        rotate: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        translate: ['responsive', 'hover', 'focus', 'group-hover'],
        visibility: ['responsive', 'hover', 'focus', 'group-hover']
    }
};
