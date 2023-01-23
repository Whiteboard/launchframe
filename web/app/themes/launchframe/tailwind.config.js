module.exports = {
    presets: [
        require('tailwindcss/defaultConfig'),
        require('./tailwind.config.typography.js'),
        require('./tailwind.config.core.js'),
        require('./tailwind.config.site.js'),
    ],

    mode: 'jit',
    // Configure Purge CSS.
    content: [
        './resources/views/**/*.twig',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],
    safelist: []
}
