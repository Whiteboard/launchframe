// π ----
// :: TAILWIND TYPOGRAPHY CONFIGURATION ---------------------------::
// ____
/* Here you may overwrite the default Tailwind Typography (prosé) styles.
 * Some defaults are provided.
 * More info: https://github.com/tailwindcss/typography.
 */

const { borderColor } = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    theme: {
        extend: {
            typography: theme => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.gray.800'),

                        a: {
                            color: theme('colors.teal.500'),
                            fontWeight: 'bold',
                            textDecoration: 'none',

                            '&:hover': {
                                color: theme('colors.teal.800'),
                                textDecoration: 'underline'
                            }
                        },

                        'a.no-underline': {
                            textDecoration: 'none'
                        },

                        'h1, h2, h3, h4': {
                            color: theme('colors.gray.900')
                        },

                        p: {
                            fontSize: '1.25rem'
                        },

                        'blockquote p:first-of-type::before': {
                            content: 'none'
                        },
                        strong: {
                            fontWeight: 'bold'
                        },
                        blockquote: {
                            borderColor: theme('colors.gray.400')
                        },

                        'blockquote p': {
                            color: theme('colors.gray.900')
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

                        'ul > li::before': {
                            backgroundColor: theme('colors.gray.500')
                        },

                        'ol > li::before': {
                            color: theme('colors.gray.500')
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
                        }
                    }
                }
            })
        }
    },
    plugins: [require('@tailwindcss/typography')]
};
