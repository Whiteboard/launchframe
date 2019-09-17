module.exports = {
    theme: {
        /* :: Extending Tailwind
        {+} ---------------------------------- */
        extend: {
            // π ----
            // :: BREAKPOINTS ---------------------------::
            // ____
            screens: {
                xxl: '1360px',
                max: '1600px'
            },

            // π ----
            // :: CONTAINER ---------------------------::
            // ____
            container: {
                center: true
            },

            // π ----
            // :: TRANSITIONS ---------------------------::
            // ____
            transitionTimingFunction: {
                quad: 'cubic-bezier(0.455, 0.03, 0.515, 0.955)',
                circ: 'cubic-bezier(0.75, 0, 0.25, 1) 0.032s'
            },

            // π ----
            // :: TRANSFORMS ---------------------------::
            // ____
            transform: {
                none: 'none'
            },

            translate: {
                '-2': '-0.5rem',
                '-4': '-1rem',
                '-20': '-5rem',
                '-1/4': '-25%',
                '-1/2': '-50%',
                '-full': '-100%',
                '-over': '-104%',

                '0': '0',
                '2': '0.5rem',
                '4': '1rem',
                '10': '2.5rem',
                '20': '5rem',
                '1/4': '25%',
                '1/2': '50%',
                full: '100%',
                over: '104%'
            }
        }
    },
    variants: {
        backgroundColor: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        borderColor: ['responsive', 'hover', 'focus', 'group-hover'],
        boxShadow: ['responsive', 'hover', 'focus', 'group-hover'],
        opacity: ['responsive', 'hover', 'group-hover'],
        zIndex: ['responsive', 'hover'],
        transform: ['responsive', 'hover', 'group-hover'],
        translate: ['responsive', 'hover', 'group-hover'],
        scale: ['responsive', 'hover', 'group-hover'],
        rotate: ['responsive', 'hover', 'group-hover'],
        skew: ['responsive', 'hover', 'group-hover']
    },
    plugins: [require('tailwindcss-transitions')(), require('tailwindcss-transforms')()]
};
