import liveReload from 'vite-plugin-live-reload'
const { resolve } = require('path')
const fs = require('fs')

export default {

  plugins: [
    liveReload(__dirname+'/**/*.php')
  ],


  root: '',
  base: process.env.NODE_ENV === 'development'
    ? '/'
    : '/dist/',

    build: {
        outDir: resolve(__dirname, './public'),
        emptyOutDir: true,
        manifest: true,
        target: 'es2018',

        rollupOptions: {
            input: {
                main: resolve( __dirname + './resources/js/main.js')
            },

            /*
            output: {
                entryFileNames: `[name].js`,
                chunkFileNames: `[name].js`,
                assetFileNames: `[name].[ext]`
            }*/
        },

        minify: true,
        write: true
    },

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
            '@': resolve(__dirname, './resources/js'),
            '@blocks': resolve(__dirname, './resources/js/blocks'),
            '@modules': resolve(__dirname, './resources/js/modules'),
            '@components': resolve(__dirname, './resources/js/components'),
            '@templates': resolve(__dirname, './resources/js/templates'),
            '@utilities': resolve(__dirname, './resources/js/utilities')
        }
  }
}
