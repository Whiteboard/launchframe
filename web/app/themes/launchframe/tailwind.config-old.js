// π ----
// :: TAILWIND CONFIGURATION ---------------------------::
// ____
const _ = require('lodash');
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    future: {
        applyComplexClasses: true,
        extendedFontSizeScale: true,
        extendedSpacingScale: true,
        removeDeprecatedGapUtilities: true
    },
    purge: {
        content: ['./views/**/*.twig', './assets/images/**/*.svg', './assets/js/**/*.js', './assets/js/**/*.vue'],
        options: {
            whitelist: ['size-sm', 'size-md', 'size-lg', 'size-xl']
        }
    },

    // シガ ----
    // :: THEME ---------------------------::
    // ____
    theme: {
        /* :: Extend
        {+} ---------------------------------- */
        extend: {
            // :: Colors ------------ //
            // Great tool for setting light/darker shades https://tailwind-colors.meidev.co/
            colors: {
                black: '#060c18'
            },

            container: {
                center: true,
                padding: {
                    default: '2rem',
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
                '2xl': '1536px',
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
        },

        /* :: Typography
        {+} ---------------------------------- */
        // More info: https://github.com/tailwindcss/typography.
        typography: theme => ({
            default: {
                css: {
                    color: theme('colors.gray.800'),
                    '[class~="lead"]': {
                        color: theme('colors.gray.800')
                    },
                    a: {
                        color: theme('colors.blue.500'),
                        '&:hover': {
                            color: theme('colors.blue.800')
                        },
                        textDecoration: 'none'
                    },
                    'a.no-underline': {
                        textDecoration: 'none'
                    },
                    'h1, h2, h3, h4': {
                        scrollMarginTop: theme('spacing.36'),
                        color: theme('colors.gray.900')
                    },
                    p: {
                        fontSize: theme('fontSize.lg'),
                        lineHeight: theme('lineHeight.longform')
                    },
                    'blockquote p:first-of-type::before': {
                        content: 'none !important'
                    },
                    blockquote: {
                        padding: '0px',
                        border: 'none',
                        fontStyle: 'normal',
                        color: theme('colors.gray.900')
                    },
                    'blockquote p': {
                        color: theme('colors.gray.900')
                    },
                    'blockquote p del': {
                        color: theme('colors.blue.500'),
                        textDecoration: 'none'
                    },
                    'blockquote h6': {
                        marginTop: '-' + theme('marginTop.9') + ' !important',
                        fontSize: theme('fontSize.2xs') + ' !important',
                        fontFamily: theme('fontFamily.expanded') + ' !important',
                        color: theme('colors.blue.500') + ' !important'
                    },
                    ul: {
                        marginTop: theme('margin.225'),
                        marginBottom: theme('margin.225'),
                        marginLeft: theme('margin.24')
                    },
                    'ul > li::before': {
                        backgroundColor: theme('colors.blue.500')
                    },
                    ol: {
                        marginTop: theme('margin.225'),
                        marginBottom: theme('margin.225'),
                        listStyle: 'none',
                        counterReset: 'longformCounter',
                        marginLeft: theme('margin.24')
                    },
                    'ol > li': {
                        counterIncrement: 'longformCounter !important'
                    },
                    'ol > li::before': {
                        content: 'counter(longformCounter) "."',
                        color: theme('colors.blue.500'),
                        fontWeight: 'bold'
                    },
                    hr: {
                        borderColor: theme('colors.gray.100')
                    },
                    'figure, img, picture, video, code': {
                        marginTop: 0,
                        marginBottom: 0
                    },
                    'figure figcaption': {
                        color: 'inherit'
                    },

                    'figure figcaption': {
                        color: theme('colors.gray.500')
                    },
                    thead: {
                        borderBottomColor: theme('colors.gray.200')
                    },
                    'tbody tr': {
                        borderBottomColor: theme('colors.gray.100')
                    },
                    pre: {
                        whiteSpace: 'pre-wrap'
                    },
                    '&.dark': {
                        color: theme('colors.white'),
                        strong: {
                            color: theme('colors.white')
                        },
                        'h1, h2, h3, h4': {
                            color: theme('colors.white')
                        },
                        blockquote: {
                            color: theme('colors.white')
                        },
                        'blockquote p': {
                            color: theme('colors.white')
                        },
                        hr: {
                            borderColor: theme('colors.gray.600')
                        }
                    }
                }
            },
            sm: {
                css: {
                    p: {
                        fontSize: theme('fontSize.base')
                    }
                }
            }
        }),

        /* :: Forms
        {+} ---------------------------------- */
        // More info: https://github.com/tailwindlabs/tailwindcss-custom-forms.
        customForms: theme => ({
            default: {
                input: {
                    borderColor: theme('colors.gray.300'),
                    color: theme('colors.gray.800')
                }
            },
            red: {
                'input, textarea': {
                    borderColor: theme('colors.red.700')
                }
            }
        })
    },

    // π ----
    // :: VARIANTS ---------------------------::
    // ____
    // More info: https://tailwindcss.com/docs/configuration/#app
    variants: {
        backgroundBlendMode: ['responsive'],
        backgroundColor: ['responsive', 'hover', 'focus', 'group-hover'],
        borderColor: ['responsive', 'hover', 'focus', 'group-hover', 'focus-within'],
        boxShadow: ['responsive', 'hover', 'focus', 'group-hover'],
        isolation: ['responsive'],
        mixBlendMode: ['responsive'],
        opacity: ['responsive', 'hover', 'focus', 'group-hover'],
        scale: ['responsive', 'hover', 'focus', 'group-hover'],
        skew: ['responsive', 'hover', 'focus', 'group-hover'],
        rotate: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        translate: ['responsive', 'hover', 'focus', 'group-hover'],
        isolation: ['responsive'],
        visibility: ['responsive', 'hover', 'focus', 'group-hover']
    },

    // π ----
    // :: PLUGINS ---------------------------::
    // ____
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-blend-mode')(), // no options to configure

        /* :: Custom Plugins
        {+} ---------------------------------- */
        plugin(function ({ addBase, theme }) {
            addBase({
                ':root': {
                    fontSize: '16px'
                },
                // Used to hide alpine elements before being rendered.
                '[x-cloak]': {
                    display: 'none'
                },
                a: {
                    transition: 'color 0.3s ease-in-out'
                },
                html: {
                    color: theme('colors.gray.800'),

                    // :: Set Default Font ------------ //
                    // fontFamily: theme('fontFamily.mono').join(', '),
                    fontFamily: theme('fontFamily.sans').join(', '),
                    // fontFamily: theme('fontFamily.serif').join(', '),

                    fontSize: '16px'
                },
                '::selection': {
                    backgroundColor: theme('colors.red.500'),
                    color: theme('colors.white')
                },
                '::-moz-selection': {
                    backgroundColor: theme('colors.red.500'),
                    color: theme('colors.white')
                },

                // ::  Display screen breakpoints in debug environment ------------ //
                'body.debug::before': {
                    display: 'block',
                    position: 'fixed',
                    zIndex: '99',
                    top: theme('spacing.1'),
                    right: theme('spacing.1'),
                    padding: theme('spacing.1'),
                    border: '1px',
                    borderStyle: 'solid',
                    borderColor: theme('colors.red.300'),
                    borderRadius: theme('borderRadius.full'),
                    backgroundColor: theme('colors.red.200'),
                    fontFamily: theme('fontFamily.mono'),
                    fontSize: '.5rem',
                    color: theme('colors.black'),
                    textTransform: 'uppercase',
                    fontWeight: theme('fontWeight.bold'),
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
        // :: CUSTOM COMPONENTS ---------------------------::
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
        // :: CUSTOM UTILITIES ---------------------------::
        // ____
        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {
                // Sizing utilities for sets in our article blocks.
                // On small devices they're full width.
                '.size-sm, .size-md, .size-lg, .size-xl': {
                    gridColumn: 'span 12 / span 12'
                },
                [`@media (min-width: ${theme('screens.md')})`]: {
                    // Sizing utilities for sets in our article blocks.
                    // On larger devices they go from small to extra large.
                    // (E.g. an image wider then text in an article.)
                    '.size-sm': {
                        gridColumn: 'span 4 / span 4',
                        gridColumnStart: '3'
                    },
                    '.size-md': {
                        gridColumn: 'span 6 / span 6',
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
                    // Sizing utilities for sets in our article blocks.
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
