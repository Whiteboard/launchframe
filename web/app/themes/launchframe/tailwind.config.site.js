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
                    100: '#FFD2CE',
                    200: '#FFAAA1',
                    300: '#FF8679',
                    400: '#FF6A5A',
                    DEFAULT: '#FF6A5A',
                    500: '#EB5949',
                    600: '#D14233',
                    700: '#AE2315',
                    800: '#891206',
                    900: '#6A0C02',
                },

                secondary: {
                    50: '#f5f8f8',
                    100: '#dcebe8',
                    200: '#b9d6d1',
                    DEFAULT: '#9bc1bc',
                    400: '#679a95',
                    500: '#4d7f7b',
                    600: '#3c6562',
                    700: '#335251',
                    800: '#2c4343',
                    900: '#283938',
                    950: '#132020',
                },

                neutral: {
                    50: '#f7f8f5',
                    100: '#E6EBE0', // Light
                    200: '#d9e1d1',
                    300: '#c1c0d0',
                    400: '#a4a2b8',
                    500: '#8f8ba6',
                    600: '#807a96',
                    700: '#746d88',
                    DEFAULT: '#5d576b',
                    900: '#514c5c',
                    950: '#34313a',
                },

                black: '#000000',
                white: '#ffffff',
            },

            fontFamily: {
                mono: [`'GT America Mono'`, ...defaultTheme.fontFamily.mono],
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
        plugin(function ({ addBase, theme }) {
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
                    a: {
                        transition: 'color 0.3s ease-in-out',
                    },
                },

                html: {
                    backgroundColor: theme('colors.neutral.50'),
                    color: theme('colors.neutral.900'),
                    //--------------------------------------------------------------------------
                    // Set sans, serif or mono stack with optional custom font as default.
                    //--------------------------------------------------------------------------
                    // fontFamily: theme('fontFamily.mono'),
                    fontFamily: theme('fontFamily.sans'),
                    // fontFamily: theme('fontFamily.serif'),
                },

                '::selection': {
                    backgroundColor: theme('colors.neutral.100'),
                    color: theme('colors.neutral.DEFAULT'),
                },

                '::-moz-selection': {
                    backgroundColor: theme('colors.neutral.100'),
                    color: theme('colors.neutral.DEFAULT'),
                },

                mark: {
                    backgroundColor: theme('colors.primary.DEFAULT'),
                    color: theme('colors.white'),
                },
            })
        }),

        // Custom components for this particular site.
        plugin(function ({ addComponents, theme }) {
            const components = {}
            addComponents(components)
        }),

        // Custom utilities for this particular site.
        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {}
            addUtilities(newUtilities)
        }),
    ],
}
