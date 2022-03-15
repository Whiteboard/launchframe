// π ----
// :: TAILWIND LAUNCHFRAME CONFIGURATION ---------------------------::
// ____
// Here we define base styles, components, & utilities used by Launchframe

const _ = require('lodash');
const plugin = require('tailwindcss/plugin');
const colors = require('tailwindcss/colors');

module.exports = {
    /* :: Theme
    {+} ---------------------------------- */
    theme: {
        extend: {
            colors: {
                red: colors.red,
                yellow: colors.amber,
                green: colors.emerald,
                purple: colors.violet,
                cyan: colors.cyan,
                teal: colors.teal
            },

            container: {
                center: true,
                padding: {
                    DEFAULT: '1rem',
                    md: '4rem',
                    xl: '6rem'
                }
            },

            padding: {
                // Used to generate responsive video embeds.
                video: '56.25%'
            },

            scale: {
                '-1': '-1'
            },

            screens: {
                max: '1680px'
            },

            spacing: {
                // Used for the mobile navigation toggle.
                safe: 'calc(env(safe-area-inset-bottom, 0rem) + 2rem)'
            },

            transitionTimingFunction: {
                'in-quad': 'cubic-bezier(0.55, 0.085, 0.68, 0.53)',
                'in-cubic': 'cubic-bezier(0.55, 0.055, 0.675, 0.19)',
                'in-quart': 'cubic-bezier(0.895, 0.03, 0.685, 0.22)',
                'in-quint': 'cubic-bezier(0.755, 0.05, 0.855, 0.06)',
                'in-expo': 'cubic-bezier(0.95, 0.05, 0.795, 0.035)',
                'in-circ': 'cubic-bezier(0.6, 0.04, 0.98, 0.335)',
                'out-quad': 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                'out-cubic': 'cubic-bezier(0.215, 0.61, 0.355, 1)',
                'out-quart': 'cubic-bezier(0.165, 0.84, 0.44, 1)',
                'out-quint': 'cubic-bezier(0.23, 1, 0.32, 1)',
                'out-expo': 'cubic-bezier(0.19, 1, 0.22, 1)',
                'out-circ': 'cubic-bezier(0.075, 0.82, 0.165, 1)',
                'in-out-quad': 'cubic-bezier(0.455, 0.03, 0.515, 0.955)',
                'in-out-cubic': 'cubic-bezier(0.645, 0.045, 0.355, 1)',
                'in-out-quart': 'cubic-bezier(0.77, 0, 0.175, 1)',
                'in-out-quint': 'cubic-bezier(0.86, 0, 0.07, 1)',
                'in-out-expo': 'cubic-bezier(1, 0, 0, 1)',
                'in-out-circ': 'cubic-bezier(0.785, 0.135, 0.15, 0.86)'
            },

            translate: {
                '-over': '-104%',
                '1/4': '25%',
                over: '104%'
            },

            zIndex: {
                // Z-index stuff behind it's parent.
                behind: '-1'
            }
        }
    },

    /* :: Plugins
    {+} ---------------------------------- */
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('tailwindcss-blend-mode')(),

        // π ----
        // :: BASE STYLES ---------------------------::
        // ____
        plugin(function ({ addBase, theme }) {
            addBase({
                ':root': {
                    fontSize: '16px'
                },

                // Used to hide alpine elements before being rendered.
                '[x-cloak]': {
                    display: 'none !important'
                },

                // ::  Display screen breakpoints in debug environment ------------ //
                'body.debug::before': {
                    display: 'block',
                    position: 'fixed',
                    zIndex: '99',
                    right: theme('spacing.1'),
                    bottom: theme('spacing.1'),
                    border: '2px',
                    borderRadius: theme('borderRadius.full'),
                    padding: '0.5em 0.75em',
                    borderStyle: 'solid',
                    color: theme('colors.yellow.500'),
                    borderColor: theme('colors.indigo.300'),
                    backgroundColor: theme('colors.purple.700'),
                    fontSize: '0.75rem',
                    fontFamily: theme('fontFamily.mono'),
                    lineHeight: '1em',
                    textTransform: 'uppercase',
                    content: '"-"',
                    pointerEvents: 'none'
                },

                'input:focus': {
                    outline: 'none'
                },

                'button:focus': {
                    outline: 'none'
                }
            });
        }),

        /* :: Render screen names in the breakpoint display
        {+} ---------------------------------- */
        plugin(function ({ addBase, theme }) {
            const breakpoints = _.map(theme('screens'), (value, key) => {
                return {
                    [`@media (min-width: ${value})`]: {
                        'body.debug::before': {
                            content: `"${key}"`
                        }
                    }
                };
            });
            addBase(breakpoints);
        }),

        // π ----
        // :: COMPONENTS ---------------------------::
        // ____
        plugin(function ({ addComponents, theme }) {
            const components = {
                /* :: Fluid Container
                {+} ---------------------------------- */
                '.fluid-container': {
                    width: '100%',
                    maxWidth: theme('screens.2xl'),
                    marginLeft: 'auto',
                    marginRight: 'auto',
                    // Use safe-area-inset together with default padding for Apple devices with a notch.
                    paddingLeft: 'calc(env(safe-area-inset-left, 0rem) + ' + theme('padding.8') + ')',
                    paddingRight: 'calc(env(safe-area-inset-right, 0rem) + ' + theme('padding.8') + ')'
                },

                /* :: No Scroll
                {+} ---------------------------------- */
                // When a modal is open. Should be used on the <body>
                '.no-scroll': {
                    height: '100%',
                    overflow: 'hidden'
                },

                /* :: Outer Grid
                {+} ---------------------------------- */
                /* The outer grid where all our blocks are a child of. Spreads out all blocks vertically
                with a uniform space between them. */
                '.outer-grid': {
                    width: '100%',
                    display: 'grid',
                    rowGap: theme('spacing.12'),
                    paddingTop: theme('spacing.12'),
                    paddingBottom: theme('spacing.12'),
                    /* If the last child of the outer grid is full width (e.g. when it has a full width
                    colored background), give it negative margin bottom to get it flush to your
                    sites footer. */
                    '& > *:last-child:has(.w-full)': {
                        marginBottom: theme('spacing.12') * -1
                    }
                },

                [`@media (min-width: ${theme('screens.md')})`]: {
                    // Larger vertical spacing between blocks on larger screens.
                    '.outer-grid': {
                        rowGap: theme('spacing.16'),
                        paddingTop: theme('spacing.16'),
                        paddingBottom: theme('spacing.16'),
                        '& > *:last-child:has(.w-full)': {
                            marginBottom: theme('spacing.16') * -1
                        }
                    }
                },

                [`@media (min-width: ${theme('screens.lg')})`]: {
                    // Larger horizontal padding on larger screens.
                    '.fluid-container': {
                        // Use safe-area-inset together with default padding for Apple devices with a notch.
                        paddingLeft: 'calc(env(safe-area-inset-left, 0rem) + ' + theme('padding.12') + ')',
                        paddingRight: 'calc(env(safe-area-inset-right, 0rem) + ' + theme('padding.12') + ')'
                    },

                    // Larger vertical spacing between blocks on larger screens.
                    '.outer-grid': {
                        rowGap: theme('spacing.24'),
                        paddingTop: theme('spacing.24'),
                        paddingBottom: theme('spacing.24'),
                        '& > *:last-child:has(.w-full)': {
                            marginBottom: theme('spacing.24') * -1
                        }
                    }
                }
            };
            addComponents(components);
        }),

        // π ----
        // :: UTILITIES ---------------------------::
        // ____
        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {
                /* :: Break words only when needed
                {+} ---------------------------------- */
                '.break-decent': {
                    wordBreak: 'break-word'
                },

                '.no-scrollbar': { scrollbarWidth: 'none' },

                '.no-scrollbar::-webkit-scrollbar': { display: 'none' },

                /* :: Grid Sizing Utilities
                {+} ---------------------------------- */
                /* Sizing utilities for sets in the article module/block.
                On small devices they're full width. */
                '.size-sm, .size-md, .size-lg, .size-xl': {
                    gridColumn: 'span 12 / span 12'
                },

                [`@media (min-width: ${theme('screens.md')})`]: {
                    // On larger devices they go from small to extra large.
                    // (E.g. an image wider then text in an article.)
                    '.size-sm': {
                        gridColumn: 'span 4 / span 4',
                        gridColumnStart: '3'
                    },
                    '.size-md': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3'
                    },
                    '.size-lg': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3'
                    },
                    '.size-xl': {
                        gridColumn: 'span 10 / span 10',
                        gridColumnStart: '2'
                    }
                },

                [`@media (min-width: ${theme('screens.lg')})`]: {
                    // On larger devices they go from small to extra large.
                    '.size-sm': {
                        gridColumn: 'span 4 / span 4',
                        gridColumnStart: '4'
                    },
                    '.size-md': {
                        gridColumn: 'span 6 / span 6',
                        gridColumnStart: '4'
                    },
                    '.size-lg': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3'
                    },
                    '.size-xl': {
                        gridColumn: 'span 10 / span 10',
                        gridColumnStart: '2'
                    }
                }
            };
            addUtilities(newUtilities);
        })
    ]
};
