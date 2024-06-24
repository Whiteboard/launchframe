// π ----
// :: TAILWIND TYPOGRAPHY CONFIGURATION ---------------------------::
// ____
/* Here you may overwrite the default Tailwind Typography (prosé) styles.
 * Some defaults are provided.
 * More info: https://github.com/tailwindcss/typography.
 */

const plugin = require('tailwindcss/plugin')

module.exports = {
    theme: {
        extend: {
            typography: theme => ({
                DEFAULT: {
                    css: {
                        'h1, h2, h3, h4, h5, h6': {
                            marginTop: '1.25rem',
                        },

                        h2: {
                            fontSize: '2rem',
                        },

                        h3: {
                            fontSize: '1.5rem',
                        },

                        h4: {
                            fontSize: '1.25rem',
                        },

                        blockquote: {
                            fontStyle: 'normal',
                            padding: '0',
                            fontSize: '1.25rem',
                            border: 'none',
                        },

                        'ul > li p, ol > li p': {
                            marginTop: '0em !important',
                            marginBottom: '0em !important',
                        },

                        ':where(.prose > div > :first-child)': {
                            marginTop: '0 !important',
                        },

                        ':where(.prose > div > :last-child)': {
                            marginBottom: '0 !important',
                        },

                        '.not-prose': {
                            margin: '2rem 0 !important',
                        },

                        '.alignright': {
                            float: 'right',
                            marginLeft: '1.5rem',
                            marginBottom: '1.5rem',
                        },

                        '.alignright img': {
                            marginBottom: '0',
                        },

                        'p.wp-caption-text': {
                            marginTop: '0.25rem',
                            fontSize: '0.875rem',
                        },
                    },
                },
            }),
        },
    },

    plugins: [
        require('@tailwindcss/typography')({
            modifiers: [],
        }),
    ],
}
