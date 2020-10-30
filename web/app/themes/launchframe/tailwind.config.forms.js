// π ----
// :: TAILWIND FORMS CONFIGURATION ---------------------------::
// ____
/* Here you may overwrite the default Tailwind Custom Forms styles.
 * Some defaults are provided.
 * More info: https://github.com/tailwindlabs/tailwindcss-custom-forms.
 */

const plugin = require('tailwindcss/plugin');

module.exports = {
    theme: {
        customForms: theme => ({
            default: {
                input: {
                    borderColor: theme('colors.gray.300'),
                    color: theme('colors.gray.800')
                }
            },
            error: {
                'input, textarea': {
                    borderColor: theme('colors.red.700')
                }
            }
        })
    },
    plugins: [require('@tailwindcss/custom-forms')]
};
