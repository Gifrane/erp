import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import Compression from 'vite-compression-plugin'

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.sass',
            'resources/js/app.js',
            'resources/js/home.js',
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Compression({
            threshold: 10240
        })
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@sass': '/resources/sass',
            'vue': 'vue/dist/vue.esm-bundler.js',
        }
    },
})