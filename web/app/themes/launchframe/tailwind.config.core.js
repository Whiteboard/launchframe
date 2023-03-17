// π ----
// :: TAILWIND LAUNCHFRAME CONFIGURATION ---------------------------::
// ____
// Here we define base styles, components, & utilities used by Launchframe
const plugin = require('tailwindcss/plugin')
const colors = require('tailwindcss/colors')

module.exports = {
    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: '1.5rem',
                    sm: '2rem',
                    lg: '4rem',
                    xl: '5rem',
                    '2xl': '6rem'
                }
            },

            colors: {
                gray: colors.slate,
                red: colors.red,
                yellow: colors.amber,
                green: colors.green,
            },

            minHeight: {
                '3xs': '12rem',
                '2xs': '16rem',
                xs: '20rem',
                sm: '24rem',
                md: '28rem',
                lg: '32rem',
                xl: '36rem',
                '2xl': '42rem',
                '3xl': '48rem',
                '4xl': '56rem',
                '5xl': '64rem',
                '6xl': '72rem',
                'screen-50': '50vh',
                'screen-75': '75vh',
                'screen-80': '80vh',
                'screen-90': '90vh'
            },

            minWidth: theme => ({
                ...theme('spacing'),
                min: 'min-content',
                max: 'max-content'
            }),

            // cursor: { none: 'none' },

            screens: { '3xl': '1680px' },

            spacing: {
                // Used for the mobile navigation toggle.
                'safe': 'calc(env(safe-area-inset-bottom, 0rem) + 2rem)',
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
                '-over': '-101%',
                over: '101%'
            },

            zIndex: {
                // Z-index stuff behind it's parent.
                'behind': '-1',
            },
        },
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms')({
            strategy: 'base',
        }),

        // π ----
        // :: BASE STYLES ---------------------------::
        // ____
        plugin(function({ addBase, theme }) {
            addBase({
                ':root': {
                    // Fluid typography from 1 rem to 1.2 rem with fallback to 16px.
                    fontSize: '100%',
                    'font-size': 'clamp(1rem, 1.6vw, 1.2rem)',
                    // Safari resize fix.
                    minHeight: '0vw',
                },

                html: {
                    height: '100dvh',
                },

                ':where(html)': {
                    display: 'grid',
                    height: '100vh',
                },

                // Used to hide alpine elements before being rendered.
                '[x-cloak]': {
                    opacity: '0 !important',
                    visibility: 'hidden !important'
                },

                // Implement the focus-visible polyfill: https://github.com/WICG/focus-visible
                '.js-focus-visible :focus:not(.focus-visible)': {
                    outline: 'none',
                },

                // Display screen breakpoints in debug environment.
                '.breakpoint:before': {
                    display: 'block',
                    color: theme('colors.neutral'),
                    textTransform: 'uppercase',
                    content: '"-"',
                },

                '.skip-link': {
                    transform: 'translateY(-100%)',
                    transition: 'transform 0.3s',
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    padding: '1rem 0.75rem',
                    background: theme('colors.primary'),
                    border: '2px solid',
                    borderColor: theme('colors.primary'),
                    color: theme('colors.black'),
                    textAlign: 'center',
                },

                '.skip-link:focus': {
                    transform: 'translateY(0%)',
                    outline: 'none !important',
                },

                /* :: Grid Sizing Utilities
                {+} ---------------------------------- */
                /* Sizing utilities for sets in the article module/block. */
                '.size-md, .size-lg, .size-xl': {
                    gridColumn: 'span 12 / span 12',
                },

                '@media screen(md)': {
                    // On larger devices they go from medium to extra large.
                    // (E.g. an image wider then text in an article.)
                    '.size-md': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3',
                    },
                    '.size-lg': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3',
                    },
                    '.size-xl': {
                        gridColumn: 'span 10 / span 10',
                        gridColumnStart: '2',
                    },
                },

                '@media screen(lg)': {
                    // On larger devices they go from medium to extra large.
                    '.size-md': {
                        gridColumn: 'span 6 / span 6',
                        gridColumnStart: '4',
                    },
                    '.size-lg': {
                        gridColumn: 'span 8 / span 8',
                        gridColumnStart: '3',
                    },
                    '.size-xl': {
                        gridColumn: 'span 10 / span 10',
                        gridColumnStart: '2',
                    },
                },
            })
        }),


        plugin(function({ addBase, theme}) {
            const breakpoints = Object.entries(theme('screens'))
                .filter(value => typeof value[1] == 'string')
                .sort((a, b) => {
                    return a[1].replace(/\D/g, '') - b[1].replace(/\D/g, '')
                })

                .map((value) => {
                    return {
                        [`@media (min-width: ${value[1]})`]: {
                            '.breakpoint::before': {
                                content: `"${value[0]}"`,
                            }
                        }
                    }
                }
            )

            addBase(breakpoints)
        }),

        // π ----
        // :: COMPONENTS ---------------------------::
        // ____
        plugin(function({ addComponents, theme }) {
            const components = {
                /* :: Fluid Container
                {+} ---------------------------------- */
                '.fluid-container': {
                    width: '100%',
                    maxWidth: theme('screens.3xl'),
                    marginLeft: 'auto',
                    marginRight: 'auto',
                    // Use safe-area-inset together with default padding for Apple devices with a notch.
                    paddingLeft: `calc(env(safe-area-inset-left, 0rem) + ${theme('padding.8')})`,
                    paddingRight: `calc(env(safe-area-inset-right, 0rem) + ${theme('padding.8')})`,
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
                    rowGap: theme('spacing.20'),
                    paddingTop: theme('spacing.20'),
                    paddingBottom: theme('spacing.20'),
                    /* If the last child of the outer grid is full width (e.g. when it has a full width color background), give it negative margin bottom to get it flush to your site's footer. */
                    '& > *:last-child.w-full': {
                        marginBottom: `-${theme('spacing.20')}`,
                    },
                },

                '@media screen(md)': {
                    // Larger vertical spacing between blocks on larger screens.
                    '.outer-grid': {
                        rowGap: theme('spacing.24'),
                        paddingTop: theme('spacing.24'),
                        paddingBottom: theme('spacing.24'),
                        '& > *:last-child.w-full': {
                            marginBottom: `-${theme('spacing.24')}`,
                        },
                    },
                },

                '@media screen(lg)': {
                    // Larger horizontal padding on larger screens.
                    '.fluid-container': {
                        // Use safe-area-inset together with default padding for Apple devices with a notch.
                        paddingLeft: `calc(env(safe-area-inset-left, 0rem) + ${theme('padding.12')})`,
                        paddingRight: `calc(env(safe-area-inset-right, 0rem) + ${theme('padding.12')})`,
                    },

                    // Larger vertical spacing between blocks on larger screens.
                    '.outer-grid': {
                        rowGap: theme('spacing.24'),
                        paddingTop: theme('spacing.24'),
                        paddingBottom: theme('spacing.24'),
                        '& > *:last-child.w-full': {
                            marginBottom: `-${theme('spacing.24')}`,
                        },
                    },
                },

                [`@media (min-width: ${theme('screens.2xl')})`]: {
                    // Larger horizontal padding on larger screens.
                    '.fluid-container': {
                        // Use safe-area-inset together with default padding for Apple devices with a notch.
                        paddingLeft: `calc(env(safe-area-inset-left, 0rem) + ${theme('padding.16')})`,
                        paddingRight: `calc(env(safe-area-inset-right, 0rem) + ${theme('padding.16')})`
                    },

                    // Larger vertical spacing between blocks on larger screens.
                    '.outer-grid': {
                        rowGap: theme('spacing.40'),
                        paddingTop: theme('spacing.40'),
                        paddingBottom: theme('spacing.40')
                    }
                }
            }

            addComponents(components)
        }),

        // π ----
        // :: UTILITIES ---------------------------::
        // ____
        plugin(function({ addUtilities, theme, variants }) {
            const newUtilities = {
                // Break words only when needed.
                '.break-decent': { wordBreak: 'break-word' },

                // Fill icons that have a fill defined within their paths. For example coming from an asset container.
                '.fill-current-cascade *': {
                    fill: 'currentColor',
                },

                '.no-scrollbar': { scrollbarWidth: 'none' },

                '.no-scrollbar::-webkit-scrollbar': { display: 'none' }
            }
            addUtilities(newUtilities)
        }),
    ]
}
