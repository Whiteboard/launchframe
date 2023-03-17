// π ----
// :: TAILWIND SITE CONFIGURATION ---------------------------::
// ____
/* Use this file to completely define the current sites design system by
 * adding and extending to Tailwinds default utility classes.
 */

const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')
const colors = require('tailwindcss/colors')

module.exports = {
    theme: {
        extend: {
            colors: {
                primary: {
                    '400': '#5DC9F0',
                    DEFAULT: '#0D4F84',
                    '600': '#0B2254'
                },

                secondary: {
                    '400': '#F25C96',
                    DEFAULT: '#D23D77',
                    '600': '#9B2F59'
                },

                /*
                tertiary: {
                    DEFAULT: colors.yellow['500'],
                    ...colors.yellow
                },
                */

                neutral: {
                    DEFAULT: colors.neutral['200'],
                    ...colors.neutral
                },

                black: '#000000',
                white: '#ffffff',

            },

            fontFamily: {
                mono: [
                    `'GT America Mono'`,
                    ...defaultTheme.fontFamily.mono,
                ],
                sans: [
                    // `'Blender'`,
                    ...defaultTheme.fontFamily.sans,
                ],
                serif: [
                    // `'Lavigne'`,
                    ...defaultTheme.fontFamily.serif,
                ],
            },

            transitionDuration: {
                DEFAULT: '300ms',
            },

            transitionTimingFunction: {
                DEFAULT: 'cubic-bezier(0.455, 0.03, 0.515, 0.955)',
            },
        },
    },

    plugins: [
        plugin(function({ addBase, theme }) {
            addBase({
                /* :: Fonts
                {+} ---------------------------------- */
                '@font-face': {
                    fontFamily: 'GT America Mono',
                    src: `url('../../resources/fonts/GTAmericaMono-Regular.woff2') format('woff2'),
                        url('../../resources/fonts/GTAmericaMono-Regular.woff') format('woff');`,
                    fontWeight: 'normal',
                    fontStyle: 'normal',
                    fontDisplay: 'swap',
                },

                '@font-face': {
                    fontFamily: 'GT America Mono',
                    src: `url('../../resources/fonts/GTAmericaMono-RegularItalic.woff2') format('woff2'),
                        url('../../resources/fonts/GTAmericaMono-RegularItalic.woff') format('woff');`,
                    fontWeight: 'normal',
                    fontStyle: 'italic',
                    fontDisplay: 'swap',
                },

                // Default color transition on links unless user prefers reduced motion.
                '@media (prefers-reduced-motion: no-preference)': {
                    'a': {
                        transition: 'color 0.3s ease-in-out',
                    },
                },

                'html': {
                        backgroundColor: theme('colors.neutral.50'),
                        color: theme('colors.neutral.900'),
                        //--------------------------------------------------------------------------
                        // Set sans, serif or mono stack with optional custom font as default.
                        //--------------------------------------------------------------------------
                        // fontFamily: theme('fontFamily.mono'),
                        fontFamily: theme('fontFamily.sans'),
                        // fontFamily: theme('fontFamily.serif'),
                },

                '                ::selection': {
                    backgroundColor: theme('colors.primary.DEFAULT'),
                    color: theme('colors.black')
                },

                '::-moz-selection': {
                    backgroundColor: theme('colors.primary.DEFAULT'),
                    color: theme('colors.black')
                },

                'mark': {
                    backgroundColor: theme('colors.primary.DEFAULT'),
                    color: theme('colors.white')
                },
            })
        }),

        // Custom components for this particular site.
        plugin(function({ addComponents, theme }) {
            const components = {
            }
            addComponents(components)
        }),

        // Custom utilities for this particular site.
        plugin(function({ addUtilities, theme, variants }) {
            const newUtilities = {
            }
            addUtilities(newUtilities)
        }),
    ]
}
