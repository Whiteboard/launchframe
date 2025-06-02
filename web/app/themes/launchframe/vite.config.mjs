import path from 'path'
import { defineConfig } from 'vite'

export default {
    root: '',
    base: process.env.NODE_ENV === 'development' ? '/' : '/dist/',

    build: {
        assetsDir: '.',
        outDir: './public',
        emptyOutDir: true,
        manifest: true,
        sourcemap: true,

        rollupOptions: {
            input: ['./resources/js/site.js'],

            output: {
                entryFileNames: '[hash].js',
                assetFileNames: '[hash].[ext]',
            },
        },
    },

    plugins: [
        {
            name: 'php',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.php')) {
                    server.ws.send({ type: 'full-reload' })
                }
            },
        },
    ],

    server: {
        // required to load scripts from custom host
        cors: true,

        // Needs a  strict port to match on PHP side
        strictPort: true,
        port: 3000,

        https: false,

        hmr: {
            host: 'localhost',
            //port: 443
        },
    },

    resolve: {
        alias: {
            '@': 'resources/js',
            '@templates': 'resources/js/templates',
            '@blocks': 'resources/js/blocks',
            '@modules': 'resources/js/modules',
            '@components': 'resources/js/components',
            '@stores': 'resources/js/stores',
        },
    },
}
