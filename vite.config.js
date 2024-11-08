import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/fingerprint.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            'digitalpersona': path.resolve(__dirname, 'node_modules/@digitalpersona/devices')
        },
    },
    // build: {
    //     rollupOptions: {
    //         external: ['@digitalpersona/devices'],
    //     },
    // },
});


