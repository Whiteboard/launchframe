// π ----
// :: TAILWIND SITE CONFIGURATION ---------------------------::
// ____
/* Use this file to completely define the current sites design system by
 * adding and extending to Tailwinds default utility classes.
 */

const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    /* :: Theme
    {+} ---------------------------------- */
    theme: {
        extend: {
            colors: {
                black: '#060c18'
            },
            minHeight: {
                sm: '16rem',
                md: '20rem',
                lg: '32rem',
                mdplus: '25rem',
                lgplus: '36rem',
                xl: '40rem',
                'screen-80': '80vh'
            },
            fontFamily: {
                mono: [
                    // Use a custom mono font for this site by changing 'Anonymous' to the
                    // font name you want and uncommenting the following line.
                    // 'Anonymous',
                    ...defaultTheme.fontFamily.mono
                ],
                sans: [
                    // Use a custom sans serif font for this site by changing 'Gaultier' to the
                    // font name you want and uncommenting the following line.
                    // 'Gaultier',
                    ...defaultTheme.fontFamily.sans
                ],
                serif: [
                    // Use a custom serif font for this site by changing 'Lavigne' to the
                    // font name you want and uncommenting the following line.
                    // 'Lavigne',
                    ...defaultTheme.fontFamily.serif
                ]
            }
        }
    },

    /* :: Plugins
    {+} ---------------------------------- */
    plugins: [
        // π ----
        // :: BASE STYLES ---------------------------::
        // ____
        plugin(function ({ addBase, theme }) {
            addBase({
                a: {
                    transition: 'color 0.3s ease-in-out'
                },

                html: {
                    color: theme('colors.gray.800'),

                    // :: Set Default Font ------------ //
                    // fontFamily: theme('fontFamily.mono').join(', '),
                    // fontFamily: theme('fontFamily.sans').join(', ')
                    // fontFamily: theme('fontFamily.serif').join(', '),

                    fontFamily: {
                        mono: [...defaultTheme.fontFamily.mono],
                        sans: [...defaultTheme.fontFamily.sans],
                        serif: [...defaultTheme.fontFamily.serif]
                    },
                },

                '::selection': {
                    backgroundColor: theme('colors.red.500'),
                    color: theme('colors.white')
                },

                '::-moz-selection': {
                    backgroundColor: theme('colors.red.500'),
                    color: theme('colors.white')
                }
            });
        }),

        // π ----
        // :: CUSTOM COMPONENTS ---------------------------::
        // ____
        plugin(function ({ addComponents, theme }) {
            const components = {};
            addComponents(components);
        }),

        // π ----
        // :: CUSTOM UTILITIES ---------------------------::
        // ____
        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {};
            addUtilities(newUtilities);
        })
    ]
};
